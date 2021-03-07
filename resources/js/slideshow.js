let slideIndex = 0;
document.addEventListener("load", () => {
    showSlide(0)
})

// Next/previous controls
function changeSlides(delta) {
    showSlide(slideIndex += delta);
}

// Thumbnail image controls
function toSlide(index) {
    showSlide(slideIndex = index);
}

function showSlide(index) {
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");

    if (index < 0) {
        slideIndex = index + slides.length;
    }
    if (index >= slides.length) {
        slideIndex = index - slides.length;
    }

    // Reset slides
    for (let i = 0 ; i < slides.length ; i++) {
        slides[i].classList.remove("slide-active");
    }
    for (let i = 0 ; i < dots.length ; i++) {
        dots[i].classList.remove("dot-active");
    }

    // Display current
    slides[slideIndex].classList.add("slide-active");
    dots[slideIndex].classList.add("dot-active");
}