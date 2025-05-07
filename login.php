<?php 
require_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Singularis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css"> 
    <link rel="stylesheet" href="css/formularios.css"> 
</head>
<body>
    
    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Main Content -->
    <main>
        <div class="main-header">
            <h1>ENTRAR</h1>
        </div>

        <div class="login-container">
            <form class="login-form" method="POST" action="autenticar.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="seuemail@email.com" required>
                </div>
    
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-wrapper">
                        <input type="password" id="senha" name="senha" placeholder="Senha" required>
                        <i class="toggle-password fas fa-eye"></i>
                    </div>
                </div>
    
                <div class="login-submit">
                    <button type="submit" class="login-btn">Seguir</button>
                </div>
            </form>
        </div>

        <?php if (isset($_GET['erro'])): ?>
            <script>
                window.onload = function() {
                    alert("Email ou senha incorretos. Tente novamente.");
                };
            </script>
        <?php endif; ?>

    </main>

   
    <!-- Footer -->
    <?php include('footer.php'); ?>


    <script src="js/login.js"></script>
</body>
</html>
