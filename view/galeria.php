<?php include "cabecalho.php" ?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
/* consulta no banco de dados */
require "./util/Mensagem.php";

$controller = new filmesController();
$filmes = $controller->index();

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
      <h1 class="titulo">CLOROCINE</h1>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent  purple darken-1">
        <li class="tab"><a class="active" href="#test1">Todos</a></li>
        <li class="tab"><a href="#test2">Assistidos</a></li>
        <li class="tab"><a href="#test3">Favoritos</a></li>
      </ul>
    </div>
  </nav>
  <!--card -->
  <div class="container">
    <div class="row">
      <?php foreach ($filmes as $filme) : ?>
        <div class="col s7 m4 14 xl3">
          <div class="card hoverable card-serie">
            <div class="card-image">
              <img src="<?= $filme->poster ?>" alt="">

              <button class="btn-fav btn-floating halfway-fab waves-effect waves-light red" data-id="<?= $filme->id ?>">
                <i class=" material-icons"><?= ($filme->favorito) ? "favorite" : "favorite_border" ?></i></button>
            </div>
            <div class="card-content">
              <P class="valign-wrapper">
                <i class="material-icons amber-text">star</i></a><?= $filme->nota ?>
              </P>
              <span class="card-title"><?= $filme->titulo ?></span>
              <p><?= $filme->sinopse ?></p>
              <button class="waves-effect weves-light btn-small right red accent-2 btn-delete" data-id="<?= $filme->id ?>"><i class="material-icons">Delete</i>

              </button>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <?= Mensagem::mostar(); ?>

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
  </script>

</body>

</html>
<?php