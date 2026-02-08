<?php
session_start();
function requireAuth(): void {
    if(empty($_SESSION['user_id'])){
    header("Location: ?page=login");
    exit;
}
}
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/TaskController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

// Роутинг 

$page = $_GET['page'] ?? 'users';
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

switch($page){
    case 'tasks': 
        handleTasks($pdo, $action, $id);
        break;
    
    case 'users':
        handleUsers($pdo, $action, $id);
        break;

    case 'login':
        handleLogin($pdo);
        break;

    case 'logout':
        (new AuthController($pdo))->logout();
        break;
}

function handleTasks(PDO $pdo, string $action, int $id){
    requireAuth();

    $csrfToken = $_SESSION['csrf_token'];
    $controller = new TaskController($pdo);
    $error = [];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if($action === "store" && $_SERVER['REQUEST_METHOD'] === "POST"){
        $error = $controller->store($_POST) ?? [];
    }
    if($action === "update" && $_SERVER['REQUEST_METHOD'] === "POST"){
        $error = $controller->update($id, $_POST) ?? [];
    }
    if($action === "delete" && $id > 0){
        $controller->destroy($id);
    }

    $editTask = null;
    if($action === "edit" && $id > 0){
        $editTask = $controller->edit($id);
    }

    $tasks = $controller->index();
    $title = 'Задачи';
    require_once __DIR__ . '/../app/views/tasks/index.php';
}

function handleUsers(PDO $pdo, string $action, int $id){
    requireAuth();

    $csrfToken = $_SESSION['csrf_token'];
    $error = [];
    $controller = new UserController($pdo);

    if($action === "store" && $_SERVER['REQUEST_METHOD'] === "POST"){
        $error = $controller->store($_POST) ?? [];
    }
    if($action === "update" && $_SERVER['REQUEST_METHOD'] === "POST"){
        $error = $controller->update($id, $_POST) ?? [];
    }
    if($action === "delete" && $id > 0){
        $controller->destroy($id);
    }

    $editUser = null;
    if($action === "edit" && $id > 0)
        $editUser = $controller->edit($id);

    $users = $controller->index();
    $title = 'Пользователи';
    require_once __DIR__ . '/../app/views/users/index.php';
}

function handleLogin(PDO $pdo): void{
    $controller = new AuthController($pdo);
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $error = $controller->login($_POST);
    }

    $csrfToken = $_SESSION['csrf_token'];
    $title = 'Вход';

    require_once __DIR__ . '/../app/views/auth/login.php';
}
