<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
  <script src="function.js"></script>
  <title>Escola | Login</title>
</head>

<body class="lBody">
  <main class="lMain">
    <img src="images/horizons.png" class="lLogo">

    <form action="php/validacao.php" method="post" class="lForm" style="background-color: rgba(0, 0, 0, 0.8);">
      <div class="imgcontainer">
        <img src="images/avatar.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">
        <label for="login" class="lLabel"><b>Digite seu RM:</b></label>
        <input type="text" placeholder="RM" class="lInput" name="login" id="login" required>
        <br>
        <label for="senha" class="lLabel"><b>Senha:</b></label>
        <input type="password" placeholder="Senha" class="lInput" name="senha" id="senha" required>
        <br>
        <button type="submit" class="lButton" value="entrar" id="entrar" name="entrar">Entrar</button>
        <br>
        <label class="checkboxLabel">
          <input type="checkbox" checked="checked" name="remember" class="lInput"> Lembrar login e senha
        </label>
      </div>

      <div class="container">
        <button type="button" onclick="document.getElementById('id01').style.display='block'" class="tBtn" style="width:auto;">Termos de uso</button>
        <span class="psw"><a href="#" class="hreSpan">Esqueceu a senha?</a></span>
      </div>

      <div class="terms">
        <div id="id01" class="modal">
          <div class="modal-content animate">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            <p>Termos de Uso<br>
              1. Aceitação dos Termos: Ao acessar e utilizar este site, você concorda em cumprir e estar vinculado a estes Termos de Uso. Se você não concordar com qualquer parte dos termos, não utilize nosso site.<br>
              2. Alterações nos Termos: Reservamo-nos o direito de modificar estes Termos de Uso a qualquer momento. As alterações serão publicadas nesta página, e o uso continuado do site após qualquer alteração constitui sua aceitação dos novos termos.<br>
              3. Uso Aceitável: Você concorda em utilizar este site apenas para fins legais e de acordo com todas as leis e regulamentos aplicáveis. Você não deve:<br>
              Utilizar o site de maneira que possa causar danos ao site ou prejudicar a experiência de outros usuários.<br>
              Tentar obter acesso não autorizado a qualquer parte do site ou a qualquer sistema ou rede conectada ao site.<br>
              4. Propriedade Intelectual: Todo o conteúdo presente neste site, incluindo textos, gráficos, logos, ícones e imagens, é de propriedade do Centro Educacional Horizonte ou de seus fornecedores de conteúdo e está protegido por leis de direitos autorais e outras leis de propriedade intelectual.<br>
              5. Links para Outros Sites: Este site pode conter links para sites de terceiros. Não somos responsáveis pelo conteúdo ou pelas práticas de privacidade de sites de terceiros. A inclusão de qualquer link não implica endosso pelo Centro Educacional Horizonte do site vinculado.<br>
              6. Limitação de Responsabilidade: O Centro Educacional Horizonte não será responsável por quaisquer danos diretos, indiretos, incidentais, consequenciais ou punitivos decorrentes do uso ou incapacidade de uso deste site.<br>
              7. Privacidade: Sua privacidade é importante para nós. Consulte nossa Política de Privacidade para entender como coletamos, usamos e protegemos suas informações pessoais.<br>
              8. Uso de Cookies: Este site utiliza cookies para melhorar a experiência do usuário. Cookies são pequenos arquivos de texto que são armazenados no seu dispositivo quando você visita um site. Eles ajudam a lembrar de suas preferências e a personalizar o conteúdo. Ao usar este site, você concorda com o uso de cookies conforme descrito abaixo:<br>
              Cookies Essenciais: Necessários para o funcionamento básico do site, permitindo a navegação e o uso das funcionalidades principais.<br>
              Cookies de Desempenho: Coletam informações sobre como os visitantes utilizam o site, ajudando a melhorar a experiência e a performance.<br>
              Cookies Funcionais: Permitem que o site lembre de suas escolhas (como nome de usuário e idioma) para fornecer uma experiência personalizada.<br>
              Cookies de Publicidade: Utilizados para exibir anúncios mais relevantes para você e seus interesses.<br>
              Você pode gerenciar e controlar o uso de cookies através das configurações do seu navegador. Consulte a seção de ajuda do seu navegador para saber como ajustar suas preferências de cookies.<br>
              9. Contato: Se você tiver qualquer dúvida sobre estes Termos de Uso, entre em contato conosco pelo e-mail centroedhorizonte@gmail.com.</p>
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="okbtn">Ok</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
</body>

</html>
