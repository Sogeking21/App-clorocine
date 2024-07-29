<?php
session_start();
require_once "repository/conexao.php";
require_once "model/UsuarioModel.php";

class UsuarioController
{
    private $usuarioModel;

    public function __construct($usuarioModel)
    {
        $this->usuarioModel = $usuarioModel;
    }

    public function perfilUsuario()
    {
        // Verifique se o usuário está autenticado (pode ajustar conforme necessário)
        if (!isset($_SESSION["usuario_id"])) {
            header("Location: login.php");
            exit();
        }

        // Lógica para exibir a página de perfil do usuário
        // ...

        // Se o formulário de alteração for submetido
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario_id = $_SESSION["usuario_id"];
            $novo_nome_usuario = $_POST["novo_nome_usuario"];

            // Validações e lógica de negócios podem ser adicionadas aqui, se necessário

            // Chama o método para atualizar o nome de usuário
            $sucesso = $this->usuarioModel->atualizarNomeUsuario($usuario_id, $novo_nome_usuario);

            if ($sucesso) {
                $_SESSION['mensagem_sucesso'] = "Nome de usuário alterado com sucesso.";
            } else {
                $_SESSION['mensagem_erro'] = "Erro ao alterar o nome de usuário.";
            }

            // Redireciona de volta para a página de perfil do usuário
            header("Location: perfil_usuario.php");
            exit();
        }
    }
}

?>
