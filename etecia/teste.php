<?php
// Conexão ao banco de dados
$servername = "localhost";
$username = "root";
$password = "sua_senha";
$dbname = "nome_do_banco";
 
// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
 
// Query para selecionar os dados da tabela 'Usuarios'
$sql = "SELECT id, nome, email FROM Usuarios";
$result = $conn->query($sql);
 
// Verifica se há resultados
if ($result->num_rows > 0) {
    // Começa a tabela HTML
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>";
    
    // Loop para exibir os dados
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["email"] . "</td>
              </tr>";
    }
    
    // Fecha a tabela
    echo "</table>";
} else {
    echo "0 resultados";
}
 
// Fecha a conexão
$conn->close();
?>