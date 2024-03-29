<?php include "cabecalho.php" ?>

<body>

  <nav class="nav-extended purple lighten-3">
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right">
        <li><a href="/">Galeria</a></li>
        <li class="active"><a href="/novo">Cadastrar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1>CADASTRAR</h1>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent red accent-4 ">
        <li class="tab"><a href="/">Todos</a></li>
        <li class="tab"><a href="/favorito">Favoritos</a></li>
        <li class="tab"><a href="/nota">Nota</a></li>
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
              <div class="btn red accent-4 ">
                <span>Capa</span>
                <input type="url" name="poster_file" accept="image/*">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" name="poster">
              </div>
            </div>

            <div class="card-action">
              <a class="btn waves-effect waves-light red accent-4" href="/">Cancelar</a>
              <button type="submit" class="waves-effect waves-light btn  red accent-4">Confirmar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php include "footer.php" ?>
</body>