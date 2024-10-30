<?php
session_start();

// Configuração da conexão ao banco de dados
$servername = "localhost";
$username = "etecia1";
$password = "1234567";
$dbname = "dbEscola";

// Cria a conexão
$connect = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($connect->connect_error) {
    die("Conexão falhou: " . $connect->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['id_aluno'])) {
    header("Location: login.php");
    exit();
}

// Verifica se um arquivo foi enviado
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $id_usuario_especifico = $_SESSION['id_aluno'];
    $imagem = $_FILES['imagem'];

    // Define o caminho para onde a imagem será salva
    $diretorio = 'uploads/'; // Crie esta pasta no seu servidor
    $caminho_imagem = $diretorio . basename($imagem['name']);

    // Move o arquivo para o diretório especificado
    if (move_uploaded_file($imagem['tmp_name'], $caminho_imagem)) {
        // Prepare a query para armazenar o caminho da imagem no banco de dados
        $stmt = $connect->prepare("UPDATE tbAluno SET foto = ? WHERE aluno_id = ?");
        $stmt->bind_param("si", $caminho_imagem, $id_usuario_especifico);
        
        if ($stmt->execute()) {
            echo "Imagem enviada com sucesso!";
        } else {
            echo "Erro ao salvar no banco de dados.";
        }
        
        $stmt->close();
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
} else {
    echo "Nenhum arquivo enviado ou houve um erro no upload.";
}

// Fecha a conexão
$connect->close();
?>
