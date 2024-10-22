<?php
$login = $_POST["login"];
$entrar = $_POST["entrar"];
$senha = $_POST['senha'];

// Estabelecendo a conexão com o banco de dados
$connect = new mysqli("localhost", "etecia", "123456", "dbEscola");

// Verificando se a conexão foi bem-sucedida
if ($connect->connect_error) {
    die("Erro na conexão: " . $connect->connect_error);
}

// Verificando campos vazios
if ($login == "" || $login == null) {
    echo "<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='login.html';</script>";
} else if ($senha == "" || $senha == null) {
    echo "<script language='javascript' type='text/javascript'>
    alert('O campo senha deve ser preenchido');window.location.href='login.html';</script>";
} else if (isset($entrar)) {
    // Realizando a consulta
    $verifica = $connect->query("SELECT * FROM tbUsuario WHERE login = '$login' AND senha = '$senha'");

    // Verificando o resultado da consulta
    if ($verifica->num_rows <= 0) {
        echo "<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
        die();
    } else {
        setcookie("login", $login);
        header("Location: teste.php");
        exit(); // É importante usar exit() após header()
    }
}

// Fechando a conexão
$connect->close();
?>
