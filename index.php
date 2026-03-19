
<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $opniao = $_POST["opniao"];
    $usuario_id = $_SESSION["usuario_id"];


    $sql = "INSERT INTO opnioes (titulo, opniao,usuario_id) 
            VALUES ('$titulo', '$opniao','$usuario_id')";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Pagina inicial</title>
</head>
<body>

<?php require_once "navbar.php"; ?>

<form method="POST">
    <input type="text" name="titulo" placeholder="Titulo" required><br>
    <input type="text" name="opniao" placeholder="Opnião" required><br>

    <button type="submit">Salvar e Compartilhar</button>
</form>

</body>
</html>

<?php 

if ($conexao->query($sql)) {
        echo "Opnião enviada!";
    } else {
        echo "Erro: " . $conexao->error;
    }
}

?>