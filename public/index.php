<?php
session_start();
require_once __DIR__ . '/../config/autoload.php'; // Ruta corregida
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/models/Usuario.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'login':
        $authController = new AuthController();
        $authController->login();
        break;
    case 'registro':
        $authController = new AuthController();
        $authController->registro();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'listar':
        $tareaController = new TareaController();
        $tareaController->listar();
        break;
    case 'crear':
        $tareaController = new TareaController();
        $tareaController->crear();
        break;
    case 'editar':
        $tareaController = new TareaController();
        $tareaController->editar($id);
        break;
    case 'eliminar':
        $tareaController = new TareaController();
        $tareaController->eliminar();
        break;
    case 'generarPDF':
        $tareaController = new TareaController();
        $tareaController->generarPDF();
        break;
    default:
        header("Location: index.php?action=login");
        break;
}
?>