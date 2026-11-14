<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$logado = isset($_SESSION['usuario_id']);
?>
<header class="topbar">
    <a class="brand" href="index.php">
        <span class="brand__mark">&gt;_</span>
        <span class="brand__text">opinião<span class="brand__dot">.</span></span>
    </a>

    <nav class="nav">
        <a href="index.php">Início</a>
        <a href="opnioes.php">Opiniões</a>
        <a href="sobre.php">Sobre</a>
        <?php if ($logado): ?>
            <a href="conta.php">Minha conta</a>
            <a class="nav__out" href="logout.php">Sair</a>
        <?php else: ?>
            <a class="nav__cta" href="login.php">Entrar</a>
        <?php endif; ?>
    </nav>
</header>
