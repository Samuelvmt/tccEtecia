<?php
session_start();

// Limpar as variáveis de sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Remover cookies
setcookie('login', '', time() - 3600, "/");
setcookie('senha', '', time() - 3600, "/");
setcookie('lembrar', '', time() - 3600, "/");

// Redirecionar para a página de login
header("Location: login.php");
exit();
?>
