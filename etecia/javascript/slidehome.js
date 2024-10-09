let slideIndex = 0;
let slideInterval;
const slides = document.getElementsByClassName("slide-home");
const dots = document.getElementsByClassName("dotz");

function showSlides() {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        dots[i].classList.remove("active");
    }
    slides[slideIndex].style.display = "block";
    dots[slideIndex].classList.add("active");
}

function startSlideShow() {
    slideInterval = setInterval(() => {
        slideIndex = (slideIndex + 1) % slides.length; // Muda para o próximo slide
        showSlides();
    }, 4000); // muda imagem a cada quatro segundos
}

function stopSlideShow() {
    clearInterval(slideInterval);
}

function plusSlides(n) {
    stopSlideShow(); // Para a troca automática
    slideIndex = (slideIndex + n + slides.length) % slides.length; // Calcula o novo índice
    showSlides();
    startSlideShow(); // Reinicia a troca automática
}

document.addEventListener("DOMContentLoaded", () => {
    showSlides();
    startSlideShow();
});
