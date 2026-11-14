<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sobre · Opinião</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php require_once "navbar.php"; ?>

<main class="page page--narrow">
    <h1>Sobre o projeto</h1>

    <div class="card">
        <p>
            <strong>Opinião</strong> é um CRUD completo feito em PHP + MySQL, sem framework:
            cadastro de usuários, login com sessão, publicação, busca e listagem de opiniões.
        </p>
        <p>
            O objetivo é praticar o ciclo completo de uma aplicação web — modelagem do banco,
            consultas preparadas, validação no servidor e interface responsiva.
        </p>

        <h2>O que já está pronto</h2>
        <ul>
            <li>Cadastro e login com senha protegida por <code>password_hash</code></li>
            <li>Sessão de usuário e logout</li>
            <li>Publicar, listar e buscar opiniões</li>
            <li>Página “minha conta” com o histórico do usuário</li>
        </ul>

        <h2>Próximos passos</h2>
        <ul>
            <li>Editar e excluir a própria opinião</li>
            <li>Paginação e ordenação</li>
            <li>Curtidas e comentários</li>
        </ul>
    </div>
</main>
</body>
</html>
