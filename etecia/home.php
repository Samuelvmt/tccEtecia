<!DOCTYPE html>
<html lang="pt-BR">
<?php
include_once 'php/conexao.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <script src="javascript/slides.js" defer></script>
    <script src="javascript/function.js" defer></script>
    <title>Escola | Home</title>
</head>

<body class="body-home">
    <!-- Slides de Imagens -->
    <main>
        <div class="slide-home-container">
            <div class="slide-home slide-homes dotz dot fade">
                <img src="images/escolaFrente.jpg" alt="Etecia Frente" style="width: 100%; height: 650px;">
            </div>
            <div class="slide-home slide-homes dotz dot fade">
                <img src="images/quadra.jpeg" alt="Etecia F" style="width: 100%; height: 650px;">
            </div>
            <div class="slide-home slide-homes dotz dot fade">
                <img src="images/echola.jpeg" alt="Back HD 2" style="width: 100%; height: 650px;">
            </div>
            <a class="btnPrev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="btnNext" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div class="footer">
            <nav class="footer-nav">
                <a href="https://www.instagram.com.br/" class="insta-link" target="_blank">
                    <img src="images/instagram.png" alt="link-instagram-etecia" height="70" width="70">
                </a>
                <a href="https://www.youtube.com.br/" class="yt-link" target="_blank">
                    <img src="images/youtube.png" alt="link-youtube-etecia" height="70" width="70">
                </a>
                <a href="home.php" class="index-link" target="iframe_b">
                    <img src="images/centroEducacionalHorizonte.png" alt="site-logo" class="logo">
                </a>
                <a href="https://www.saopaulo.sp.gov.br/" class="gov-link" target="_blank">
                    <img src="images/spbr.png" class="splink" alt="link-gov-br">
                </a>
            </nav>
        </div>
    </main>
</body>

</html>  