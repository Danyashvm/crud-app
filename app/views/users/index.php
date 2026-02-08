<?php require_once __DIR__ . '/../layout/header.php' ?>

    <h1>Users</h1>

    <?php if(!empty($error)): ?>
        <div class="error" style="color: red; font-weight: bold"> 
            <ul>
                <?php foreach($error as $errors): ?>
                    <li><?= htmlspecialchars($errors) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="?page=users&action=<?= $editUser ? 'update&id='. $editUser['id'] : 'store' ?>">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
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

                <a href="?page=users&action=edit&id=<?= $user['id'] ?>">Изменить</a>
                <a href="?page=users&action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Удалить?');">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php require_once __DIR__ . '/../layout/footer.php' ?>