<?php
include "cabecalho.php";
require_once "../repository/conexao.php";
require_once "../model/UsuarioModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Formulário enviado";
  // Processar o formulário quando enviado
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Hash da senha

  // Criar uma instância do modelo de usuário
  $usuarioModel = new UsuarioModel();

  // Verificar se o e-mail já está cadastrado
  if ($usuarioModel->verificarEmailExistente($email)) {
    echo "E-mail já cadastrado. Escolha outro e-mail.";
  } else {
    // Realizar o cadastro do usuário
    $resultado = $usuarioModel->cadastrarUsuario($nome, $email, $senha);

    if ($resultado) {
      echo "Usuário cadastrado com sucesso!";
    } else {
      echo "Erro ao cadastrar o usuário. Tente novamente.";
    }
  }
}
?>
<body class="">
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
        <li><a href="/novo">Cadastar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1 class="titulo">LISTA DE FILMES</h1>
    </div>
    <div class="nav-mobile">
      <ul class="tabs tabs-transparent red darken-4">
        <li class=""><a href="login.php">login</a>
        <li class=""><a href="lista_usuario.php">Lista de Usuários</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="section"></div>
      <main>
        <center>
          <div class="container">]
            <div class="z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; ">
              <div class="section"></div>
              <div class="section"></div>
              <h2 class=""> Cadastrar Usuario</h2>
              <div class="section"><i class="mdi-alert-error red-text"></i></div>
              <form method="post">
                <div class='row'>
                  <div class='input-field col s12'>
                    <input placeholder="Nome" id="Nome" name="nome" type="text" class="validate">
                    <label for='Nome'></label>
                  </div>
                </div>

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
                    <button style="margin-left:65px;" type='submit' name='btn_login' class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Cadastrar</button>
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