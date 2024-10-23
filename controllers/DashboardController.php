<?php
class DashboardController{
    //inicia a sessão para verificar se o ususario está autenticado
 
    public function index(){
 
        session_start();
 
        //verifica se a variação de sessão "usuario_id" esta definida
        //se não estiver, significa que o usuario não esta autenticado
        if(!isset($_SESSION['usuario_id'])){
            header('Location: index.php');
            exit;
        }
        include 'views/dashboard.php';
    }
}
?>