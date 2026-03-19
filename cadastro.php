<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "INSERT INTO usuarios (nome, email, senha) 
            VALUES ('$nome', '$email', '$senha')";

    if ($conexao->query($sql)) {
        echo "Usuário cadastrado!";
    } else {
        echo "Erro: " . $conexao->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>
<body>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>

    <button type="submit">Cadastrar</button>
    <a href="login.php">Já tem cadastro?</a>
</form>

</body>
</html>