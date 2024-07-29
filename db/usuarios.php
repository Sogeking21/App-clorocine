<?php

$bd = new SQLite3("filmes.db");

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  senha TEXT NOT NULL
)";

if ($bd->exec($sql)) {
  echo "\nTabela 'usuarios' alterada ou criada com sucesso.\n";
} else {
  echo "\nErro ao alterar ou criar tabela 'usuarios': " . $bd->lastErrorMsg() . "\n";
}
