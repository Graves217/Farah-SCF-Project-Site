# Contact Form Setup Guide

## Why GitHub Pages won't run PHP

GitHub Pages serves **static files only**. PHP scripts are never executed—the browser would download the raw `.php` source. To actually send email you must host the site on a **PHP-capable server** (e.g., Hostinger shared hosting).

---

## Files involved

| File | Purpose |
|---|---|
| `contact.htm` | Contact page with the HTML form |
| `FormProcess.php` | Server-side PHP handler – validates input and sends email |
| `contactSent.htm` | Confirmation page shown after a successful submission |
| `farah-scf.css` | Site stylesheet (linked by all pages) |
| `images/` | Site images |

---

## Step 1 – Configure your email address

Open `FormProcess.php` and edit the two lines near the top:

```php
$recipient_email = 'YOUR_EMAIL_HERE@example.com';  // ← your real email
$from_email      = 'no-reply@yourdomain.com';      // ← a mailbox on your hosting domain
```

- **`$recipient_email`** – every form submission is emailed here.
- **`$from_email`** – the `From:` address in the email header. Many shared hosts require this to be an address on your own domain; mismatching it often causes the mail to be silently dropped or flagged as spam.  
  Create the mailbox (e.g. `no-reply@yourdomain.com`) in your hosting control panel first.

The visitor's email is placed in the `Reply-To:` header automatically, so you can reply directly to them.

---

## Step 2 – Testing locally (Windows)

### Option A – XAMPP

1. Download and install [XAMPP](https://www.apachefriends.org/).
2. Start **Apache** in the XAMPP control panel.
3. Copy your site files into `C:\xampp\htdocs\farah\` (create the folder).
4. Open `http://localhost/farah/contact.htm` in your browser.
5. Submit the form. PHP's built-in `mail()` usually **does not send** on localhost, but you can verify the redirect and server-side validation work correctly by checking whether you land on `contactSent.htm`.

### Option B – PHP built-in server (no XAMPP needed)

1. Install PHP for Windows from [windows.php.net](https://windows.php.net/download/).
2. Open PowerShell in your site folder and run:
   ```powershell
   php -S localhost:8000
   ```
3. Open `http://localhost:8000/contact.htm`.

> **Note:** `mail()` will not deliver email in either local option without configuring an SMTP relay (e.g., via `php.ini` `SMTP` settings). The redirect and validation flow can still be verified locally.

---

## Step 3 – Deploying to a PHP host (e.g., Hostinger)

1. In your hosting **File Manager**, open `public_html/`.
2. Upload all site files so they sit **directly** inside `public_html/` (not nested in a subfolder):
   ```
   public_html/index.html
   public_html/contact.htm
   public_html/contactSent.htm
   public_html/FormProcess.php
   public_html/farah-scf.css
   public_html/images/
   ```
3. Make sure you have edited `$recipient_email` and `$from_email` as described in Step 1.
4. Set file permissions:  
   - Folders: **755**  
   - Files: **644**  
   (Right-click → Permissions in Hostinger File Manager.)

---

## Step 4 – Running the professor's validation steps

1. Open `https://yourdomain.com/contact.htm`.
2. Click **Submit** with all fields blank → the browser should highlight every required field.
3. Fill in First Name, Last Name, Comments, and an email **without `@`** (e.g. `testemail.com`) → the browser should show "Please enter a valid email address."
4. Fill in all required fields with a valid email and click **Submit** → you should be redirected to `contactSent.htm`.
5. Check your inbox (and Spam/Junk folder) for the form-submission email.
6. Take a screenshot of the received email using the Windows Snipping Tool (`Win + Shift + S`) and save it for your submission dropbox.

---

## Troubleshooting

| Symptom | Likely cause | Fix |
|---|---|---|
| 403 Forbidden on homepage | `index.htm` not recognised as default | Rename to `index.html`, or keep the existing `index.html` |
| Redirect to `contactSent.htm` but no email | `mail()` silently failed | Check `$from_email` is a valid domain mailbox; check server error log |
| Email arrives in Spam | `From:` domain mismatch | Ensure `$from_email` is on your hosting domain; set up SPF/DKIM in DNS |
| PHP source shown instead of executed | File uploaded to GitHub Pages | Upload to a PHP host as described in Step 3 |
