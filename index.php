<?php
require_once "controllers/AdminController.php";
$controller = new AdminController($db);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'show':
        $id = $_GET['id'] ?? 0;
        $controller->show($id);
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store($_POST);
        break;
    case 'edit':
        $id = $_GET['id'] ?? 0;
        $controller->edit($id);
        break;
    case 'update':
        $id = $_GET['id'] ?? 0;
        $controller->update($id, $_POST);
        break;
    case 'delete':
        $id = $_GET['id'] ?? 0;
        $controller->delete($id);
        break;
    default:
        echo "Action không hợp lệ.";
}
?>