<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/TaskController.php';

$page = $_GET['page'] ?? 'tasks';
if($page === 'tasks'){
    // Tasks CRUD

$taskController = new TaskController($pdo);

$taskAction = $_GET['taskAction'] ?? 'index';
$taskId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($taskAction === "store" && $_SERVER['REQUEST_METHOD'] === "POST"){
    $taskController->store($_POST);
}
if($taskAction === "update" && $_SERVER['REQUEST_METHOD'] === "POST"){
    $taskController->update($taskId, $_POST);
}
if($taskAction === "delete" && $taskId > 0){
    $taskController->destroy($taskId);
}

$editTask = null;
if($taskAction === "edit" && $taskId > 0){
    $editTask = $taskController->edit($taskId);
}

$tasks = $taskController->index();

require_once __DIR__ . '/../app/views/tasks/index.php';
}

else{
// Users CRUD

$controller = new UserController($pdo);

$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($action === "store" && $_SERVER['REQUEST_METHOD'] === "POST"){
    $controller->store($_POST);
}
if($action === "update" && $_SERVER['REQUEST_METHOD'] === "POST"){
    $controller->update($id, $_POST);
}
if($action === "delete" && $id > 0){
    $controller->destroy($id);
}

$editUser = null;
if($action === "edit" && $id > 0)
    $editUser = $controller->edit($id);

$users = $controller->index();

require_once __DIR__ . '/../app/views/users/index.php';

}

