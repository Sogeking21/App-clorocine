<?php include"cabecalho.php"?>

    <title>Cadastrar</title>
</head>
<body>
    <nav class="nav-extended purple lighten-3">
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="galeria.php">Galeira</a></li>
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
  <form method="POST" action="inserirfilme.php">
    <div class="col s6 offset-s3 ">
        <div class="card ">
            <div class="card-content white-text">
                <span class="card-title">Cadastar filme</span>
                <!-- input titulo-->
                  <div class="row">
                    <div class="input-field col s6">
                      <input  name="titulo" id="titulo" type="text" class="validate"  required>
                      <label for="titulo">titulo do filme</label>
                    </div>
                  </div>
              <!-- input sinopse-->
              <div class="row">
                
                <div class="row">
                  <div class="input-field col s12">
                    <textarea  name="sinopse" id="sinopse"class="materialize-textarea"></textarea>
                    <label for="sinopse">Sinopse</label>
                  </div>
                </div>
              </div>
              <!-- input nota-->
              <div class="row">
                    <div class="input-field col s1">
                      <input  name="nota" id="nota" type="number" step=".1" min="0" max="10" class="validate" required>
                      <label for="nota">Nota</label>
                    </div>
                  </div>
                  <!--capa-->
                  <div class="file-field input-field">
                    <div class="btn">
                      <span>Capa</span>
                      <input type="file" >
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" name="poster">
                    </div>
                  </div>
                  <!-- botao cancelar e comfirmar-->
            <div class="card-action">
                <a  class="btn" href="index.php">Cancelar</a>
                <button type="submit" class="waves-effect waves-light btn">Confirmar</button>
            </div>
        </div>
    </div>
  </div>
</form>
</div>

</body>
</html>