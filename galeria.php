<?php include"cabecalho.php"?>

<?php

 /* consulta no banco de dados */

 require "./repository/FilmesRepositoryPDO.php";
 require "./util/Mensagem.php";

$filmesRepository = new FilmeRepositoryPDO();
$filmes = $filmesRepository->listarTodos();

?>

<body>
<!--nav-->
  <nav class="nav-extended purple lighten-3">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right">
        <li class="active"><a href="galeria.php">Galeira</a></li>
        <li class=""><a href="cadastrar.php">Cadastar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1>CLOROCINE</h1>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent  purple darken-1">
        <li class="tab"><a class="active"  href="#test1">Todos</a></li>
        <li class="tab"><a href="#test2">Assistidos</a></li>
        <li class="tab"><a href="#test3">Favoritos</a></li>
      </ul>
    </div>
  </nav>
<!--card -->
<div class="container">
  <div class="row">
    <?php foreach($filmes as $filme): ?>
    <div class="col s12 m6 l3">
      <div class="card hoverable">
        <div class="card-image">
          <img src="<?= $filme->poster ?>" class="activator"/>
          
          <a class="btn-floating halfway-fab waves-effect waves-light red">
            <i class="material-icons">favorite_border</i></a>
        </div>
        <div class="card-content">
          <P class="valign-wrapper">
            <i class="material-icons amber-text">star</i></a><?= $filme->nota?>
          </P>
          <span class="card-title"><?= $filme->titulo?></span>
          <p><?= $filme->sinopse?></p>
        </div>
      </div>
    </div>
     <?php endforeach ?>
  </div>
</div>

 <?= Mensagem::mostar(); ?>

</body>

</html>