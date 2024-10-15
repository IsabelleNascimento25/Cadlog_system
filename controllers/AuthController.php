<?php
 
//requer arquivo 'user.php' que contem o model user com as funções para manipulação de dados de usuarios//
require_once 'models/user.php';
 
class AuthController{
    //cria função responsavel pelo processo de login//
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
 
            $user = User::findByEmail($email);
 
            if($user && password_verify($senha, $user['senha'])){//verifica se a senha corresponde um hash//
                session_start();
 
                //armazena na sessão o Id do ususario e seu perfil
 
                $_SESSION['usuario_id']= $user['id'];
                $_SESSION['perfil']    = $user['perfil'];
 
                header('location: index.php?action=dashboard');
                echo "Email ou senha incorretos";
 
            }
        } else{
            //se a requisição não for POST(por exemplo, GET), carrega a pagina de registro
            include 'views/login.php';
        }
    }
}

public function logout (){
    session_start();
    session_destroy();
    header(('Location: index.php');
    )
}
?>