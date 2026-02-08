<?php require_once __DIR__ . '/../layout/header.php' ?>

<h1>Вход</h1>
<?php if(!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars("$error") ?></p>
<?php endif; ?>
    <form action="?page=login" method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">

        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Пароль">
        <button type="submit">Войти</button>
    </form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>