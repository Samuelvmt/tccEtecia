<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_aluno'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto_perfil'])) {
    $id_aluno = $_SESSION['id_aluno'];
    $foto_perfil = $_FILES['foto_perfil'];

    // Diretório onde as imagens serão armazenadas
    $diretorio_upload = 'uploads/fotos_perfil/';
    if (!is_dir($diretorio_upload)) {
        mkdir($diretorio_upload, 0777, true);
    }

    // Gera um nome único para a imagem
    $extensao = pathinfo($foto_perfil['name'], PATHINFO_EXTENSION);
    $nome_arquivo = $id_aluno . '_' . time() . '.' . $extensao;
    $caminho_arquivo = $diretorio_upload . $nome_arquivo;

    // Move o arquivo para o diretório de upload
    if (move_uploaded_file($foto_perfil['tmp_name'], $caminho_arquivo)) {
        // Estabelece a conexão com o banco de dados
        $servername = "localhost";
        $username = "etecia1";
        $password = "1234567";
        $dbname = "dbEscola";

        $connect = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($connect->connect_error) {
            die("Erro na conexão: " . $connect->connect_error);
        }

        // Atualiza o campo foto_perfil na tabela tbAluno
        $stmt = $connect->prepare("UPDATE tbAluno SET foto_perfil = ? WHERE aluno_id = ?");
        $stmt->bind_param("si", $caminho_arquivo, $id_aluno);
        if ($stmt->execute()) {
            echo "Foto de perfil atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a foto de perfil.";
        }

        $stmt->close();
        $connect->close();
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
} else {
    echo "Nenhum arquivo foi enviado.";
}
?>
