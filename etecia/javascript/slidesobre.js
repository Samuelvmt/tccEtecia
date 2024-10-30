let slideIndex = 1;
let slideInterval;
showSlides(slideIndex);

// Função para mostrar os slides
function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slide-sobre");
    let dots = document.getElementsByClassName("dot");

    // Ajusta o índice do slide
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }

    // Oculta todos os slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    
    // Remove a classe ativa de todos os pontos
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Mostra o slide atual
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

// Função para avançar os slides
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Função para mostrar o slide atual
function currentSlide(n) {
    showSlides(slideIndex = n);
}

// Iniciar a apresentação de slides automática
function startSlideShow() {
    slideInterval = setInterval(() => {
        plusSlides(1); // Avança para o próximo slide
    }, 4000); // Troca a cada 4 segundos
}

// Parar a apresentação de slides automática
function stopSlideShow() {
    clearInterval(slideInterval);
}

// Adiciona eventos de mouse para pausar e reiniciar o slideshow
const slideContainer = document.querySelector('.slide-sobre-container');
slideContainer.addEventListener('mouseover', stopSlideShow);
slideContainer.addEventListener('mouseout', startSlideShow);

// Iniciar o slideshow automático após o DOM estar carregado
document.addEventListener("DOMContentLoaded", () => {
    showSlides(slideIndex);
    startSlideShow();
});
