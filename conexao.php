<?php
$host = "127.0.0.1";
$usuario = "root";
$senha = "Cadu";
$banco = "crud";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}
?>