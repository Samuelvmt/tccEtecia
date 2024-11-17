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
<body class="lBody">
    <main class="lMain">
        <h2>Redefinir Senha</h2>
        <form action="atualizar_senha.php" method="post" class="lForm">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <label for="senha">Nova Senha:</label>
            <input type="password" name="senha" id="senha" required>
            <button type="submit" class="lButton">Redefinir Senha</button>
        </form>
    </main>
</body>
</html>
