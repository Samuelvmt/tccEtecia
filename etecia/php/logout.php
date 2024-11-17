<?php
session_start();
session_unset();
session_destroy();

// Remove os cookies se estiverem definidos
setcookie('login', '', time() - 3600, "/");
setcookie('senha', '', time() - 3600, "/");
setcookie('lembrar', '', time() - 3600, "/");

// Redireciona para a página de login
header("Location: ../login.php");
exit();
?>
