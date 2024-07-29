<?php
require_once "../controller/FilmesController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $controller = new FilmesController();
    $resultado = $controller->favorite($id);

    if ($resultado === 'ok') {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Erro ao favoritar filme";
    }
}
?>
