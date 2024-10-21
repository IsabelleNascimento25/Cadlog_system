<?php
//Requere arquivo 'user.php' que contém o model user com as funções para manipulação de dados de usuários
require_once 'models/user.php';

class AuthController{
    //Cria função responsável pelo processo de login
    public function login ()
    {
        //Verifica se a requisição HTTP é do tipo POST, ou seja, se o formulário foi enviado
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $user = User::findByEmail($email);

            if ($user && password_verify($senha, $user['senha'])){//Verifica se a senha corresponde a um hash
                session_start();

                //Armazena na sessão o ID do usuário e seu perfil
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['perfil'] =  $user['perfil'];

                header('Location: index.php?action=dashboard');
            }else{
                echo "Email ou senha incorreto";
            }

        }else{
            //Se a requisição não for POST, por exemplo GET, carrega a página de registro
            include 'views/login.php';
        }
       
    }
    public function logout(){
            session_start();
            session_destroy();
            header('Location: index.php');
    }
}
?>