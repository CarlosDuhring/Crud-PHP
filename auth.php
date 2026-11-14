<?php
require_once "conexao.php";

/**
 * Confere a senha aceitando hash (password_hash) ou texto puro de bases antigas.
 * Quando encontra texto puro válido, regrava como hash automaticamente.
 */
function conferirSenha(mysqli $conexao, int $id, string $digitada, string $armazenada): bool
{
    if (preg_match('/^\$2[axy]\$/', $armazenada)) {
        return password_verify($digitada, $armazenada);
    }

    if ($digitada === $armazenada) {
        $hash = password_hash($digitada, PASSWORD_DEFAULT);
        $stmt = $conexao->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $hash, $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    return false;
}
