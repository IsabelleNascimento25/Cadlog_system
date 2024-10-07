# Cadlog_system

# CadEcommerce

# Índice
[Projeto](#projeto)  
[Descrição](#descrição)  
[Estrutura do Projeto](#estrutura-do-projeto)  
[Funcionalidades](#funcionalidades)  
[Tecnologias utilizadas](#tecnologias-utilizadas)  
[Autores](#autores)  
[Contribuindo no GitHub](#contribuindo-no-github)  
<br>

# Projeto 
O CadLogin-System é um sistema de autenticação de usuários desenvolvido em PHP, que permite realizar o cadastro, login e gerenciamento de usuários. Ele foi criado com a finalidade de servir como exemplo de um sistema de controle de acesso com diferentes perfis de usuário, proporcionando uma solução completa de CRUD (Criar, Ler, Atualizar e Excluir) para pequenas aplicações web.
<br><br>
Disciplina:Programação Web III. <br>
Professor: Leonardo Santiago Sidon da Rocha.

## Descrição


O **Sistema de Gerenciamento de Usuários** é uma aplicação web que permite o registro e autenticação de usuários, gerenciando diferentes perfis de acesso (admin, gestor, colaborador). A interface do sistema foi projetada para ser intuitiva e responsiva, proporcionando uma experiência de usuário fluida.

# Exemplos das Telas

### 1. Tela de Registro de Usuário

Esta tela permite que novos usuários se cadastrem no sistema. O formulário coleta informações como nome, email, senha e perfil.

**Exemplo de Formulário de Registro:**

  <img src="img/login.png" width="200%"> <br>

### 2. Tela de Login

A tela de login permite que usuários registrados acessem o sistema utilizando seu email e senha. Ela inclui um link para a tela de registro, caso o usuário ainda não tenha uma conta.

**Exemplo de Formulário de Login:**

  <img src="img/registro.png" width="200%"> <br>

### 3. Tela Inicial do Sistema

Após o login, o usuário é direcionado para a tela inicial, onde pode acessar funcionalidades de acordo com seu perfil. Por exemplo, um administrador pode ter acesso a opções de gerenciamento de usuários, enquanto um colaborador pode visualizar suas tarefas.

**Exemplo de Tela Inicial:**

(ainda nao formulada)

---

## Banco de Dados

O banco de dados armazena informações dos usuários, incluindo seus nomes, emails, senhas e perfis. 

**Exemplo da Estrutura do Banco de Dados:**

  <img src="img/banco_de_dados.png" width="200%"> <br>

## Estrutura do Projeto
1. Banco de Dados
Código:
<br>
sql
Copiar código
CREATE DATABASE sistema_usuarios;

USE sistema_usuarios;

```
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'gestor', 'colaborador') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Explicação: A primeira etapa da aplicação envolve a criação do banco de dados sistema_usuarios, onde serão armazenados os dados dos usuários. 
<br><br> A tabela usuarios possui os seguintes campos:
<br>
id: Identificador único do usuário.<br>
* nome: Nome do usuário.<br>
* email: Endereço de email, que deve ser único para cada usuário.<br>
* senha: Senha criptografada do usuário.<br>
* perfil: Tipo de usuário (admin, gestor ou colaborador).<br>
* created_at: Timestamp que registra a data e hora de criação do registro.<br>
<br><br>
2. Conexão com o Banco de Dados.<br>
<br>
```
class Database {
    private static $instance = null;

    public static function getConnection() {
        if (!self::$instance) {
            $host = 'localhost';
            $db = 'sistema_usuarios';
            $user = 'root';
            $password = '';

            self::$instance = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
        }
    }
```
<br>
Explicação: Aqui, implementamos o padrão Singleton para garantir que haja apenas uma instância da conexão com o banco de dados durante toda a execução da aplicação. O método getConnection() usa PDO para se conectar ao banco de dados MySQL, e configura o modo de erro para lançar exceções em caso de problemas, facilitando a depuração.
<br><br>
3. Modelo de Usuário (User Model)
<br>

```
php
Copiar código
class User {
    public static function findByEmail($email) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (:nome, :email, :senha, :perfil)");
        $stmt->execute($data);
    }
    }
```
Explicação: A classe User representa o modelo de usuário, responsável por interagir diretamente com o banco de dados. Ela possui três métodos:
<br>
findByEmail($email): Busca um usuário pelo email, retornando os dados do usuário ou null se não encontrar.<br>
find($id): Busca um usuário pelo ID.<br>
create($data): Insere um novo usuário no banco de dados utilizando os dados fornecidos (nome, email, senha e perfil).<br><br>
4. Controller de Autenticação (AuthController)<br><br>
```

php
Copiar código
require_once 'models/user.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $user = User::findByEmail($email);
            
            // Lógica de validação de senha será implementada aqui
        }
    }
}
```
Explicação: A classe AuthController gerencia o processo de login. Ela verifica se o formulário foi enviado via POST, busca o usuário pelo email usando o modelo User, e a validação da senha poderia ser adicionada aqui (por exemplo, utilizando password_verify() para comparar a senha fornecida com a senha criptografada no banco de dados).
<br><br>
5. Controller de Usuário (UserController)<br>


```


class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
                'perfil' => $_POST['perfil']
            ];
            User::create($data);
            header('Location: index.php');
        } else {
            include 'views/register.php';
        }
    }
}
```
Explicação: A classe UserController é responsável pelo processo de registro de novos usuários. Ela verifica se a requisição foi enviada via POST, coleta os dados do formulário, criptografa a senha com password_hash(), e usa o método create() da classe User para salvar o novo usuário no banco de dados. Se a requisição for GET, ela carrega a página de registro.
<br><br>
6. Formulário de Registro de Usuário (Front-end)<br>

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se</title>
    <style>
        /* CSS para estilização da página de registro */
    </style>
</head>
<body>
    <div>
        <h2>Cadastro de Usuário</h2>
        <form action="" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <label for="perfil">Perfil:</label>
            <select name="perfil" id="perfil">
                <option value="admin">Admin</option>
                <option value="gestor">Gestor</option>
                <option value="colaborador">Colaborador</option>
            </select>
            <button type="submit">Cadastrar</button>
            <a href="">Voltar ao login</a>
        </form>
    </div>
</body>
</html>
```
Explicação: Este é o formulário de registro que será exibido para o usuário. Ele coleta nome, email, senha e perfil (Admin, Gestor ou Colaborador) e os envia ao servidor via POST. O estilo foi configurado para centralizar e melhorar a experiência visual.

7. Formulário de Login (Front-end)

```
html
Copiar código
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <style>
        /* CSS para estilização da página de login */
    </style>
</head>
<body>
<main>
    <form method="post" action="index.php?action=login">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="index.php?action=register">Cadastrar-se</a>
</main>
</body>
</html>
```
Explicação: Esta página permite que os usuários façam login no sistema. Ela coleta o email e a senha e envia os dados ao AuthController via POST. Se o usuário ainda não tiver uma conta, há um link para o formulário de registro.
<br>
Fluxo da Aplicação:<br>
* O usuário acessa a página de login ou registro.<br>
* No registro, os dados são enviados ao UserController, que os insere no banco de dados.<br>
* No login, os dados são enviados ao AuthController, que verifica a existência do usuário e a validade da senha.<br>
* A aplicação utiliza o padrão MVC, onde o Modelo (User) lida com a lógica de interação com o banco de dados, o Controller (AuthController, UserController) lida com o fluxo de entrada e saída de dados, e as Views (formulários) gerenciam a interface com o usuário.<br>



## Funcionalidades


| Método/Comando                               | Descrição                                                                                       | Exemplo                                                      |
|----------------------------------------------|-------------------------------------------------------------------------------------------------|--------------------------------------------------------------|
| [**CREATE DATABASE**](https://www.php.net/manual/pt_BR/sql.create-database.php)                | Cria um novo banco de dados chamado sistema_usuarios.                                        | `CREATE DATABASE sistema_usuarios;`                        |
| [**USE**](https://www.php.net/manual/pt_BR/sql.use.php)                                        | Seleciona o banco de dados sistema_usuarios para operações subsequentes.                     | `USE sistema_usuarios;`                                     |
| [**CREATE TABLE**](https://www.php.net/manual/pt_BR/sql.create-table.php)                      | Cria uma nova tabela chamada usuarios para armazenar informações dos usuários.                | `CREATE TABLE usuarios (...);`                              |
| [**AUTO_INCREMENT**](https://www.php.net/manual/pt_BR/sql.auto-increment.php)                  | Define que o campo id é incrementado automaticamente para cada novo registro.                | `id INT AUTO_INCREMENT PRIMARY KEY`                          |
| [**VARCHAR**](https://www.php.net/manual/pt_BR/sql.varchar.php)                                | Define o tipo de dados como uma string de comprimento variável, com tamanho máximo especificado. | `nome VARCHAR(100) NOT NULL`                                |
| [**UNIQUE**](https://www.php.net/manual/pt_BR/sql.unique.php)                                  | Garante que os valores da coluna email sejam únicos na tabela.                               | `email VARCHAR(100) NOT NULL UNIQUE`                        |
| [**ENUM**](https://www.php.net/manual/pt_BR/sql.enum.php)                                     | Define uma lista de valores permitidos para a coluna perfil.                                 | `perfil ENUM('admin', 'gestor', 'colaborador') NOT NULL`   |
| [**TIMESTAMP**](https://www.php.net/manual/pt_BR/sql.timestamp.php)                            | Cria um registro da data e hora em que o usuário foi criado.                                 | `created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP`           |
| [**require_once**](https://www.php.net/manual/pt_BR/function.require.php)                      | Inclui e executa um arquivo específico, como database.php ou user.php.                      | `require_once 'models/database.php';`                       |
| [**class**](https://www.php.net/manual/pt_BR/language.oop5.basic.php)                         | Define uma nova classe, como Database ou User, que encapsula métodos e propriedades.         | `class User {...}`                                         |
| [**private static \$instance**](https://www.php.net/manual/pt_BR/language.oop5.basic.php)     | Variável estática privada que armazena a única instância da classe para conexão com o banco de dados. | `private static $instance = null;`                          |
| [**public static function getConnection()**](https://www.php.net/manual/pt_BR/language.oop5.basic.php) | Método estático que retorna a conexão com o banco de dados, garantindo uma única instância. | `public static function getConnection() {...}`             |
| [**PDO**](https://www.php.net/manual/pt_BR/book.pdo.php)                                      | Classe PHP Data Objects para conexão com o banco de dados MySQL.                             | `new PDO("mysql:host=$host;dbname=$db", $user, $password);` |
| [**setAttribute()**](https://www.php.net/manual/pt_BR/pdo.setattribute.php)                    | Define o modo de erro para exceções, facilitando a depuração e tratamento de erros.          | `self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);` |
| [**public static function findByEmail(\$email)**](https://www.php.net/manual/pt_BR/language.oop5.basic.php) | Método que localiza um usuário pelo email no banco de dados.                                  | `public static function findByEmail($email) {...}`         |
| [**prepare()**](https://www.php.net/manual/pt_BR/pdo.prepare.php)                              | Prepara uma instrução SQL para execução.                                                      | `$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");` |
| [**execute()**](https://www.php.net/manual/pt_BR/pdo.execute.php)                              | Executa a instrução SQL preparada.                                                            | `$stmt->execute(['email' => $email]);`                     |
| [**fetch()**](https://www.php.net/manual/pt_BR/pdo.fetch.php)                                  | Recupera a próxima linha de um conjunto de resultados, retornando-a como um array associativo. | `return $stmt->fetch(PDO::FETCH_ASSOC);`                   |
| [**public static function find(\$id)**](https://www.php.net/manual/pt_BR/language.oop5.basic.php) | Método que localiza um usuário pelo ID no banco de dados.                                     | `public static function find($id) {...}`                   |
| [**public static function create(\$data)**](https://www.php.net/manual/pt_BR/language.oop5.basic.php) | Método que insere um novo usuário no banco de dados.                                          | `public static function create($data) {...}`               |
| [**public function login()**](https://www.php.net/manual/pt_BR/language.oop5.basic.php)        | Método que processa o login do usuário.                                                       | `public function login() {...}`                             |
| [**\$_SERVER['REQUEST_METHOD']**](https://www.php.net/manual/pt_BR/reserved.variables.php)     | Verifica o método da requisição HTTP (GET ou POST).                                           | `if (\$_SERVER['REQUEST_METHOD'] == 'POST') {...}`         |
| [**password_hash()**](https://www.php.net/manual/pt_BR/function.password-hash.php)            | Criptografa a senha do usuário antes de armazená-la no banco de dados.                        | `'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)` |
| [**header()**](https://www.php.net/manual/pt_BR/function.header.php)                           | Redireciona para outra página após uma operação, como após o registro de um usuário.          | `header('Location: index.php');`                           |
| [**include**](https://www.php.net/manual/pt_BR/function.include.php)                           | Inclui um arquivo PHP, como uma view para exibir um formulário de registro.                  | `include 'views/register.php';`                             |


## Tecnologias utilizadas

`PHP`: Linguagem de programação utilizada para o back-end, gerenciando a lógica de controle e interação com o banco de dados.<br>
`MySQL`: Banco de dados relacional usado para armazenar e gerenciar os dados dos usuários.<br>
`HTML/CSS`: Estrutura e estilização das páginas de interface com o usuário.<br>
`JavaScript`: Utilizado para melhorar a experiência do usuário, com validações e interações dinâmicas no front-end.<br>
`Apache/Nginx`: Servidores web compatíveis para rodar o sistema.<br>

<br>
Aluna: <br>
<br>
 <img src="img/isabelle.png" width="60px"> Isabelle Nascimento de Oliveira <br>
<br>

* Professor Leonardo Santiago Sidon da Rocha.

## Contribuindo no GitHub

**Se você encontrou um problema, deseja sugerir melhorias ou simplesmente quer dar um feedback sobre o projeto, você pode contribuir fazendo um fork do repositório. Após fazer o fork, você pode:**

1. Fazer as modificações necessárias no seu repositório.
2. Enviar um pull request para o repositório original.

Agradeco sua contribuição!
