<?php
//Inclui arquivos de controlador para lidar com diferentes ações como, listar usuário cadastrados, cadastrar os usuários, etc.
require 'controllers/AuthController.php'; //Inclui o controlador de autenticação
require 'controllers/UserController.php'; //Inclui o controlador de usuário
require 'controllers/DashboardController.php'; //Inclui o controlador de dashboard

//Cria instâncias dos controladores para utilizar os métodos
$authController = new AuthController(); //Instancia o controlador de autenticação
$userController = new UserController();
$dashboardController = new DashboardController();

//Coleta a ação da url, se não houver ação definida, usa login por padrão
$action = $_GET['action'] ?? 'login'; //Usa operador de coalescência nula (??) para definir 'login' se 'action' não estiver presente

//Verifica a ação solicitada e chama o método apropriado do controlador
switch($action){
    case 'login':
        $authController->login(); //Chama o método de login do controlador de autenticação
        break;
        case 'register':
            $userController->register();
            break;
            case 'logout':
                $authController ->logout();
                break;
        default:
        $authController->login();
        break;
}
?>