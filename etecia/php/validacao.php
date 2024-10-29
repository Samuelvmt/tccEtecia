<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<?php
$login = isset($_POST["login"]) ? $_POST["login"] : '';
$entrar = isset($_POST["entrar"]);
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

// Estabelecendo a conexão com o banco de dados
$connect = new mysqli("localhost", "etecia1", "1234567", "dbEscola");

// Verificando se a conexão foi bem-sucedida
if ($connect->connect_error) {
    die("Erro na conexão: " . $connect->connect_error);
}

// Verificando campos vazios
if (empty($login)) {
    echo "<script>alert('O campo login deve ser preenchido'); window.location.href='login.php';</script>";
    exit();
}

if (empty($senha)) {
    echo "<script>alert('O campo senha deve ser preenchido'); window.location.href='login.php';</script>";
    exit();
}

// Protegendo contra injeção SQL
$login = $connect->real_escape_string($login);
$senha = $connect->real_escape_string($senha);

// Realizando a consulta para verificar usuário
$query = "SELECT * FROM tbUsuario WHERE login = '$login' AND senha = '$senha'";
$verifica = $connect->query($query);

// Verificando o resultado da consulta
if ($verifica->num_rows <= 0) {
    echo "<script>alert('Login ou senha incorretos'); window.location.href='login.php';</script>";
    exit();
} else {
    // Pegando os dados do usuário
    $usuario = $verifica->fetch_assoc();
    $id_usuario = $usuario['id_aluno']; // Pegando o ID do aluno

    // Armazenando dados na sessão
    session_start();
    $_SESSION['id_aluno'] = $id_usuario;

    // Redirecionando para a página do aluno
    header("Location: ../aluno.php?id=" . $id_usuario);
    exit(); // É importante usar exit() após header()
}

// Fechando a conexão
$connect->close();
?>
</body>
</html>
