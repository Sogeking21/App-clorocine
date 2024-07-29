<?php
require_once "controller/FilmesController.php";

// Inclua seus arquivos e defina as configurações necessárias
$rota = trim($_SERVER["REQUEST_URI"], '/');
$metodo = $_SERVER["REQUEST_METHOD"];

// Checando se existe um método sobreposto
if ($metodo === 'POST' && isset($_POST['_method'])) {
    $metodo = strtoupper($_POST['_method']);
}

// Roteamento
switch ($rota) {
    case "":
        require "index.php";
        break;

    case "login.php";
        require "view/login.php";
        break;

    case "galeria.php":
        require "galeria.php";
        break;

    case "cadastrar.php":
        if ($metodo == "GET") {
            require "cadastrar.php";
        } elseif ($metodo == "POST") {
            $controller = new FilmesController();

            // Sanitize e validar os dados antes de passá-los para o controlador
            $dados = [
                'titulo' => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING),
                'sinopse' => filter_input(INPUT_POST, 'sinopse', FILTER_SANITIZE_STRING),
                'nota' => filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_FLOAT),
                'poster' => filter_input(INPUT_POST, 'poster', FILTER_SANITIZE_URL),
            ];

            $controller->save($dados);
        }
        exit();
        break;

    case "nota":
        require "view/nota.php";
        break;

    case "cadastrar_usuario.php":
        require "cadastrar_usuario.php";
        break;

    case "lista_usuario.php":
        require "./view/lista_usuario.php";
        break;

    case "perfil_usuario.php":
        require "./view/perfil_usuario.php";
        break;

    case "logout.php":
        require "./view/logout.php";
        break;

        case (preg_match('/^filmes\/\d+$/', $rota) ? true : false):
            $controller = new FilmesController();
            $id = intval(basename($rota));
        
            if ($metodo == "DELETE") {
              $controller->delete($id);
            }
            exit();
            break;    
      
        default:
            require "view/404.php";
            break;
    }
?>
