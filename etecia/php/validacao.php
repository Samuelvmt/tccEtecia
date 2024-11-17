<?php
session_start();

// Verifica se já existe uma sessão ativa
if (isset($_SESSION['id_aluno'])) {
    header("Location: ../aluno.php?id=" . $_SESSION['id_aluno']);
    exit();
}

// Verifica se os cookies estão definidos
if (isset($_COOKIE['login']) && isset($_COOKIE['senha'])) {
    $login = $_COOKIE['login'];
    $senha = $_COOKIE['senha'];
    $lembrar = isset($_COOKIE['lembrar']);

    // Estabelecendo a conexão com o banco de dados
    $connect = new mysqli("localhost", "etecia1", "1234567", "dbEscola");

    // Verificando se a conexão foi bem-sucedida
    if ($connect->connect_error) {
        die("Erro na conexão: " . $connect->connect_error);
    }

    // Protegendo contra injeção SQL
    $login = $connect->real_escape_string($login);
    $senha = $connect->real_escape_string($senha);

    // Realizando a consulta para verificar usuário
    $query = "SELECT * FROM tbUsuario WHERE login = '$login' AND senha = '$senha'";
    $verifica = $connect->query($query);

    // Verificando o resultado da consulta
    if ($verifica->num_rows > 0) {
        // Pegando os dados do usuário
        $usuario = $verifica->fetch_assoc();
        $id_usuario = $usuario['id_aluno'];

        // Armazenando dados na sessão
        $_SESSION['id_aluno'] = $id_usuario;

        // Redirecionando para a página do aluno
        header("Location: ../aluno.php?id=" . $id_usuario);
        exit();
    }

    // Fechando a conexão
    $connect->close();
}

// Se os cookies não estiverem definidos, verificar os dados do formulário
$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';
$lembrar = isset($_POST['remember']);

// Estabelecendo a conexão com o banco de dados
$connect = new mysqli("localhost", "etecia1", "1234567", "dbEscola");

// Verificando se a conexão foi bem-sucedida
if ($connect->connect_error) {
    die("Erro na conexão: " . $connect->connect_error);
}

// Verificando campos vazios
if (empty($login) || empty($senha)) {
    echo "<script>alert('Os campos login e senha devem ser preenchidos.'); window.location.href='../login.php';</script>";
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
    echo "<script>alert('Login ou senha incorretos.'); window.location.href='../login.php';</script>";
    exit();
} else {
    // Pegando os dados do usuário
    $usuario = $verifica->fetch_assoc();
    $id_usuario = $usuario['id_aluno'];

    // Armazenando dados na sessão
    $_SESSION['id_aluno'] = $id_usuario;

    // Se o checkbox "lembrar" estiver marcado, cria os cookies
    if ($lembrar) {
        setcookie('login', $login, time() + (86400 * 30), "/"); // 30 dias
        setcookie('senha', $senha, time() + (86400 * 30), "/"); // 30 dias
        setcookie('lembrar', 'true', time() + (86400 * 30), "/"); // Cookie para manter conectado
    } else {
        // Remove os cookies se "lembrar" não estiver marcado
        setcookie('login', '', time() - 3600, "/");
        setcookie('senha', '', time() - 3600, "/");
        setcookie('lembrar', '', time() - 3600, "/");
    }

    // Redirecionando para a página do aluno
    header("Location: ../aluno.php?id=" . $id_usuario);
    exit();
}

// Fechando a conexão
$connect->close();
?>
