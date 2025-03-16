
document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll('.slides');
    const dots = document.querySelectorAll('.dot');
    
    let index = 0;

    // Adding opacity to first dot initially
    dots[0].style.opacity = '1';

    // Positioning the slides
    slides.forEach((slide, idx) => {
        slide.style.left = `${idx * 100}%`;
    });

    // Move slide function
    const moveSlide = () => {
        slides.forEach((slide) => {
            slide.style.transform = `translateX(-${index * 100}%)`;
        });
    };

    // Remove dots opacity from all dots
    const removeDotsOpacity = () => {
        dots.forEach((dot) => {
            dot.style.opacity = '0.2';
        });
    };

    dots.forEach((dot, i) => {
        dot.addEventListener("click", (e) => {
            index = i;
            removeDotsOpacity();
            e.target.style.opacity = '1';
            moveSlide();
        });
    });

    // Auto play slide
    const autoPlaySlide = () => {
        removeDotsOpacity();
        if (index === slides.length - 1) index = -1;
        index++;
        dots[index].style.opacity = '1';
        moveSlide();
    };

    setInterval(autoPlaySlide, 6000);
});
