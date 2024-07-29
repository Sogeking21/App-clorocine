<?php
include "cabecalho.php";
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

// Inclua o arquivo de conexão
require_once "../repository/conexao.php";

// Conexão com o banco de dados SQLite
$conexao = new SQLite3(realpath("../db/filmes.db"));

if (!$conexao) {
    die("Erro na conexão: " . $conexao->lastErrorMsg());
}

// Verificar se o usuário é super usuário
$usuario_id = $_SESSION["usuario_id"];
$sql_superuser = "SELECT is_superuser FROM usuarios WHERE id = :id";
$stmt = $conexao->prepare($sql_superuser);

if ($stmt) {
    $stmt->bindValue(':id', $usuario_id, SQLITE3_INTEGER);
    $result_superuser = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result_superuser === false) {
        die("Erro ao verificar super usuário: " . $conexao->lastErrorMsg());
    }

    // Verifica se o usuário não é super usuário
    if (!$result_superuser || !$result_superuser['is_superuser']) {
        header("Location: no_access.php");
        exit();
    }
} else {
    die("Erro ao preparar a consulta: " . $conexao->lastErrorMsg());
}

// Consulta para obter todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conexao->query($sql);

?>
<body>
    <nav class="nav-extended red darken-2">
        <div class="nav-wrapper">
            <ul id="nav-mobile" class="right">
                <li class="active"><a href="galeria.php">Galeria</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </div>
        <div class="nav-header center">
            <h1 class="titulo">LISTA DE FILMES</h1>
        </div>
        <div class="nav-mobile">
            <ul class="tabs tabs-transparent red darken-4">
                <li class=""><a href="cadastrar_usuario.php">Cadastrar Usuario</a></li>
                <li class=""><a href="lista_usuario.php">Lista de Usuários</a></li>
                <li class=""><a href="perfil_usuario.php">Perfil Usuario</a></li>
            </ul>
        </div>
    </nav>
    <h2>Lista de Usuários</h2>

    <?php
    if ($result) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th></tr>";

        while ($usuario = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>";
            echo "<td>{$usuario['id']}</td>";
            echo "<td>{$usuario['nome']}</td>";
            echo "<td>{$usuario['email']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum usuário encontrado.";
    }
    ?>
    <br>
    <a href="logout.php">Logout</a>
    <?php include "footer.php" ?>
</body>

</html>