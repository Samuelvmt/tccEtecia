// Funções comuns para o slideshow
let slideIndexHome = 0;
let slideIntervalHome;

let slideIndexSobre = 0;
let slideIntervalSobre;

function showSlides(slides, dots, index) {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; // Oculta todos os slides
        if (dots[i]) {
            dots[i].classList.remove("active"); // Remove a classe ativa dos pontos
        }
    }
    slides[index].style.display = "block"; // Mostra o slide atual
    if (dots[index]) {
        dots[index].classList.add("active"); // Marca o ponto ativo
    }
}

function startSlideShow(slides, dots, index) {
    return setInterval(() => {
        index = (index + 1) % slides.length; // Avança para o próximo slide
        showSlides(slides, dots, index);
    }, 4000); // Troca a cada 4 segundos
}

function stopSlideShow(interval) {
    clearInterval(interval);
}

function plusSlides(n, slides, dots, index, interval) {
    stopSlideShow(interval); // Para a troca automática
    index = (index + n + slides.length) % slides.length; // Calcula o novo índice
    showSlides(slides, dots, index);
    return { index, interval: startSlideShow(slides, dots, index) }; // Reinicia a troca automática
}

// Inicialização do slideshow para a página Home
document.addEventListener("DOMContentLoaded", () => {
    const homeSlides = document.getElementsByClassName("slide-home");
    const homeDots = document.getElementsByClassName("dotz");

    showSlides(homeSlides, homeDots, slideIndexHome);
    slideIntervalHome = startSlideShow(homeSlides, homeDots, slideIndexHome);

    document.querySelector('.btnPrev').addEventListener('click', () => {
        ({ index: slideIndexHome, interval: slideIntervalHome } = plusSlides(-1, homeSlides, homeDots, slideIndexHome, slideIntervalHome));
    });

    document.querySelector('.btnNext').addEventListener('click', () => {
        ({ index: slideIndexHome, interval: slideIntervalHome } = plusSlides(1, homeSlides, homeDots, slideIndexHome, slideIntervalHome));
    });
});

// Inicialização do slideshow para a página Sobre
document.addEventListener("DOMContentLoaded", () => {
    const sobreSlides = document.getElementsByClassName("slide-sobre");
    const sobreDots = document.getElementsByClassName("dot");

    showSlides(sobreSlides, sobreDots, slideIndexSobre);
    slideIntervalSobre = startSlideShow(sobreSlides, sobreDots, slideIndexSobre);

    const slideContainerSobre = document.querySelector('.slide-sobre-container');

    slideContainerSobre.addEventListener('mouseover', () => stopSlideShow(slideIntervalSobre));
    slideContainerSobre.addEventListener('mouseout', () => {
        slideIntervalSobre = startSlideShow(sobreSlides, sobreDots, slideIndexSobre);
    });
});
