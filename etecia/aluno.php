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

    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Aluno')" id="defaultOpen">Aluno</button>
        <button class="tablinks" onclick="openCity(event, 'Boletim')">Boletim</button>

    </div>

    <div class="conexaoAluno ">
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

        // ID do aluno armazenado na sessão
        $id_usuario_especifico = $_SESSION['id_aluno'];
        ?>
    </div>

    <div id="Aluno" class="tabcontent">
        <h3 class="pagina-aluno-titulo">Aluno</h3>
        <div class="dAluno nota">

   

            <?php
            // Query para selecionar os dados do aluno
            $stmt = $connect->prepare("
                SELECT a.nome AS aluno_nome, a.rg, a.cpf, a.data_nasc, a.sexo, a.endereco, a.email, a.tel_cel, a.nom_pai, a.nom_mae
                FROM tbAluno a
                JOIN tbUsuario u ON a.aluno_id = u.id_aluno
                WHERE u.id = ?
            ");
            $stmt->bind_param("i", $id_usuario_especifico);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se há resultados
            if ($result->num_rows > 0) {
                // Começa a tabela HTML
                echo "<table border='1'>
                      <tr class='infoTop'>
                          <th>Nome</th>
                          <th>RG</th>
                          <th>CPF</th>
                          <th>Data de Nascimento</th>
                          <th>Sexo</th>
                          <th>Endereço</th>
                          <th>Email</th>
                          <th>Telefone</th>
                          <th>Nome do Pai</th>
                          <th>Nome da Mãe</th>
                      </tr>";
                // Loop para exibir os dados
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='infoBot'>
                            <td>" . htmlspecialchars($row["aluno_nome"]) . "</td>
                            <td>" . htmlspecialchars($row["rg"]) . "</td>
                            <td>" . htmlspecialchars($row["cpf"]) . "</td>
                            <td>" . htmlspecialchars($row["data_nasc"]) . "</td>
                            <td>" . htmlspecialchars($row["sexo"]) . "</td>
                            <td>" . htmlspecialchars($row["endereco"]) . "</td>
                            <td>" . htmlspecialchars($row["email"]) . "</td>
                            <td>" . htmlspecialchars($row["tel_cel"]) . "</td>
                            <td>" . htmlspecialchars($row["nom_pai"]) . "</td>
                            <td>" . htmlspecialchars($row["nom_mae"]) . "</td>
                          </tr>";
                }
                // Fecha a tabela
                echo "</table>";
            } else {
                echo "0 resultados";
            }

            // Fecha o statement
            $stmt->close();
            ?>
        </div>
    </div>

    <div id="Boletim" class="tabcontent">
        <h3 class="pagina-aluno-titulo">Boletim</h3>
        <div class="dAluno ">
            <?php
            // Query para selecionar os dados do boletim
            $stmt = $connect->prepare("
                SELECT a.nome AS aluno_nome, d.nome AS disciplina_nome, 
                       nf.nota, nf.data_falta
                FROM tbMatricula m
                JOIN tbAluno a ON m.aluno_id = a.aluno_id
                JOIN tbNotasFaltas nf ON m.mat_id = nf.mat_id
                JOIN tbDisciplina d ON m.disc_id = d.disc_id
                WHERE m.aluno_id = ?
            ");
            $stmt->bind_param("i", $id_usuario_especifico);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se há resultados
            if ($result->num_rows > 0) {
                // Começa a tabela HTML
                echo "<table border='1'>
                      <tr>
                          <th>Aluno</th>
                          <th>Disciplina</th>
                          <th>Nota</th>
                          <th>Data da Falta</th>
                      </tr>";
                // Loop para exibir os dados
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["aluno_nome"]) . "</td>
                            <td>" . htmlspecialchars($row["disciplina_nome"]) . "</td>
                            <td>" . htmlspecialchars($row["nota"] ?? 'N/A') . "</td>
                            <td>" . htmlspecialchars($row["data_falta"] ?? 'N/A') . "</td>
                          </tr>";
                }
                // Fecha a tabela
                echo "</table>";
            } else {
                echo "0 resultados";
            }

            // Fecha o statement
            $stmt->close();
            ?>
        </div>
    </div>

</main>
</body>
</html>
