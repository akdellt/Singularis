<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | Singularis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --branco: #ffffff;
            --cinza-claro: #f0f0f0;
            --cinza-escuro: #333333;
            --azul-petroleo: #005f73;
            --azul-destaque: #0a9396;
            --rosa-claro: #f28482;
            --rosa: #e63946;
            --amarelo: #ffdd4a;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--cinza-claro);
        }

        .login-container {
            width: 100%;
            max-width: 700px;
            margin: 50px auto;
            background-color: var(--branco);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-submit {
            text-align: center;
            margin-top: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--azul-petroleo);
        }

        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--cinza-claro);
            border-radius: 5px;
            font-size: 16px;
            background-color: var(--cinza-claro);
            transition: border 0.3s;
        }

        input:focus, textarea:focus {
            border-color: var(--azul-destaque);
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-submit .submit-btn {
            background-color: var(--rosa-claro);
            color: var(--amarelo);
            border: none;
            padding: 10px 40px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 600;
            opacity: 0.7;
            transition: all 0.3s;
            cursor: pointer;
        }

        .form-submit .submit-btn:hover {
            opacity: 1;
            background-color: var(--rosa);
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            color: var(--rosa);
            font-size: 24px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: var(--azul-petroleo);
        }

        @media (max-width: 590px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Main Content -->
    <main>
        
        <div class="main-header">
            <h1>CONTATO</h1>
        </div>

        <div class="login-container">
            <form action="processar-contato.php" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="assunto">Assunto</label>
                        <input type="text" id="assunto" name="assunto" placeholder="Digite o assunto" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" placeholder="Digite sua mensagem" required></textarea>
                    </div>
                </div>
                <div class="form-submit">
                    <button type="submit" class="submit-btn">Enviar</button>
                </div>
            </form>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('footer.php'); ?>
</body>
</html>