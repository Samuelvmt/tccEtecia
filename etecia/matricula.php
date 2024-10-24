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

$squery = "SELECT m.mat_id, m.id AS aluno_id, a.data AS mat_data
        FROM tbMatricula m 
        LEFT JOIN tbAluno a ON u.id_aluno = a.aluno_id";

$verifica = $connect->query($squery);

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
