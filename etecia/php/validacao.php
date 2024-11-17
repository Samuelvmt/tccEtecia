<?php
session_start();

// Verifica se já existe uma sessão ativa
if (isset($_SESSION['id_aluno'])) {
    header("Location: ../aluno.php?id=" . $_SESSION['id_aluno']);
    exit();
}

// Função para conectar ao banco de dados
function conectarBancoDados() {
    $connect = new mysqli("localhost", "etecia1", "1234567", "dbEscola");
    if ($connect->connect_error) {
        die("Erro na conexão: " . $connect->connect_error);
    }
    return $connect;
}

// Função para verificar usuário e definir sessão
function verificarUsuario($login, $senha, $lembrar) {
    $connect = conectarBancoDados();
    $login = $connect->real_escape_string($login);
    $senha = $connect->real_escape_string($senha);

    $query = "SELECT * FROM tbUsuario WHERE login = '$login' AND senha = '$senha'";
    $verifica = $connect->query($query);

    if ($verifica->num_rows > 0) {
        $usuario = $verifica->fetch_assoc();
        $id_usuario = $usuario['id_aluno'];
        $_SESSION['id_aluno'] = $id_usuario;

        if ($lembrar) {
            setcookie('login', $login, time() + (86400 * 30), "/");
            setcookie('senha', $senha, time() + (86400 * 30), "/");
            setcookie('lembrar', 'true', time() + (86400 * 30), "/");
        } else {
            setcookie('login', '', time() - 3600, "/");
            setcookie('senha', '', time() - 3600, "/");
            setcookie('lembrar', '', time() - 3600, "/");
        }

        header("Location: ../aluno.php?id=" . $id_usuario);
        exit();
    }

    $connect->close();
}

// Verifica se os cookies estão definidos
if (isset($_COOKIE['login']) && isset($_COOKIE['senha'])) {
    $login = $_COOKIE['login'];
    $senha = $_COOKIE['senha'];
    $lembrar = isset($_COOKIE['lembrar']);
    verificarUsuario($login, $senha, $lembrar);
}

// Verifica os dados do formulário
$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';
$lembrar = isset($_POST['remember']);

if (empty($login) || empty($senha)) {
    echo "<script>alert('Os campos login e senha devem ser preenchidos.'); window.location.href='../login.php';</script>";
    exit();
}

verificarUsuario($login, $senha, $lembrar);

?>
