<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento | Singularis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/agendamento.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://apis.google.com/js/api.js"></script>
</head>

<body>


    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Main Content -->
    <main>
        <div class="main-header">
            <h1>AGENDAMENTO</h1>
        </div>

        <div class="agenda-container">
            <div class="agenda-selector">
                <label for="selector">Escolha uma especialidade:</label>
                <select type="text" id="selector" onchange="carregarConteudoAgenda()">
                    <option value="" disabled selected>Selecione uma especialidade</option>
                    <option value="Psicologia">Psicologia</option>
                    <option value="Terapia Ocupacional">Terapia Ocupacional</option>
                    <option value="Fonoaudiologia">Fonoaudiologia</option>
                    <option value="Apoio Pedagógico">Apoio Pedagógico</option>
                </select>

                <label for="datepicker">Escolha uma data:</label>
                <input type="text" id="datepicker" placeholder="Selecione a data" disabled>

                <div id="horarios"></div>
            </div>



            <div class="equipe-selector">
                <style>
                    .equipe-selector label {
                        display: block;
                        text-align: center;
                        margin-bottom: 10px;
                        font-size: 16px;
                    }
                </style>

                <label>Escolha um profissional:</label>
                <div id="equipeSelector" class="equipe-container">
                    <!-- DINAMICO -->
                </div>
            </div>

    </main>



    <!-- Footer -->
    <?php include('footer.php'); ?>


    <script src="js/calendario1.js" defer></script>
    <script src="js/calendario2.js" defer></script>
</body>

</html>