<?php include "cabecalho.php";
require_once "../repository/FilmesRepositoryPDO.php";
require_once "../model/Filme.php";
require_once "../util/VerificarUsuario.php";
$dbFilePath = __DIR__ . '/../db/filmes.db';

if (!isset($_SESSION)) {
  session_start();
}
verificarAutenticacao();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conexao = new SQLite3($filename);
  $filmesRepository = new FilmeRepositoryPDO($conexao);

  $titulo = $_POST["titulo"];
  $sinopse = $_POST["sinopse"];
  $nota = $_POST["nota"];
  $poster = $_POST["poster"];

  // Criar objeto Filme
  $filme = new Filme();
  $filme->titulo = $titulo;
  $filme->sinopse = $sinopse;
  $filme->nota = $nota;
  $filme->poster = $poster;

  // Chamar a função salvar do FilmeRepository
  if ($filmesRepository->salvar($filme)) {
    $_SESSION["msg"] = "Filme cadastrado com sucesso";
  } else {
    $_SESSION["msg"] = "Erro ao cadastrar filme";
  }

  // Redirecionar para a galeria página
    header("Location: galeria.php");
  exit();
}

/* consulta no banco de dados */
require "../util/Mensagem.php";


?>

<body class="">

  <nav class="nav-extended red darken-2">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right">
        <li class="active"><a href="login.php">Login</a></li>
        <li><a href="cadastrar.php">Cadastrar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1 class="titulo">LISTA DE FILMES</h1>
    </div>
    <div class="nav-mobile">
      <ul class="tabs tabs-transparent red darken-4">
        <li class="tab"><a class="active  black" href="galeria.php">Galeria</a></li>
        <li class="tab"><a href="favorito.php">Favoritos</a></li>
        <li class="tab"><a href="nota.php">Nota</a></li>
        <li>
          <form action="buscar.php" method="GET" style="display: flex; align-items: center;">
            <input type="text" name="query" placeholder="Pesquisar filmes..." style="margin: 0 10px;">
            <button type="submit" class="btn">Buscar</button>
          </form>
        </li>
      </ul>
    </div>
  </nav>

  <div class="row">
    <form method="POST" enctype="multipart/form-data">
      <div class="col s6 offset-s3">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Cadastrar Filme</span>

            <!-- input titulo-->
            <div class="row">
              <div class="input-field col s12">
                <input id="titulo" type="text" class="validate" name="titulo" required>
                <label for="titulo">Título do Filme</label>
              </div>
            </div>

            <!-- input sinopse-->
            <div class="row">
              <div class="row">
                <div class="input-field col s12">
                  <textarea name="sinopse" id="sinopse" class="materialize-textarea"></textarea>
                  <label for="sinopse">Sinopse</label>
                </div>
              </div>
            </div>

            <!-- input nota-->
            <div class="row">
              <div class="input-field col s4">
                <input id="nota" name="nota" type="number" step=".1" min=0 max=10 class="validate" required>
                <label for="nota">Nota</label>
              </div>
            </div>

            <!-- input capa -->
            <div class="file-field input-field">
              <div class="btn red darken-2 ">
                <span>Capa</span>
                <input type="url" name="poster_file" accept="image/*">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" name="poster">
              </div>
            </div>

            <div class="card-action">
              <a class="btn waves-effect waves-light red darken-2" href="/">Cancelar</a>
              <button type="submit" class="waves-effect waves-light btn  red darken-2">Confirmar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php include "footer.php" ?>
</body>