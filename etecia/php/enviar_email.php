<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Estabelecendo a conexão com o banco de dados
    $connect = new mysqli("localhost", "etecia1", "1234567", "dbEscola");

    // Verificando se a conexão foi bem-sucedida
    if ($connect->connect_error) {
        die("Erro na conexão: " . $connect->connect_error);
    }

    // Verificando se o e-mail está registrado
    $email = $connect->real_escape_string($email);
    $query = "SELECT id_aluno FROM tbUsuario WHERE email = '$email'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        // Gerar token de recuperação
        $token = bin2hex(random_bytes(50));
        $query = "UPDATE tbUsuario SET token='$token' WHERE email='$email'";
        $connect->query($query);

        // Enviar e-mail com o link de recuperação
        $link = "https://seusite.com/redefinir_senha.php?token=" . $token;
        $assunto = "Redefinição de Senha";
        $mensagem = "Clique no link para redefinir sua senha: " . $link;
        $headers = "From: centroedhorizonte@gmail.com\r\n";
        mail($email, $assunto, $mensagem, $headers);

        echo "Um link de redefinição de senha foi enviado para seu e-mail.";
    } else {
        echo "E-mail não encontrado.";
    }

    // Fechando a conexão
    $connect->close();
}
?>
