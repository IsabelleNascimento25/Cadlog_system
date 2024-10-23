<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
</head>
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

        /* Estilização da caixa de login */
        main {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 350px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        /* Efeito hover para crescer levemente a caixa */
        main:hover {
            transform: scale(1.05);
        }

        /* Título da tela de login */
        h1 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 2rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        /* Inputs de email e senha */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease, transform 0.2s ease;
        }

        /* Efeito ao focar nos campos */
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            transform: scale(1.02);
        }

        /* Botão de login */
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

        /* Estilização do link "Cadastrar-se" */
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

        main {
            animation: fadeIn 0.6s ease-out;
        }

    </style>
<body>
    <!-- O formulário usa o método POST para enviar dados de forma segura -->
    <!-- Os dados serão enviados para 'index.php' com a ação 'login' -->
<main> <form method="post" action="index.php?action=login">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Login</button>
    </form>
    <!-- Define o destino do link e leva à opção de cadastro -->
    <a href="index.php?action=register">Cadastrar-se</a>
</main>

</body>
</html>