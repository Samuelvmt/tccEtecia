<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nova_senha = $_POST['senha'];

    // Estabelecendo a conexão com o banco de dados
    $connect = new mysqli("localhost", "etecia1", "1234567", "dbEscola");

    // Verificando se a conexão foi bem-sucedida
    if ($connect->connect_error) {
        die("Erro na conexão: " . $connect->connect_error);
    }

    // Protegendo contra injeção SQL
    $token = $connect->real_escape_string($token);
    $nova_senha = $connect->real_escape_string($nova_senha);

    // Verificando o token
    $query = "SELECT id_aluno FROM tbUsuario WHERE token = '$token'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        // Atualizar a senha
        $usuario = $result->fetch_assoc();
        $id_usuario = $usuario['id_aluno'];
        $query = "UPDATE tbUsuario SET senha='$nova_senha', token=NULL WHERE id_aluno='$id_usuario'";
        $connect->query($query);

        echo "Senha redefinida com sucesso.";
    } else {
        echo "Token inválido.";
    }

    // Fechando a conexão
    $connect->close();
}
?>
