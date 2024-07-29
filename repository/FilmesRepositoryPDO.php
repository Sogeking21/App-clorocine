<?php

require "conexao.php";

class FilmeRepositoryPDO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function listarTodos()
    {
        $sql = "SELECT * FROM filmes";
        $stmt = $this->conexao->prepare($sql);
        $result = $stmt->execute();

        $filmes = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $filme = new Filme();
            $filme->id = $row['id'];
            $filme->titulo = $row['titulo'];
            $filme->sinopse = $row['sinopse'];
            $filme->nota = $row['nota'];
            $filme->poster = $row['poster'];
            $filme->favorito = $row['favorito'];

            $filmes[] = $filme;
        }

        return $filmes;
    }

    public function listarPorNota()
    {
        $query = "SELECT * FROM filmes ORDER BY nota DESC"; // Ordena por nota de forma descendente
        $result = $this->conexao->query($query);

        $filmes = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $filme = new Filme();
            $filme->id = $row['id'];
            $filme->titulo = $row['titulo'];
            $filme->sinopse = $row['sinopse'];
            $filme->nota = $row['nota'];
            $filme->poster = $row['poster'];
            $filme->favorito = $row['favorito'];

            $filmes[] = $filme;
        }

        return $filmes;
    }


    public function salvar($filme): bool
    {
        $stmt = $this->conexao->prepare("INSERT INTO filmes (titulo, sinopse, nota, poster) VALUES (?, ?, ?, ?)");
        $stmt->bindValue(1, $filme->titulo, SQLITE3_TEXT);
        $stmt->bindValue(2, $filme->sinopse, SQLITE3_TEXT);
        $stmt->bindValue(3, $filme->nota, SQLITE3_FLOAT);
        $stmt->bindValue(4, $filme->poster, SQLITE3_TEXT);

        // Verificar se a execução foi bem-sucedida
        $result = $stmt->execute();

        // Retorna true se a execução foi bem-sucedida, senão false
        return $result !== false;
    }
    public function favoritar(int $id)
    {
        try {
            $sql = "UPDATE filmes SET favorito = NOT favorito WHERE id=:id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "erro";
            }
        } catch (PDOException $e) {
            echo "Erro ao favoritar filme: " . $e->getMessage();
            return "erro";
        }
    }

    public function delete(int $id) {
       
        $query = "DELETE FROM filmes WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function buscar($query, $conexao)
    {
        $stmt = $conexao->prepare("SELECT * FROM filmes WHERE titulo LIKE :query");
        $query = '%' . $query . '%';
        $stmt->bindValue(':query', $query, SQLITE3_TEXT);
        $result = $stmt->execute();

        $filmes = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $filme = new Filme();
            $filme->id = $row['id'];
            $filme->titulo = $row['titulo'];
            $filme->sinopse = $row['sinopse'];
            $filme->nota = $row['nota'];
            $filme->poster = $row['poster'];
            $filme->favorito = $row['favorito']; // Certifique-se de ter essa coluna na tabela

            $filmes[] = $filme;
        }

        return $filmes;
    }
}
