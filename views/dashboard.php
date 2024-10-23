<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #F0F2F5; /* Cor de fundo consistente */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            margin: 0;
        }

        /* Caixa de conteúdo */
        .container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease; /* Adicionando transição */
        }

        /* Efeito hover para aumentar a caixa */
        .container:hover {
            transform: scale(1.05);
        }

        /* Título */
        h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            transition: color 0.3s ease;
        }

        /* Parágrafo */
        p {
            color: #6D6D6D;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        /* Botão */
        .btn {
            display: inline-block;
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
            margin-top: 10px; /* Margem superior */
        }

        /* Efeito hover no botão */
        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Cores para diferentes perfis */
        body.admin {
            background-color: #FBE7C6;
        }

        body.gestor {
            background-color: #E6E6FA;
        }

        body.colaborador {
            background-color: #FFDDC1;
        }

        /* Link para logout */
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

        .container {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>

<body class="<?=$_SESSION['perfil']?>"> <!-- Define a classe com base no perfil -->
    <div class="container">
        <h1>Bem-vindo, <?=$_SESSION['perfil']?>!</h1>
        <p>Esta é a visão do perfil <?=$_SESSION['perfil']?>.</p>

        <?php if($_SESSION['perfil'] == 'admin'): ?>
            <a href="index.php?action=list" class="btn">Gerenciar Usuários (Admin)</a>
        <?php elseif($_SESSION['perfil'] == 'gestor'): ?>
            <a href="index.php?action=list" class="btn">Gerenciar Usuários (Gestor)</a>
            <p>Área exclusiva do Gestor.</p>
        <?php else: ?>
            <p>Área exclusiva do Colaborador.</p>
        <?php endif; ?>

        <a href="index.php?action=logout" class="btn">Logout</a>
    </div>
</body>

</html>
