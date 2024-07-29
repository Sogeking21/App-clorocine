<?php
require_once __DIR__ . '/../model/UsuarioModel.php';
require_once "../util/VerificarUsuario.php";


verificarAutenticacao();
$UsuarioModel = new UsuarioModel();

// Inicialize a variável $informacoesUsuario
$informacoesUsuario = null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtenha as credenciais do formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Obtenha informações do usuário pelo e-mail
  $informacoesUsuario = $UsuarioModel->obterInformacoesUsuarioPorEmail($email);

  if ($informacoesUsuario !== false && $informacoesUsuario !== null) {
    // Usuário encontrado, prossiga com a verificação da senha
    // Obtenha o ID do usuário
    $usuario_id = $informacoesUsuario['id'];

    // Obtenha a senha armazenada do usuário
    $senha_armazenada = $UsuarioModel->obterSenhaUsuario($usuario_id);

    // Verifique se a senha fornecida corresponde à senha armazenada
    if (isset($senha_armazenada) && password_verify($senha, $senha_armazenada)) {
      // Autenticação bem-sucedida
      $_SESSION["usuario_id"] = $usuario_id;
      $_SESSION["usuario_nome"] = $informacoesUsuario["nome"];

      // Redirecione para a página de perfil
      header("Location: perfil_usuario.php");
      exit();
    } else {
      // Autenticação falhou - senha incorreta
      $erro = "Login falhou. Verifique suas credenciais.";
    }
  } else {
    // Usuário não encontrado com o e-mail fornecido
    $erro = "Usuário não encontrado com o e-mail fornecido.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <title>Login</title>
</head>

<body class="">
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

  <div class="container">
    <div class="row">
      <div class="section"></div>
      <main>
        <center>
          <div class="container">
            <div class="z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px;">
              <div class="section"></div>
              <div class="section"></div>

              <div class="section"><i class="mdi-alert-error red-text"></i></div>

              <form method="post">
                <div class='row'>
                  <div class='input-field col s12'>
                    <input placeholder="Email" id="email" name="email" type="text" class="validate">
                    <label for='email'></label>
                  </div>
                </div>
                <div class='row'>
                  <div class='input-field col m12'>
                    <input class='validate' placeholder="Senha" type='password' name='senha' id='password' required />
                    <label for='password'></label>
                  </div>
                  <label style='float: right;'>
                    <a><b style="color: #F5F5F5;">Forgot Password?</b></a>
                  </label>
                </div>
                <br />
                <center>
                  <div class='row'>
                    <button style="margin-left:65px;" type='submit' name='btn_login' class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Login</button>
                    <br>
                    <p style="margin-left:65px;"> <?php
                                                  // Se houver mensagens de erro, exiba-as aqui
                                                  if (isset($erro)) {
                                                    echo "<p>$erro</p>";
                                                  }
                                                  ?></p>
                  </div>
                </center>
              </form>
            </div>
          </div>
        </center>
      </main>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

    </div>
  </div>
  <?php include "footer.php" ?>
</body>

</html>