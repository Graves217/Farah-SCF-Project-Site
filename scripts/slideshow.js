/* External JavaScript Slideshow
 * Source: Original code based on standard JavaScript image carousel techniques;
 *         concepts drawn from w3schools.com/howto/howto_js_slideshow.asp and
 *         adapted significantly for this portfolio.
 * What it does: Provides manual prev/next navigation for an image slideshow
 *               displayed on js.htm (Item #7). Images and captions are customized
 *               to reflect Anthony Farah's personal IT portfolio projects.
 * Usage: Attached from js.htm via
 *        <script src="scripts/slideshow.js" type="text/javascript"></script>
 */

var slideshowImages = [
    { src: "images/My_PC_Build.JPEG",    caption: "My Custom PC Build"          },
    { src: "images/WIFE_PC_BUILD.jpg",   caption: "Alison's Custom PC Build"    },
    { src: "images/Wife_Desk_Setup.jpg", caption: "Alison's Custom Desk Setup"  },
    { src: "images/Jake_Desk_Setup.jpg", caption: "Jake V.'s Home Desk Setup"   },
    { src: "images/SCFenter.jpg",        caption: "State College of Florida"    },
    { src: "images/DUMAOS.jpg",          caption: "DumaOS Network Management"   }
];

var currentSlideIndex = 0;

/* updateSlide: Refreshes the slideshow image and caption to match currentSlideIndex */
function updateSlide() {
    var img = document.getElementById('slideshowImg');
    var cap = document.getElementById('slideshowCaption');
    if (!img || !cap) return;
    img.src       = slideshowImages[currentSlideIndex].src;
    img.alt       = slideshowImages[currentSlideIndex].caption;
    cap.innerHTML = "<strong>" + slideshowImages[currentSlideIndex].caption + "</strong>";
}

/* slideshowNext: Advances to the next image, wrapping to the first when at the end */
function slideshowNext() {
    currentSlideIndex = (currentSlideIndex + 1) % slideshowImages.length;
    updateSlide();
}

/* slideshowPrev: Steps back to the previous image, wrapping to the last when at the start */
function slideshowPrev() {
    currentSlideIndex = (currentSlideIndex - 1 + slideshowImages.length) % slideshowImages.length;
    updateSlide();
}
