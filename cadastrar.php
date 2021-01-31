<?php include"cabecalho.php"?>

    <title>Cadastrar</title>
</head>
<body>
    <nav class="nav-extended purple lighten-3">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php">Galeira</a></li>
        <li><a href="cadastrar.php">Cadastar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
      <h1>CLOROCINE</h1>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent  purple darken-1">
      </ul>
    </div>
  </nav>
  <!--Formulario-->
  <div class="row">
    <div class="col s6 offset-s3 ">
        <div class="card ">
            <div class="card-content white-text">
                <span class="card-title">Cadastar filme</span>
                <!-- input titulo-->
                  <div class="row">
                    <div class="input-field col s6">
                      <input  id="titulo" type="text" class="validate" require>
                      <label for="titulo">titulo do filme</label>
                    </div>
                  </div>
              <!-- input sinopse-->
              <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="sinopse" class="materialize-textarea"></textarea>
                      <label for="sinopse">Sinopse</label>
                    </div>
                  </div>
                </form>
              </div>
              <!-- input nota-->
              <div class="row">
                    <div class="input-field col s1">
                      <input  id="nota" type="number" step=".1" min="0" max="10" class="validate" require>
                      <label for="nota">Nota</label>
                    </div>
                  </div>
                  <!--capa-->
                  <div class="file-field input-field">
                    <div class="btn">
                      <span>Capa</span>
                      <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text">
                    </div>
                  </div>
                  <!-- botao cancelar e comfirmar-->
            <div class="card-action">
                <a  class="btn" href="index.php">Cancelar</a>
                <a href="#" class="waves-effect waves-light btn">Comfirmar</a>
            </div>
        </div>
    </div>
  </div>

</body>
</html>