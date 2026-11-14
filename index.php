<?php
session_start();
require_once "conexao.php";

$logado   = isset($_SESSION['usuario_id']);
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$logado) {
        header('Location: login.php');
        exit;
    }

    $titulo  = trim($_POST['titulo'] ?? '');
    $opniao  = trim($_POST['opniao'] ?? '');

    if ($titulo === '' || $opniao === '') {
        $mensagem = 'Escreva um título e a sua opinião.';
    } else {
        $stmt = $conexao->prepare("INSERT INTO opnioes (titulo, opniao, usuario_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $titulo, $opniao, $_SESSION['usuario_id']);
        $stmt->execute();
        $stmt->close();

        header('Location: index.php?enviado=1');
        exit;
    }
}

// últimas opiniões
$ultimas = $conexao->query(
    "SELECT o.titulo, o.opniao, o.criado_em, u.nome
       FROM opnioes o
       JOIN usuarios u ON u.id = o.usuario_id
   ORDER BY o.criado_em DESC
      LIMIT 6"
);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Início · Opinião</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php require_once "navbar.php"; ?>

<main class="page">
    <section class="hero">
        <span class="eyebrow">opinião aberta</span>
        <h1>Todo mundo tem algo a dizer.</h1>
        <p class="muted">Publique sua opinião, leia a dos outros e veja o que a comunidade está pensando.</p>
    </section>

    <?php if (isset($_GET['enviado'])): ?>
        <div class="alert alert--ok">Opinião publicada!</div>
    <?php endif; ?>
    <?php if ($mensagem): ?>
        <div class="alert"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <section class="card form">
        <?php if ($logado): ?>
            <h2>Nova opinião</h2>
            <form method="POST">
                <label>Título
                    <input type="text" name="titulo" placeholder="Sobre o que você quer falar?" required />
                </label>
                <label>Opinião
                    <textarea name="opniao" rows="4" placeholder="Escreva aqui..." required></textarea>
                </label>
                <button type="submit" class="btn">Publicar</button>
            </form>
        <?php else: ?>
            <h2>Quer publicar?</h2>
            <p class="muted">Entre na sua conta para escrever uma opinião.</p>
            <a class="btn" href="login.php">Entrar</a>
        <?php endif; ?>
    </section>

    <h2 class="section-title">Últimas opiniões</h2>

    <?php if ($ultimas->num_rows === 0): ?>
        <p class="muted">Nenhuma opinião publicada ainda.</p>
    <?php else: ?>
        <div class="grid">
            <?php while ($o = $ultimas->fetch_assoc()): ?>
                <article class="card opinion">
                    <h3><?= htmlspecialchars($o['titulo']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($o['opniao'])) ?></p>
                    <footer class="opinion__meta">
                        por <strong><?= htmlspecialchars($o['nome']) ?></strong>
                        · <?= date('d/m/Y H:i', strtotime($o['criado_em'])) ?>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
