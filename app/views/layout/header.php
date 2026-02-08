<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Crud App' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php $currentPage = $_GET['page'] ?? 'users'; ?>

    <nav>
        <?php if(!empty($_SESSION['user_id'])): ?>
        <a href="?page=users" <?= $currentPage === "users" ? 'style="font-weight: bold;"': ''; ?>>Пользователи</a>|
        <a href="?page=tasks" <?= $currentPage === "tasks" ? 'style="font-weight: bold;"': ''; ?>>Задачи</a>
        |
            <a href="?page=logout" >Выйти <?= htmlspecialchars($_SESSION['user_email']); ?></a>
        <?php endif; ?>
    </nav>

    <hr>
