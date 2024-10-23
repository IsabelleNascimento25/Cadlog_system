<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se</title>
    <style>
        /* Reset básico */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Estilo do corpo */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            margin: 0;
        }

        /* Caixa de cadastro */
        div {
            background-color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        /* Efeito hover para aumentar a caixa */
        div:hover {
            transform: scale(1.05);
        }

        /* Título */
        h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 2rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        h2:hover{
            font-size: 4rem;
        }

        /* Inputs e select */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease, transform 0.2s ease;
        }

        /* Efeito ao focar nos campos */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
            transform: scale(1.02);
        }

        /* Botão de cadastro */
        button {
            background-color: #333;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Efeito hover no botão */
        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Link "Voltar ao login" */
        a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease, font-size 0.3s ease;
        }

        /* Efeito hover no link */
        a:hover {
            color: #0056b3;
            font-size: 1.05rem;
        }

        /* Animação de transição suave ao abrir */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        div {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>

<body>

    <div>
        <h2>Cadastro de Usuário</h2>
        <form action="index.php?action=register" method="post">
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
            <a href="index.php?action=login">Voltar ao login</a>
        </form>
    </div>

</body>

</html>
