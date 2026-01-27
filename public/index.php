<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

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
