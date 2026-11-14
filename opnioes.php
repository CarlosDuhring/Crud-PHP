<?php
session_start();
require_once "conexao.php";

$busca = trim($_GET['q'] ?? '');

if ($busca !== '') {
    $stmt = $conexao->prepare(
        "SELECT o.titulo, o.opniao, o.criado_em, u.nome
           FROM opnioes o
           JOIN usuarios u ON u.id = o.usuario_id
          WHERE o.titulo LIKE ? OR o.opniao LIKE ?
       ORDER BY o.criado_em DESC"
    );
    $like = '%' . $busca . '%';
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conexao->query(
        "SELECT o.titulo, o.opniao, o.criado_em, u.nome
           FROM opnioes o
           JOIN usuarios u ON u.id = o.usuario_id
       ORDER BY o.criado_em DESC"
    );
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Opiniões · Opinião</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php require_once "navbar.php"; ?>

<main class="page">
    <h1>Todas as opiniões</h1>

    <form class="search" method="GET">
        <input type="search" name="q" placeholder="Buscar por título ou conteúdo..." value="<?= htmlspecialchars($busca) ?>" />
        <button type="submit" class="btn">Buscar</button>
    </form>

    <?php if ($resultado->num_rows === 0): ?>
        <p class="muted">Nada encontrado.</p>
    <?php else: ?>
        <div class="grid">
            <?php while ($o = $resultado->fetch_assoc()): ?>
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
