<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <script src="javascript/slides.js" defer></script>
    <script src="javascript/function.js" defer></script>
</head>

<body>
    <div>
        <h2>Recuperar Senha</h2>
        <form action="php/enviar_email.php" method="post" class="lForm">
            <label for="email">Digite seu e-mail:</label>
            <input type="email" name="email" id="email" required>
            <button type="submit" class="lButton">Enviar</button>
        </form>
    </div>
</body>

</html>