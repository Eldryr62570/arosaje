const slides = document.querySelectorAll('#slider div');
const choices = document.querySelectorAll('#choice-slide div');
var activeSlide = 0;
const nbslide = 4;
const timeInterval = 5000; //mill
const changeSlide = () => {
    if (activeSlide < 3) {
        slides[activeSlide].classList.toggle("active-slide");
        slides[activeSlide + 1].classList.toggle("active-slide");
        choices[activeSlide].classList.toggle("bg-rose-500");
        choices[activeSlide + 1].classList.toggle("bg-rose-500");
        activeSlide++;
    } else {
        slides[activeSlide].classList.toggle("active-slide");
        slides[0].classList.toggle("active-slide");
        choices[activeSlide].classList.toggle("bg-rose-500");
        choices[0].classList.toggle("bg-rose-500");
        activeSlide = 0;
    }
};

let slideInterval = window.setInterval(changeSlide, timeInterval);
choices.forEach(choice => {
    choice.addEventListener("click", function () {
        slides[activeSlide].classList.toggle("active-slide");
        slides[parseInt(choice.dataset.id)].classList.toggle("active-slide");
        choices[activeSlide].classList.toggle("bg-rose-500");
        choices[parseInt(choice.dataset.id)].classList.toggle("bg-rose-500");
        activeSlide = parseInt(choice.dataset.id);
        window.clearInterval(slideInterval);
        slideInterval = window.setInterval(changeSlide, timeInterval);
    })
});