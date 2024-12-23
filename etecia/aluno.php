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

        <div class="tab logout-container">
            <button class="tablinks" onclick="openCity(event, 'Aluno')" id="defaultOpen">Aluno</button>
            <button class="tablinks" onclick="openCity(event, 'Boletim')">Boletim</button>
            <!-- Botão de Encerrar Sessão -->
            <form action="php/logout.php" method="post">
                <button type="submit" class="logout-button">Desconectar</button>
            </form>
        </div>

        <div class="conexaoAluno">
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

            <?php
            $stmts = $connect->prepare("SELECT foto_perfil FROM tbAluno WHERE aluno_id = ?");
            $stmts->bind_param("i", $id_usuario_especifico);
            $stmts->execute();
            $result = $stmts->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $foto_perfil = $row['foto_perfil'];
                if (!empty($foto_perfil)) {
                    $caminho_absoluto = 'http://localhost/tccetecia/etecia/php/' . $foto_perfil;
                    echo '<img src="' . htmlspecialchars($caminho_absoluto) . '" alt="Foto de Perfil" class="profile-picture" />';
                } else {
                    echo '<img src="images/avatar.png" alt="Foto de Perfil Padrão" class="profile-picture" />';
                }
            } else {
                echo '<img src="images/avatar.png" alt="Foto de Perfil Padrão" class="profile-picture" />';
            }
            $stmts->close();
            ?>

            <div class="mids">
                <button type="button" onclick="document.getElementById('id01').style.display='block'" class="tBtn" style="width:auto;">Selecione sua foto de perfil:</button>
                <div class="matric">

                    <?php
                    // Query para selecionar os dados do aluno
                    $stmt = $connect->prepare("
                SELECT m.mat_id, m.mat_data 
                FROM tbMatricula m 
                JOIN tbUsuario u ON m.aluno_id = u.id_aluno 
                WHERE u.id = ?
                ");
                    $stmt->bind_param("i", $id_usuario_especifico);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo "<table border='1'>
                          <tr class='infoTop'>
                              <th>Id</th>
                              <th>Data da matrícula</th>
                          </tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='infoBot'>
                                <td>" . htmlspecialchars($row["mat_id"]) . "</td>
                                <td>" . htmlspecialchars($row["mat_data"]) . "</td>
                              </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 resultados";
                    }
                    $stmt->close();
                    ?>
                </div>
            </div>
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
            <div class="dAluno">
                <?php
                // Query para selecionar os dados do boletim
                $stmt = $connect->prepare("
                SELECT a.nome AS aluno_nome, d.nome AS disciplina_nome, 
                       nf.nota, nf.frequen
                FROM tbMatricula m
                JOIN tbAluno a ON m.aluno_id = a.aluno_id
                JOIN tbNotasFaltas nf ON m.mat_id = nf.mat_id
                JOIN tbDisciplina d ON d.disc_id = nf.disc_id
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
                              <th>Disciplina</th>
                              <th>Nota</th>
                              <th>Frequência</th>
                          </tr>";
                    // Loop para exibir os dados
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["disciplina_nome"]) . "</td>
                                <td>" . htmlspecialchars($row["nota"] ?? 'N/A') . "</td>
                                <td>" . htmlspecialchars($row["frequen"] ?? 'N/A') . "%</td>
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
        <div class="terms">
            <div id="id01" class="modal">
                <div class="modal-content animate">

                    <p class="pagina-aluno-titulo">Atualizar Foto<br></p>
                    <div class="fotoUpload">
                        <form action="php/upload_foto.php" method="post" enctype="multipart/form-data">
                            <label for="foto_perfil">Selecione sua foto de perfil:</label>
                            <input type="file" name="foto_perfil" id="foto_perfil" required>
                            <button type="submit">Upload</button>
                    </div>

                    <div class="faixa" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="okbtn">Ok</button>
                    </div>
    </main>
</body>

</html>