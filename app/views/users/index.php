<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Users</h1>

    <form method="post" action="?action=<?= $editUser ? 'update&id='. $editUser['id'] : 'store' ?>">
        <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($editUser['name'] ?? '' ) ?>">
        <input type="text" name="email" placeholder="E-mail" value="<?= htmlspecialchars($editUser['email'] ?? '' ) ?>">
        <button type="submit"><?= $editUser ? 'Изменить' : 'Добавить' ?></button>
    </form>
    <hr>

    <!-- Список пользователей -->
    <ul>
        <?php foreach($users as $user): ?>
            <li>
                <?= htmlspecialchars($user['name']) ?> -
                <?= htmlspecialchars($user['email']) ?>

                <a href="?action=edit&id=<?= $user['id'] ?>">Изменить</a>
                <a href="?action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Удалить?');">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>