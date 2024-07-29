<?php
require_once "repository/conexao.php";

function verificarUsuariosCadastrados($conexao)
{
  $sql = "SELECT COUNT(*) as total FROM usuarios";
  $stmt = $conexao->prepare($sql);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result['total'] > 0) {
    echo "Existem usuários cadastrados!";
  } else {
    echo "Não existem usuários cadastrados.";
  }
}
