<?php
// Conexão ao banco de dados
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



// Defina o ID do usuário que você deseja buscar
$id_usuario_especifico = 'id'; // Altere este valor conforme necessário

// Query para selecionar os dados da tabela 'tbUsuario' e 'tbAluno'
$sql = "SELECT u.id_aluno, a.nome AS aluno_nome, a.rg AS rg
        FROM tbUsuario u 
        LEFT JOIN tbAluno a ON u.id_aluno = a.aluno_id
        WHERE u.id = $id_usuario_especifico";  // Busca específica

$result = $connect->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Começa a tabela HTML
    echo "<table border='1'>
            <tr>
                <th>ID Aluno</th>
                <th>Nome do Aluno</th>
                <th>RG</th>
            </tr>";

    // Loop para exibir os dados
    if($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_aluno"] . "</td>
                <td>" . $row["aluno_nome"] . "</td>
                <td>" . $row["rg"] . "</td>
              </tr>";
    }
    
    // Fecha a tabela
    echo "</table>";
} else {
    echo "0 resultados";
}

// Fecha a conexão
$connect->close();
?>
