<?php

require"conexao.php";

class FilmeRepositoryPDO{

    private $conexao;

    public function __construct()
    {
        $this->conexao = conexao::criar();
    }

    public function listarTodos():array{
        $filmeLista = array();

        $sql = "SELECT * FROM filmes";
        $filmes = $this->conexao->query($sql);
        while($filme = $filmes->fetchObject()){
            array_push($filmeLista, $filme);
        }
        return $filmeLista;
    }

    public function salvar(filme $filme):bool{

        $sql = "INSERT INTO filmes (titulo, poster, sinopse, nota) 
        VALUES (:titulo,:poster, :sinopse,:nota)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':titulo', $filme-> titulo,PDO::PARAM_STR);
        $stmt->bindValue(':sinopse', $filme->sinopse, PDO::PARAM_STR);
        $stmt->bindValue(':nota', $filme->nota,PDO::PARAM_STR);
        $stmt->bindValue(':poster', $filme->poster,PDO::PARAM_STR);

        return $stmt->execute();

    }
}