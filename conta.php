<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$id = (int) $_SESSION['usuario_id'];

$stmt = $conexao->prepare("SELECT nome, email, criado_em FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

$stmt = $conexao->prepare(
    "SELECT titulo, opniao, criado_em FROM opnioes WHERE usuario_id = ? ORDER BY criado_em DESC"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$minhas = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Minha conta · Opinião</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php require_once "navbar.php"; ?>

<main class="page">
    <h1>Minha conta</h1>

    <section class="card">
        <p><strong>Usuário:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
        <p><strong>Desde:</strong> <?= date('d/m/Y', strtotime($usuario['criado_em'])) ?></p>
        <a class="btn btn--ghost" href="logout.php">Sair da conta</a>
    </section>

    <h2 class="section-title">Minhas opiniões (<?= $minhas->num_rows ?>)</h2>

    <?php if ($minhas->num_rows === 0): ?>
        <p class="muted">Você ainda não publicou nada. <a href="index.php">Escrever a primeira</a>.</p>
    <?php else: ?>
        <div class="grid">
            <?php while ($o = $minhas->fetch_assoc()): ?>
                <article class="card opinion">
                    <h3><?= htmlspecialchars($o['titulo']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($o['opniao'])) ?></p>
                    <footer class="opinion__meta"><?= date('d/m/Y H:i', strtotime($o['criado_em'])) ?></footer>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
