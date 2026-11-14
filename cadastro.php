<?php
session_start();
require_once "conexao.php";

$erro = '';
$ok   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha precisa ter pelo menos 6 caracteres.';
    } else {
        $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE nome = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $nome, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $erro = 'Já existe uma conta com esse usuário ou e-mail.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->close();

            $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $hash);
            $stmt->execute();
            $stmt->close();

            $ok = 'Conta criada! Agora você pode entrar.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Criar conta · Opinião</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php require_once "navbar.php"; ?>

<main class="page page--narrow">
    <h1>Criar conta</h1>
    <p class="muted">Leva menos de um minuto.</p>

    <?php if ($erro): ?>
        <div class="alert"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
    <?php if ($ok): ?>
        <div class="alert alert--ok"><?= htmlspecialchars($ok) ?> <a href="login.php">Entrar</a></div>
    <?php endif; ?>

    <form method="POST" class="card form">
        <label>Usuário
            <input type="text" name="nome" placeholder="seu usuário" required />
        </label>
        <label>E-mail
            <input type="email" name="email" placeholder="voce@email.com" required />
        </label>
        <label>Senha
            <input type="password" name="senha" placeholder="mínimo 6 caracteres" required />
        </label>
        <button type="submit" class="btn">Criar conta</button>
    </form>
</main>
</body>
</html>
