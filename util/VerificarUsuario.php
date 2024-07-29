<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

function verificarAutenticacao()
{
  if (!isset($_SESSION["usuario_id"])) {
    // Se estiver na página login.php, redirecione para login.php (evita loop)
    if (basename($_SERVER['PHP_SELF']) === 'login.php') {
      return;
    }
    // Se não estiver na página login.php, redirecione para login.php
    header("Location: login.php");
    exit();
  } elseif (basename($_SERVER['PHP_SELF']) === 'login.php') {
    // Se o usuário estiver logado e na página login.php, redirecione para perfil_usuario.php
    header("Location: perfil_usuario.php");
    exit();
  }
}
