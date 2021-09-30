<?php

session_start();
require "./repository/FilmesRepositoryPDO.php";
require "./model/Filme.php";

class filmesController
{

    public function index()
    {
        $filmesRepository = new FilmeRepositoryPDO();
        return $filmesRepository->listarTodos();
    }

    public function save($request)
    {

        $filmesRepository = new FilmeRepositoryPDO();
        $filme = (object) $request;

        $upload = $this->savePoster($_FILES);

        if (gettype($upload) == "string") {
            $filme->poster = $upload;
        }

        if ($filmesRepository->salvar($filme))
            $_SESSION["msg"] = "Filme cadastrado com sucesso";
        else
            $_SESSION["msg"] = " Erro ao cadastrar filme";

        header("Location: /");
    }

    private function savePoster($file)
    {
        $posterDir = "img/posters/";
        $posterPath =  $posterDir . basename($file["poster_file"]["name"]);
        $posterTmp = $file["poster_file"]["tmp_name"];
        if (move_uploaded_file($posterTmp, $posterPath)) {
            return $posterDir;
        } else {
            return false;
        };
    }

    public function favorite(int $id)
    {
        $filmesRepository = new FilmeRepositoryPDO();
        $result = ['success' => $filmesRepository->favoritar($id)];
        header("Content-type: applicationn/json");
        echo json_encode($result);
    }

    public function delete(int $id)
    {
        $filmesRepository = new FilmeRepositoryPDO();
        $result = ['success' => $filmesRepository->delete($id)];
        header("Content-type: applicationn/json");
        echo json_encode($result);
    }
}
