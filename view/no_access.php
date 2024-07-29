<?php include "cabecalho.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Acesso Negado</title>
</head>

<body>
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
    <div class="container">
        <div class="center-align offset-s3">
            <h2>Acesso Negado</h2>
            <p>Você não tem permissão para acessar esta página.</p>
            <a href="login.php">Voltar para o Login</a>
        </div>
    </div>
</body>

</html>