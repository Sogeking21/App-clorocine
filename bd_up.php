  
<?php

$bd = new SQLite3("filmes.db");

$sql = "DROP TABLE IF EXISTS filmes";

if ($bd->exec($sql)) 
    echo "\ntabela filmes apagada\n"; 


$sql = "CREATE TABLE filmes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo VARCHAR(200) NOT NULL,
        poster VARCHAR (200),
        sinopse TEXT,
        nota DECIMAL(3,1)
    )
";

if ($bd->exec($sql)) 
    echo "\ntabela filmes criada\n"; 
else 
    echo "\nerro ao criar tabela filmes\n"; 
?>