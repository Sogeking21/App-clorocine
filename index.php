<?php

// Inclua outros arquivos necessários

// Inclua o router.php para lidar com as rotas
require_once "router.php";
if (isset($_SESSION["usuario_id"]) && isset($_SESSION["usuario_nome"])) {

  // Redirecione para a página de perfil
  header("Location: perfil_usuario.php");
  exit();
} else {
  // Autenticação falhou - senha incorreta
  header("Location: view/login.php");
  exit();
}
