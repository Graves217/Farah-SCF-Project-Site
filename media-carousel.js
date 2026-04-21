(function () {
    var carousel = document.querySelector("[data-carousel]");
    if (!carousel) {
        return;
    }

    var slides = Array.from(carousel.querySelectorAll("[data-carousel-slide]"));
    var prevButton = carousel.querySelector("[data-carousel-prev]");
    var nextButton = carousel.querySelector("[data-carousel-next]");
    var dotsContainer = carousel.querySelector("[data-carousel-dots]");

    if (!slides.length || !prevButton || !nextButton || !dotsContainer) {
        return;
    }

    var currentIndex = 0;
    var dots = [];

    function showSlide(index) {
        var nextIndex = index;
        if (nextIndex < 0) {
            nextIndex = slides.length - 1;
        } else if (nextIndex >= slides.length) {
            nextIndex = 0;
        }
        currentIndex = nextIndex;

        slides.forEach(function (slide, slideIndex) {
            var isActive = slideIndex === currentIndex;
            slide.classList.toggle("is-active", isActive);
            slide.setAttribute("aria-hidden", isActive ? "false" : "true");
        });

        dots.forEach(function (dot, dotIndex) {
            dot.setAttribute("aria-current", dotIndex === currentIndex ? "true" : "false");
        });
    }

    slides.forEach(function (_, index) {
        var dot = document.createElement("button");
        dot.type = "button";
        dot.className = "carousel__dot";
        dot.setAttribute("aria-label", "Go to slide " + (index + 1));
        dot.addEventListener("click", function () {
            showSlide(index);
        });
        dotsContainer.appendChild(dot);
        dots.push(dot);
    });

    prevButton.addEventListener("click", function () {
        showSlide(currentIndex - 1);
    });

    nextButton.addEventListener("click", function () {
        showSlide(currentIndex + 1);
    });

    carousel.addEventListener("keydown", function (event) {
        if (event.target !== carousel) {
            return;
        }

        if (event.key === "ArrowLeft") {
            event.preventDefault();
            showSlide(currentIndex - 1);
        } else if (event.key === "ArrowRight") {
            event.preventDefault();
            showSlide(currentIndex + 1);
        }
    });

    showSlide(0);
})();
