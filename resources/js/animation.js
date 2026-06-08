document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".marquee-track");
    if (!track) return;
    const slides = document.querySelectorAll(".marquee-track a");

    slides.forEach(slide => {
        const clone = slide.cloneNode(true);
        track.appendChild(clone);
    });

    const allSlides = document.querySelectorAll(".marquee-track a");
    const total = allSlides.length;
    let index = 0;

    const updateSlider = (animate = true) => {
        if (!animate) {
            track.style.transition = "none";
        } else {
            track.style.transition = "transform 0.7s ease";
        }

        track.style.transform = `translateX(-${index * 100}%)`;
    };

    setInterval(() => {
        index++;

        updateSlider(true);
        if (index >= slides.length) {
            setTimeout(() => {
                index = 0;
                updateSlider(false);
            }, 500);
        }

    }, 4000);
});
