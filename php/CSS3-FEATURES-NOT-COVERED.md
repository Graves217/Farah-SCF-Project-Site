# CSS3 Features Not Covered in Class

The following two CSS3 features were added to this project to fulfill the requirement of finding and using features not covered in class.

---

## Feature 1: `clamp()` — Responsive Typography

**File:** `farah-scf.css`

**Where it is used:**
- `header h1` rule — `font-size: clamp(1.5rem, 4vw, 2.5rem);`
- `h2` rule — `font-size: clamp(1.1rem, 2.5vw, 1.4rem);`

**What it does:**
`clamp(min, preferred, max)` is a CSS math function that restricts a value between a minimum and maximum, with a fluid preferred value in between. Here it makes the main page headings automatically scale with the viewport width (`4vw` / `2.5vw`), so they are never too small on a phone or too large on a wide monitor — without any JavaScript or extra media queries.

---

## Feature 2: `@media (prefers-reduced-motion: reduce)` — Accessibility

**File:** `farah-scf.css`

**Where it is used:**
At the bottom of `farah-scf.css`:

```css
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        transition: none !important;
        animation: none !important;
    }
}
```

**What it does:**
`prefers-reduced-motion` is a CSS media feature that detects whether the user has requested that the system minimize the amount of non-essential motion (e.g., the "Reduce Motion" setting on macOS/iOS/Windows). When that preference is active, all CSS transitions (such as the `color 0.3s ease` on navigation links and body links) and animations are instantly turned off, improving accessibility for people who experience discomfort or vestibular disorders from motion effects.
