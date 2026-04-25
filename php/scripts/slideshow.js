/* Item #7 – External JavaScript Slideshow
 * Source: Pattern adapted by Anthony Farah from the W3Schools "How TO – Slideshow" tutorial
 *         (https://www.w3schools.com/howto/howto_js_slideshow.asp, accessed 2026).
 * What was changed: Original tutorial uses auto-advance with dots; this version is
 *   manual-only (Prev / Next buttons), uses an array of image objects with captions,
 *   and is scoped inside an IIFE to avoid polluting the global namespace.
 *   slideshowPrev() and slideshowNext() are explicitly exported to window so the
 *   onclick handlers in js.htm (which live in the global scope) still work.
 * Images: Anthony Farah's personal IT portfolio photographs.
 * Usage: Attached from js.htm via
 *        <script src="scripts/slideshow.js" type="text/javascript"></script>
 */

(function () {
    /* Private data — not accessible from the global scope */
    var slideshowImages = [
        { src: "images/My_PC_Build.JPEG",    caption: "My Custom PC Build"         },
        { src: "images/WIFE_PC_BUILD.jpg",   caption: "Alison\u2019s Custom PC Build"   },
        { src: "images/Wife_Desk_Setup.jpg", caption: "Alison\u2019s Custom Desk Setup" },
        { src: "images/Jake_Desk_Setup.jpg", caption: "Jake V.\u2019s Home Desk Setup"  },
        { src: "images/SCFenter.jpg",        caption: "State College of Florida"   },
        { src: "images/DUMAOS.jpg",          caption: "DumaOS Network Management"  }
    ];

    var currentSlideIndex = 0;

    /* Preload all slideshow images so navigation is instant */
    (function preload() {
        for (var i = 0; i < slideshowImages.length; i++) {
            var img = new Image();
            img.src = slideshowImages[i].src;
        }
    }());

    /* updateSlide: refreshes the displayed image and caption to match currentSlideIndex.
     * Gracefully does nothing if the expected DOM elements are absent. */
    function updateSlide() {
        var img = document.getElementById("slideshowImg");
        var cap = document.getElementById("slideshowCaption");
        if (!img || !cap) { return; }   /* graceful guard: elements not found */
        img.src = slideshowImages[currentSlideIndex].src;
        img.alt = slideshowImages[currentSlideIndex].caption;
        /* Build caption safely via DOM (avoids raw HTML concatenation) */
        var strong = document.createElement("strong");
        strong.textContent = slideshowImages[currentSlideIndex].caption;
        cap.innerHTML = "";
        cap.appendChild(strong);
    }

    /* slideshowNext: advances to the next image, wrapping to the first at the end */
    function slideshowNext() {
        currentSlideIndex = (currentSlideIndex + 1) % slideshowImages.length;
        updateSlide();
    }

    /* slideshowPrev: steps back to the previous image, wrapping to the last at start */
    function slideshowPrev() {
        currentSlideIndex = (currentSlideIndex - 1 + slideshowImages.length) % slideshowImages.length;
        updateSlide();
    }

    /* Export only the two navigation functions — everything else stays private */
    window.slideshowNext = slideshowNext;
    window.slideshowPrev = slideshowPrev;
}());
