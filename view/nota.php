<?php include "cabecalho.php" ?>

<?php


require "../util/Mensagem.php";
require_once "../controller/FilmesController.php";
require_once "../util/VerificarUsuario.php";

$controller = new filmesController();
$filmes = $controller->listarPorNota()


?>

<body>

  <!--nav-->

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
          <li class="tab"><a href="galeria.php">Galeria</a></li>
          <li class="tab"><a href="favorito.php">Favoritos</a></li>
          <li class="tab"><a class="active  black" href="nota.php">Nota</a></li>
          <li>
            <form action="buscar.php" method="GET" style="display: flex; align-items: center;">
              <input type="text" name="query" placeholder="Pesquisar filmes..." style="margin: 0 10px;">
              <button type="submit" class="btn">Buscar</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>

    <!--card -->

    <div class="container">
      <div class="row">

        <?php if (!$filmes) echo "<p class='card-panel red lighten-4'>Nenhum filme cadastrado</p>" ?>

        <<?php foreach ($filmes as $filme) : ?> <div class="col s12 m6 l4 x12 ">
          <div class="card hoverable card-serie black">
            <div class="card-image">
              <img src="<?= $filme->poster ?>" class="activator" />
              <form action="favoritar.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="<?= $filme->id ?>">
                <button type="submit" name="favoritar" class="btn-fav btn-floating halfway-fab waves-effect waves-light red accent-4">
                  <i class="material-icons"><?= ($filme->favorito) ? "favorite" : "favorite_border" ?></i>
                </button>
              </form>
            </div>
            <div class="card-content">
              <p class="valign-wrapper amber-text">
                <i class="material-icons">star</i> <?= ($filme->nota) ?>
              </p>
              <span class="card-title white-text activator truncate">
                <?= $filme->titulo ?>
              </span>
            </div>
            <div class="card-reveal black">
              <span class="card-title white-text text-darken-4"><?= $filme->titulo ?><i class="material-icons right">close</i></span>
              <p class="white-text"><?= substr($filme->sinopse, 0, 500) . "..." ?></p>
              <button class="waves-effect waves-light btn-small right red accent-4 btn-delete" data-id="<?= $filme->id ?>"><i class="material-icons">delete</i></button>
            </div>
          </div>
      </div>
    <?php endforeach; ?>
    </div>
    </div>

    <?= Mensagem::mostar(); ?>

    <?php include "footer.php" ?>
    <script>
      document.querySelectorAll(".btn-delete").forEach(btn => {
        btn.addEventListener("click", e => {
          const id = btn.getAttribute("data-id")
          const requestConfig = {
            method: "DELETE",
            header: new Headers()
          }
          fetch(`/filmes/${id}`, requestConfig)
            .then(response => response.json())
            .then(response => {
              if (response.success === "ok") {
                const card = btn.closest(".col")
                card.classList.add("fadeOut")
                setTimeout(() => card.remove(), 1000);
              }
            })
            .catch(error => {
              M.toast({
                html: 'Erro ao excluir'
              })
            })
        });
      });

      $('btn').on('click', function() {
        $.ajax({
          url: "/desc.php",
          data: {
            id: 1
          }
        }).done(function() {
          alert('Script executado.');
        })
      });
    </script>

  </body>

  </html>