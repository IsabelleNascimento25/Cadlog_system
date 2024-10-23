<?php
 
// inclui arquivos de controlador para lidar com diferentes ações//
require 'controllers/AuthController.php';
require 'controllers/UserController.php';
require 'controllers/DashboardController.php';
 
//cria instancias dos controladores para ultilizar seus metodos//
$authController = new AuthController();
$userController = new UserController();
$dashboardController = new DashboardController();
 
//coleta a ação da url, se não tiver nenhum login definido ele usa 'login' por padão//
$action = $_GET['action'] ?? 'login';
 
// verifica a ação solicitada e chama o metodo apropriado do controlador//
switch($action){
    case 'login':
        $authController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'dashboard':
        $dashboardController->index();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'list':
        $userController->list();
        break;
    default:
        $authController->login();
        break;
}
?>