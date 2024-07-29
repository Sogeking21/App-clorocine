<?php
require_once __DIR__ . "/../repository/conexao.php";
class UsuarioModel
{
  private $bd;

  public function __construct()
  {
    $this->bd = new SQLite3(__DIR__ . "/../db/filmes.db");
  }

  public function verificarEmailExistente($email)
  {
    $sql = "SELECT COUNT(*) as total FROM usuarios WHERE email = :email";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
      return $row['total'] > 0;
    }

    return false;
  }

  public function cadastrarUsuario($nome, $email, $senha)
  {
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':senha', $senha, SQLITE3_TEXT);

    return $stmt->execute();
  }

  public function atualizarNomeUsuario($usuario_id, $novo_nome_usuario)
  {
    $sql = "UPDATE usuarios SET nome_usuario = :novo_nome_usuario WHERE id = :usuario_id";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':novo_nome_usuario', $novo_nome_usuario, SQLITE3_TEXT);
    $stmt->bindValue(':usuario_id', $usuario_id, SQLITE3_INTEGER);
    return $stmt->execute();
  }

  public function obterSenhaUsuario($usuario_id)
  {
    $sql = "SELECT senha FROM usuarios WHERE id = :usuario_id";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuario_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if ($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
      return $row['senha'];
    }

    return false;
  }

  public function verificarSenha($usuario_id, $senha_usuario)
  {
    $senha_armazenada = $this->obterSenhaUsuario($usuario_id);

    // Verificar se a senha fornecida corresponde à senha armazenada
    return password_verify($senha_usuario, $senha_armazenada);
  }

  public function obterInformacoesUsuario($usuario_id)
  {
    $sql = "SELECT nome, email, senha FROM usuarios WHERE id = :usuario_id";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuario_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if ($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
      return $row;
    }

    return false;
  }
  public function obterInformacoesUsuarioPorEmail($email)
  {
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
      return $row;
    }

    return false;
  }

  // Outros métodos relacionados ao usuário podem ser adicionados conforme necessário
}

// Adicione outros métodos relacionados ao usuário conforme necessário
