<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <script src="javascript/function.js" defer></script>
    <title>Escola</title>
</head>
<body>
<main class="mAluno">
<div class="conexaoAluno">
<div class="c">


<?php
// Conexão ao banco de dados
$servername = "localhost";
$username = "etecia1";
$password = "1234567";
$dbname = "dbEscola";

// Cria a conexão
$connect = new mysqli($servername, $username, $password, $dbname);
?>
</div>


<h2>Vertical Tabs</h2>
<p>Click on the buttons inside the tabbed menu:</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Aluno')" id="defaultOpen">Aluno</button>
  <button class="tablinks" onclick="openCity(event, 'Boletim')" >Boletim</button>
  <button class="tablinks" onclick="openCity(event, 'AulaseFaltas')">Aulas e faltas</button>
  <button class="tablinks" onclick="openCity(event, 'Matricula')">Matrícula</button>
</div>
<div id="Aluno" class="tabcontent">
  <h3>Aluno</h3>
</div>
<div id="Boletim" class="tabcontent">
  <h3>Boletim</h3>
<div class="dAluno">
<?php
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
          <th>Componente curricular</th>
          <th>Aulas dadas</th>
          <th>Faltas</th>
          <th>Faltas permitidas</th>
          <th>Frequência total</th>
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
</div>
</div>
<div id="AulaseFaltas" class="tabcontent">
  <h3>Aulas e faltas</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>
<div id="Matricula" class="tabcontent">
  <h3>Matrícula</h3>
  <div class="c">
<div class="dAluno">

<?php
// Conexão ao banco de dados
$servername = "localhost";
$username = "etecia1";
$password = "1234567";
$dbname = "dbEscola";

// Cria a conexão
$connect = new mysqli($servername, $username, $password, $dbname);
?>
</div>

<?php
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
</div>
</div>
</div>
</main>
</body>
</html>