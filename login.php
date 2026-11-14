<?php
session_start();
require_once "conexao.php";
require_once "auth.php";

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || $senha === '') {
        $erro = 'Preencha usuário e senha.';
    } else {
        $stmt = $conexao->prepare("SELECT id, nome, senha FROM usuarios WHERE nome = ? LIMIT 1");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();
        $stmt->close();

        if ($usuario && conferirSenha($conexao, (int) $usuario['id'], $senha, $usuario['senha'])) {
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header('Location: index.php');
            exit;
        }

        $erro = 'Usuário ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Entrar · Opinião</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php require_once "navbar.php"; ?>

<main class="page page--narrow">
    <h1>Entrar</h1>
    <p class="muted">Acesse para publicar e gerenciar suas opiniões.</p>

    <?php if ($erro): ?>
        <div class="alert"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" class="card form">
        <label>Usuário
            <input type="text" name="nome" placeholder="seu usuário" required />
        </label>
        <label>Senha
            <input type="password" name="senha" placeholder="sua senha" required />
        </label>
        <button type="submit" class="btn">Entrar</button>
    </form>

    <p class="muted">Ainda não tem conta? <a href="cadastro.php">Criar conta</a></p>
</main>
</body>
</html>
