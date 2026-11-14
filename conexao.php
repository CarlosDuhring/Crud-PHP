<?php
// Conexão com o MySQL.
// Configure por variáveis de ambiente ou edite os valores padrão abaixo.
$host    = getenv('DB_HOST') ?: '127.0.0.1';
$usuario = getenv('DB_USER') ?: 'root';
$senha   = getenv('DB_PASS') ?: 'Cadu';
$banco   = getenv('DB_NAME') ?: 'crud';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexao = new mysqli($host, $usuario, $senha, $banco);
    $conexao->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Erro de conexão: ' . $e->getMessage());
}
