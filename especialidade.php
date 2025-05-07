<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidade | Singularis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css"> 
    <link rel="stylesheet" href="css/especialidade.css"> 
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Main Content -->
    <main>
        <div class="main-header">
            <h1 id="titulo"></h1>
        </div>

        <div class="especialidade-container">
            <div id="especialidade" class="especialidade-content">
                <!-- DINAMICO -->
            </div>

            <div id="equipeFilter" class="equipe-container">
    <h3>Profissionais da Especialidade</h3>
    <!-- Os profissionais serão carregados aqui -->
</div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <script src="js/dinamico.js"></script>
    <script src="carregarEquipe.js"></script>
</body>
</html>