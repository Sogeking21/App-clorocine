<?php include "cabecalho.php" ?>
<?php
require_once "../repository/conexao.php";
require_once "../model/UsuarioModel.php"; // Inclua o arquivo necessário

session_start();

// Verifique se o usuário está autenticado
if (isset($_SESSION["usuario_id"])) {
  $nomeUsuario = $_SESSION["usuario_nome"];

  // Instancie o objeto UsuarioModel para obter detalhes do usuário
  $usuarioModel = new UsuarioModel();
  $usuario_id = $_SESSION["usuario_id"];
  $usuario = $usuarioModel->obterInformacoesUsuario($usuario_id); // Substitua pelo método real

} else {
  header("Location: login.php");
}
?>

<body>
  <?php
  // Se houver mensagens de erro, exiba-as aqui
  if (isset($erro)) {
    echo "<p>$erro</p>";
  }
  ?>
  <nav class="nav-extended red darken-2">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right">
        <li class="active"><a href="galeria.php">Galeria</a></li>
        <li><a href="cadastrar.php">Cadastrar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1 class="titulo">LISTA DE FILMES</h1>
    </div>
    <div class="nav-mobile">
      <ul class="tabs tabs-transparent red darken-4">
        <li class=""><a href="cadastrar_usuario.php">Cadastrar Usuario</a>
        <li class=""><a href="lista_usuario.php">Lista de Usuários</a></li>
      </ul>
    </div>
  </nav>

  <div class="container body-perfil-usuario">
    <div class="center-align ">
      <div class="row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px;">
        <div class="col s12 center-align">
          <h2 class="center-align text_white">Perfil do Usuário</h2>
        </div>
        <div class="row text_white">
          <div class="col s12 center-align">Informações do Usuario Atual:</div>
          <div class="col s6">
            <p class="center-align">Nome: <?php echo $usuario['nome']; ?></p>
          </div>
          <div class="col s6">
            <p class="center-align">Email: <?php echo $usuario['email']; ?></p>
          </div>
          <div class="col s12 center-align">
            <a href="logout.php" class="center-align">logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Adicione a lógica para mostrar a mensagem de sucesso ou erro após o processamento -->
  <?php
  if (isset($_SESSION['mensagem_sucesso'])) {
    echo "<p>{$_SESSION['mensagem_sucesso']}</p>";
    unset($_SESSION['mensagem_sucesso']);
  }
  if (isset($_SESSION['mensagem_erro'])) {
    echo "<p>{$_SESSION['mensagem_erro']}</p>";
    unset($_SESSION['mensagem_erro']);
  }
  ?>

  <!-- Conteúdo específico para usuários logados -->
  <?php include "footer.php" ?>
</body>

</html>