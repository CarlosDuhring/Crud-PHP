<?php
session_start();
?>

<header>
    <nav>
        <a href="index.php">inicio</a>
        <a href="opnioes.php">Ver opniões</a>
        <a href="sobre.php">Sobre</a>
        <a href="conta.php">Conta</a>
    </nav>
</header>

<?php if (isset($_SESSION["usuario_id"])): ?>
    <a href="logout.php">Sair</a>
<?php else: ?>
    <a href="login.php">Login</a>
<?php endif; ?>