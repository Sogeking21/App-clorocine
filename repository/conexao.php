<?php

// Caminho para o arquivo .env
$envFilePath = dirname(__DIR__) . '/.env';

// Carregar as configurações do banco de dados a partir do arquivo .env
$envConfig = parse_ini_file($envFilePath);

// Verificar se as configurações foram carregadas com sucesso
if ($envConfig === false) {
    die("Erro ao carregar as configurações do banco de dados do arquivo .env");
}

// Caminho do arquivo do banco de dados
$dbFilePath = $envConfig['DB_DATABASE'];
$filename = __DIR__ . '/../db/filmes.db';

// Verificar se o arquivo do banco de dados existe
if (!file_exists($filename)) {
    die("O arquivo do banco de dados não foi encontrado em: $filename");
}

/*Criar conexão com base nas configurações do .env

try {
    $conn = new SQLite3($filename);
    echo "Conexão bem-sucedida\n";
} catch (Exception $e) {
    die("Falha na conexão: " . $e->getMessage());
}
*/
