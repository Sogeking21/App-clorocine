<?php

session_start();
require_once __DIR__ . '/../repository/FilmesRepositoryPDO.php';
require_once __DIR__ . '/../model/Filme.php';
$dbFilePath = __DIR__ . '/../db/filmes.db';

class filmesController
{
    private $dbFilePath;
    private $conexao;

    public function __construct()
    {
        $this->dbFilePath = __DIR__ . '/../db/filmes.db';
    }

    public function index()
    {
        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);
        return $filmesRepository->listarTodos();
    }

    public function listarPorNota()
    {
        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);
        return $filmesRepository->listarPorNota();
    }

    public function save($request)
    {
        // Verificar se todos os campos necessários estão presentes
        $camposObrigatorios = ['titulo', 'sinopse', 'nota', 'poster_file'];
        foreach ($camposObrigatorios as $campo) {
            if (!isset($request[$campo])) {
                $_SESSION["msg"] = "Campos obrigatórios ausentes";
                header("Location: /cadastrar.php");
                exit();
            }
        }

        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);
        $filme = (object) $request;


        // Salvamento do filme no banco de dados
        if ($filmesRepository->salvar($filme)) {
            $_SESSION["msg"] = "Filme cadastrado com sucesso";
        } else {
            $_SESSION["msg"] = "Erro ao cadastrar filme no banco de dados";
        }

        header("Location: /galeria.php");
    }

    private function savePoster($file)
    {
        $posterDir = "img/posters/";
        $posterPath = $posterDir . basename($file["name"]);
        $posterTmp = $file["tmp_name"];

        if (move_uploaded_file($posterTmp, $posterPath)) {
            return $posterPath; // Alterado para retornar o caminho completo do pôster
        } else {
            return false;
        }
    }
    public function buscar($query)
    {
        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);
        if (empty($query)) {
            return $filmesRepository->listarTodos();
        } else {
            return $filmesRepository->buscar($query, $conexao);
        }
    }

    public function favoritar(int $id)
    {
        // Verifica se a requisição é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Método não permitido
            echo json_encode(['error' => 'Método não permitido']);
            return;
        }

        // Instancia o repositório de filmes
        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);

        // Chama o método para favoritar o filme
        $result = ['success' => $filmesRepository->favoritar($id)];

        // Define o cabeçalho Content-type corretamente
        header("Content-type: application/json");

        // Retorna o resultado como JSON
        echo json_encode($result);
    }

    public function favorite(int $id)
    {
        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);
        $result = $filmesRepository->favoritar($id);
        return $result;
    }

    public function delete(int $id) {
        $conexao = new SQLite3($this->dbFilePath);
        $filmesRepository = new FilmeRepositoryPDO($conexao);
        
        $success = $filmesRepository->delete($id);

        $response = ['success' => $success];

       header('location: /view/galeria.php');
       exit();
    }
}
