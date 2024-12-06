

let nextBtn = document.querySelector('.next');
let prevBtn = document.querySelector('.prev');
let slider = document.querySelector('.slider');
let sliderList = slider.querySelector('.list');
let thumbnail = document.querySelector('.thumbnail');
let autoSlideInterval;

// Function to move the slider and thumbnails in the specified direction
function moveSlider(direction) {
    let sliderItems = sliderList.querySelectorAll('.item');
    let thumbnailItems = thumbnail.querySelectorAll('.item');

    if (direction === 'next') {
        slider.classList.add('next');
        sliderList.appendChild(sliderItems[0]); // Move the first main item to the end
        thumbnail.appendChild(thumbnailItems[0]); // Move the first thumbnail to the end
    } else {
        slider.classList.add('prev');
        sliderList.prepend(sliderItems[sliderItems.length - 1]); // Move the last main item to the beginning
        thumbnail.prepend(thumbnailItems[thumbnailItems.length - 1]); // Move the last thumbnail to the beginning
    }

    // Remove transition classes after animation completes
    slider.addEventListener(
        'animationend',
        () => {
            slider.classList.remove('next', 'prev');
        },
        { once: true }
    );
}

// Automatic slide function
function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        moveSlider('next');
    }, 4000); // Slide every 3 seconds
}

// Stop auto-slide when manually clicked
function stopAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

// Event listeners for next and prev buttons
nextBtn.onclick = () => {
    stopAutoSlide();
    moveSlider('next');
};

prevBtn.onclick = () => {
    stopAutoSlide();
    moveSlider('prev');
};

// Start the automatic slider on load
startAutoSlide();

// Optional: Pause auto-slide on hover
slider.addEventListener('mouseover', () => clearInterval(autoSlideInterval));
slider.addEventListener('mouseout', startAutoSlide);
