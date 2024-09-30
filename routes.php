<?php
//inclui arquivos de controlador para lidar com diferentes açóes 

require 'controllers/AuthController.php';
//inclui o controlador de autenticação
require 'controllers/UserController.php';
//inclui o controlador de usuário
require 'controllers/DashboardController.php';
//inclui o controlador de dashboard

//Cria instânciais dos controladores para utilizar seus métodos 
$authController = new AuthController(); 
$userController = new UserController(); 

//Instância 

//Coleta a ação da URL se não houver definida, usa "login por padrão"

$action = $_GET ['action'] ?? 'login'; //Usa operador de coalescência nula (??) para definir 'login' se 'action não estiver presente'

switch($action){
    case 'login':
        //Verifica a ação solicitada e chama o método apropriado do controlador
        $authController -> login();//Chama o método login do controlador de autenticação
        
}

?>