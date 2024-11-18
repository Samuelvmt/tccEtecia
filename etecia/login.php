<?php
session_start();

// Verifica se já existe uma sessão ativa
if (isset($_SESSION['id_aluno'])) {
    header("Location: aluno.php");
    exit();
}

// Verifica se os cookies estão definidos
if (isset($_COOKIE['login']) && isset($_COOKIE['senha'])) {
    header("Location: php/validacao.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <script src="javascript/function.js" defer></script>
    <title>Escola | Login</title>
</head>
<body class="lBody">
  <main class="lMain">
    <img src="images/horizons.png" class="lLogo">

    <form action="php/validacao.php" method="post" class="lForm" style="background-color: rgba(0, 0, 0, 0.8);">
      <div class="imgcontainer">
        <img src="images/avatar.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">
        <label for="login" class="lLabel"><b>Digite seu RM:</b></label>
        <input type="text" placeholder="RM" class="lInput" name="login" id="login" required>
        <br>
        <label for="senha" class="lLabel"><b>Senha:</b></label>
        <input type="password" placeholder="Senha" class="lInput" name="senha" id="senha" required>
        <br>
        <button type="submit" class="lButton" value="entrar" id="entrar" name="entrar">Entrar</button>
        <br>
        <label class="checkboxLabel">
          <input type="checkbox" checked="checked" name="remember" class="lInput"> Lembrar login e senha
        </label>
      </div>

      <div class="container">
        <span class="psw"><a href="recuperar_senha.php" class="hreSpan">Esqueceu a senha?</a></span>
      </div>
          </div>
        </div>
      </div>
    </form>
  </main>
</body>
</html>
