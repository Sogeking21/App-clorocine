<?php include "cabecalho.php" ?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
/* consulta no banco de dados */
require "./util/Mensagem.php";

$controller = new filmesController();
$filmes = $controller->index();

usort(

  $filmes,

  function ($a, $b) {


    if ($a->favorito == $b->favorito) return 0;

    return (($a->favorito > $b->favorito) ? -1 : 0);
  }
);
?>

<body>

  <!--nav-->

  <nav class="nav-extended purple lighten-3">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right">
        <li class="active"><a href="/">Galeira</a></li>
        <li class="/novo"><a href="/novo">Cadastar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1 class="titulo">LISTA DE FILMES</h1>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent red accent-4 ">
        <li class="tab"><a href="/">Todos</a></li>
        <li class="tab"><a class="active  black" href="/favorito">Favoritos</a></li>
        <li class="tab"><a href="/nota">Nota</a></li>
      </ul>
    </div>
  </nav>

  <!--card -->

  <<div class="container">
    <div class="row">

      <?php if (!$filmes) echo "<p class='card-panel red lighten-4'>Nenhum filme cadastrado</p>" ?>

      <?php foreach ($filmes as $filme) : ?>
        <div class="col s12 m6 l4 x12 ">
          <div class="card hoverable card-serie black">
            <div class="card-image">
              <img src="<?= $filme->poster ?>" class="activator" />
              <button class="btn-fav btn-floating halfway-fab waves-effect waves-light red accent-4" data-id="<?= $filme->id ?>">
                <i class="material-icons"><?= ($filme->favorito) ? "favorite" : "favorite_border" ?></i>
              </button>
            </div>
            <div class="card-content">
              <p class="valign-wrapper amber-text">
                <i class="material-icons ">star</i> <?= ($filme->nota) ?>
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
      <?php endforeach ?>
    </div>
    </div>


    <?= Mensagem::mostar(); ?>
    <?php include "footer.php" ?>
    <script>
      document.querySelectorAll(".btn-fav").forEach(btn => {
        btn.addEventListener("click", e => {
          const id = btn.getAttribute("data-id")
          fetch(`/favoritar/${id}`)
            .then(response => response.json())
            .then(response => {
              if (response.success === "ok") {
                if (btn.querySelector("i").innerHTML === "favorite") {
                  btn.querySelector("i").innerHTML = "favorite_border"
                } else {
                  btn.querySelector("i").innerHTML = "favorite"
                }
              }
            })
            .catch(error => {
              M.toast({
                html: 'Erro ao favoritar'
              })
            })
        });
      });

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
<?php
