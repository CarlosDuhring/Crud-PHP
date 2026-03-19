<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nome"] = $usuario["nome"];
        echo "Login realizado!";
        header("Location: index.php");
        exit;

    } else {
        
        echo "Nome ou senha incorretos";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>

    <button type="submit">Login</button>
    <a href="cadastro.php">Voltar</a>
</form>

</body>
</html>