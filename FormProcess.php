<?php
/**
 * FormProcess.php – server-side form handler for contact.htm
 *
 * NOTE: PHP scripts do not execute on GitHub Pages (static hosting only).
 * To test email delivery, upload this file and contact.htm to a
 * PHP-capable web server (e.g., shared hosting with PHP enabled).
 * Screenshot the sent email and the contactSent.htm confirmation page
 * to satisfy the professor's email/screenshot rubric requirement.
 */

// ── Configuration ────────────────────────────────────────────────────────────
// TO DEPLOY: replace the placeholder values below with real addresses.
//   $recipient_email – where you want to receive form submissions.
//   $from_email      – a mailbox on YOUR domain (improves deliverability;
//                      many hosts reject mail whose From address is not
//                      on the sending domain).
$recipient_email = 'YOUR_EMAIL_HERE@example.com';  // ← CHANGE to your email
$from_email      = 'no-reply@yourdomain.com';      // ← CHANGE to an address on your domain
$subject_prefix  = 'Contact Form Submission'; // email subject prefix
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Sanitize a plain-text field.
 * Strips tags, removes extra whitespace, and encodes HTML entities to
 * prevent cross-site scripting and header-injection attacks.
 */
function sanitize_field(string $value): string {
    $value = trim($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return $value;
}

/**
 * Remove newline characters from a value used in email headers to prevent
 * header-injection attacks (e.g., injected Cc:/Bcc: lines).
 */
function sanitize_header(string $value): string {
    return preg_replace('/[\r\n]/', '', sanitize_field($value));
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('405 Method Not Allowed');
}

// ── Collect and sanitize fields (names must match contact.htm exactly) ────────
$NatureOfContact  = sanitize_field($_POST['NatureOfContact']  ?? '');
$Prefix           = sanitize_field($_POST['Prefix']           ?? '');
$FirstName        = sanitize_field($_POST['FirstName']        ?? '');
$LastName         = sanitize_field($_POST['LastName']         ?? '');
$StreetAddress    = sanitize_field($_POST['StreetAddress']    ?? '');
$City             = sanitize_field($_POST['City']             ?? '');
$State            = sanitize_field($_POST['State']            ?? '');
$Zip              = sanitize_field($_POST['Zip']              ?? '');
$Email            = sanitize_header($_POST['Email']           ?? '');
$Phone            = sanitize_header($_POST['Phone']           ?? '');
$PreferredMethod  = sanitize_field($_POST['PreferredMethod']  ?? '');
$Agreement        = sanitize_field($_POST['Agreement']        ?? '');
$Comments         = sanitize_field($_POST['Comments']         ?? '');

// ── Basic server-side validation ─────────────────────────────────────────────
$errors = [];

if ($FirstName === '') {
    $errors[] = 'First Name is required.';
}
if ($LastName === '') {
    $errors[] = 'Last Name is required.';
}
if ($Email === '' || !filter_var($_POST['Email'] ?? '', FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid Email address is required.';
}
if ($Comments === '') {
    $errors[] = 'Comments are required.';
}
if ($Zip !== '' && !preg_match('/^[0-9]{5}$/', $Zip)) {
    $errors[] = 'Zip Code must be exactly 5 digits.';
}
if ($Agreement !== 'yes') {
    $errors[] = 'You must agree to be contacted before submitting.';
}

if (!empty($errors)) {
    // Return to the form with a simple error message
    // (Browser validation should catch these first; this is a fallback.)
    $error_list = implode("\n", $errors);
    header('Location: contact.htm?error=' . urlencode($error_list));
    exit;
}

// ── Build the email body ──────────────────────────────────────────────────────
$message_lines = [
    "Contact Form Submission from contact.htm",
    str_repeat('-', 40),
    "Nature of Contact : {$NatureOfContact}",
    "Prefix            : {$Prefix}",
    "First Name        : {$FirstName}",
    "Last Name         : {$LastName}",
    "Street Address    : {$StreetAddress}",
    "City              : {$City}",
    "State             : {$State}",
    "Zip Code          : {$Zip}",
    "Email             : {$Email}",
    "Phone             : {$Phone}",
    "Preferred Method  : {$PreferredMethod}",
    "Agreed to Contact : {$Agreement}",
    str_repeat('-', 40),
    "Comments:",
    $Comments,
];
$message = implode("\n", $message_lines);

// ── Build email headers (header-injection safe) ───────────────────────────────
$from_name    = trim("{$Prefix} {$FirstName} {$LastName}");
// Re-validate the sanitized email to ensure it is safe for header use
$safe_email   = filter_var($_POST['Email'] ?? '', FILTER_VALIDATE_EMAIL)
                    ? filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL)
                    : 'noreply@example.com';
$reply_to     = $safe_email;
$subject      = "{$subject_prefix}: {$FirstName} {$LastName}";

$headers  = "From: {$from_email}\r\n";
$headers .= "Reply-To: {$reply_to}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// ── Send the email ────────────────────────────────────────────────────────────
$mail_sent = mail($recipient_email, $subject, $message, $headers);

if (!$mail_sent) {
    // Log the failure to PHP's error log so the server admin can investigate.
    error_log("FormProcess.php: mail() failed for submission from {$safe_email}");
}

// ── Redirect to confirmation page ────────────────────────────────────────────
header('Location: contactSent.htm');
exit;
