<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Tasks</h1>
    <form action="?taskAction=<?= $editTask ? 'update&id='. $editTask['id'] : 'store' ?>" method="post">
        <input type="text" name="title" placeholder="Название" value="<?= htmlspecialchars($editTask['title'] ?? '' )?>">
        <input type="text" name="description" placeholder="Описание" value="<?= htmlspecialchars($editTask['description'] ?? '' )?>">
        Выполнено/Невыполнено <input type="checkbox" name="is_done">
        <button type="submit"><?= $editTask ? 'Изменить' : 'Добавить' ?></button>
    </form>
    <ul>
        <?php foreach($tasks as $task):  ?>
            <li>
                <?= htmlspecialchars($task['title']) ?>
                <?= htmlspecialchars($task['description']) ?>
                <?= $task['is_done'] == 0 ? htmlspecialchars("Невыполнено") : htmlspecialchars("Выполнено"); ?>

                <a href="?taskAction=edit&id=<?= $task['id'] ?>">Изменить</a>
                <a href="?taskAction=delete&id=<?= $task['id'] ?>" onclick="return confirm('Удалить?');">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>