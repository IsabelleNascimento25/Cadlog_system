<?php
//Definição da classe UseController, reponsavel por gerenciar as ações relacionadas aos usuarios.//
class UserController
{

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT), //criptografa a senha//
                'perfil' => $_POST['perfil']

            ];

            User::create($data);
            header('Location: index.php');
        } else {
            // se a requisição nao for do tipo POST(por exemplo, GET), carrega a pagina de registro//
            include 'views/register.php';
        }
    }


    public function list()
    {
        $users = User::all();
        include 'views/list_user.php';
    }
}
