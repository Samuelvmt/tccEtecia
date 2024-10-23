<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<?php
// Verificando se a conexão foi bem-sucedida
if ($connect->connect_error) {
    die("Erro na conexão: " . $connect->connect_error);
}
// Realizando a consulta
$query = "SELECT * FROM tbMatricula WHERE login = '$login' AND senha = '$senha'";
$verifica = $connect->query($query);

// Verificando o resultado da consulta
if ($verifica->num_rows <= 0) {
    echo "<script>alert('Login ou senha incorretos'); window.location.href='login.php';</script>";
    exit();
} else {
    setcookie("login", $login);
    header("Location: ../aluno.php");
    exit(); // É importante usar exit() após header()
}
// Fechando a conexão
$connect->close();
?>
</body>
</html>
