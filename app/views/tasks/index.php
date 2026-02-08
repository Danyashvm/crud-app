<?php require_once __DIR__ . '/../layout/header.php' ?>
    
    <h1>Tasks</h1>

    <?php if(!empty($error)): ?>
        <div class="error" style="color: red; font-weight: bold"> 
            <ul>
                <?php foreach($error as $errors): ?>
                    <li><?= htmlspecialchars($errors) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="?page=tasks&action=<?= $editTask ? 'update&id='. $editTask['id'] : 'store' ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
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

                <a href="?page=tasks&action=edit&id=<?= $task['id'] ?>">Изменить</a>
                <a href="?page=tasks&action=delete&id=<?= $task['id'] ?>" onclick="return confirm('Удалить?');">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php require_once __DIR__ . '/../layout/footer.php' ?>