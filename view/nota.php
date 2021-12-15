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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

</body>

</html>