<div align="center">

# Opinião

**CRUD completo em PHP + MySQL — cadastro, login com sessão e um mural de opiniões.**

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

</div>

## Sobre

Projeto de estudo para praticar o ciclo completo de uma aplicação web **sem framework**: modelagem do banco, autenticação, consultas preparadas, validação no servidor e interface responsiva.

O usuário cria conta, entra, publica opiniões e acompanha o próprio histórico. Visitantes podem ler e buscar tudo que já foi publicado.

## Funcionalidades

- **Cadastro** com validação de e-mail e senha mínima de 6 caracteres
- **Login** com sessão (`$_SESSION`) e logout
- **Senhas com `password_hash`** — e migração automática de bases antigas em texto puro
- **Publicar opinião** (título + texto) restrito a usuários logados
- **Feed** com as últimas opiniões e **busca** por título ou conteúdo
- **Minha conta** com dados do usuário e suas publicações
- **Consultas preparadas** em todas as queries (sem concatenação de SQL)

## Stack

| Camada | Tecnologia |
|---|---|
| Back-end | PHP 8 (mysqli, sessões) |
| Banco | MySQL 8 |
| Front-end | HTML5 + CSS3 (sem framework) |
| Servidor local | Apache/XAMPP |

## Estrutura

```
Crud-PHP/
├─ banco.sql         cria o banco e as tabelas
├─ conexao.php       conexão mysqli (variáveis de ambiente ou valores padrão)
├─ auth.php          verificação/migração de senha
├─ navbar.php        cabeçalho e menu
├─ index.php         feed + formulário de nova opinião
├─ opnioes.php       lista completa com busca
├─ cadastro.php      criação de conta
├─ login.php         autenticação
├─ conta.php         perfil e publicações do usuário
├─ logout.php        encerra a sessão
├─ sobre.php         página sobre o projeto
└─ style.css         tema escuro com destaque violeta
```

## Como rodar

1. Instale o **XAMPP** (ou Apache + PHP + MySQL) e coloque a pasta em `htdocs`.
2. Crie o banco importando o `banco.sql` (phpMyAdmin → Importar, ou `mysql -u root -p < banco.sql`).
3. Ajuste as credenciais em `conexao.php` (ou defina `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
4. Abra `http://localhost/Crud-PHP/`.

## Roadmap

- [ ] Editar e excluir a própria opinião
- [ ] Paginação e ordenação do feed
- [ ] Curtidas e comentários
- [ ] Recuperação de senha por e-mail

---

<sub>Desenvolvido por **Carlos Eduardo Duhring** · [github.com/CarlosDuhring](https://github.com/CarlosDuhring)</sub>
