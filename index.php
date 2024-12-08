<?php
require_once '/tlunews/config.php';  
require_once "/tlunews/controllers/AdminController.php";
require '/tlunews/controllers/NewsController.php';

$controller = new AdminController($db);

$action = $_GET['action'] ?? 'index';

$request = $_SERVER['REQUEST_URI'];


$request = str_replace('/tlunews/tlunews/index.php', '', $request);


$controller = null;


if ($request == '/news' || $request == '/') {
    
    $controller = new NewsController($pdo);
    $controller->index();
} elseif (preg_match('/^\/news\/(\d+)$/', $request, $matches)) {
    
    $controller = new NewsController($pdo);
    $controller->detail($matches[1]);
} else {
    
    echo "404 Not Found";
}

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

