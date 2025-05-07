
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singularis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css"> 
    <link rel="stylesheet" href="css/inicio.css">
</head>
<body>
    
    <!-- Header -->
    <?php include('header.php'); ?>

    
    <!-- DEPOIS VER COMO DEIXAR IMAGEM DENTRO DE MAIN-->
    <img class="banner" src="src/img/inicio-banner.png">

    <!-- Main Content -->
    <main>
        <div class="main-header">
            <h1>NOSSAS ESPECIALIDADES</h1>
            <br/>
            <div class="especialidades-header">
                <a href="especialidade.html?nome=Psicologia"><img src="src/img/psicologia.png"></a>
                <a href="especialidade.html?nome=Terapia Ocupacional"><img src="src/img/ocupacional.png"></a>
                <a href="especialidade.html?nome=Fonoaudiologia"><img src="src/img/fonoaudiologia.png"></a>
                <a href="especialidade.html?nome=Apoio Pedagógico"><img src="src/img/pedagogico.png"></a>
            </div>
        </div>

        <div id="about" class="about-container">
    <div class="about-content">
        <h2>SINGULARIS</h2>
        <h3>O lugar onde a singularidade de cada criança floresce.</h3>
        <p>
            A Singularis é uma clínica especializada no atendimento de crianças neurodivergentes, oferecendo um ambiente acolhedor e personalizado para cada criança. Nosso compromisso é promover o desenvolvimento e o bem-estar de cada pequeno de forma única, respeitando suas necessidades individuais e ritmo próprio. Através de terapias especializadas, trabalhamos para criar um espaço seguro, de confiança e crescimento, onde cada criança pode prosperar e alcançar seu pleno potencial. Na Singularis, acreditamos que a singularidade de cada criança é sua maior força.
        </p>
        <p>
            Contamos com uma equipe multidisciplinar dedicada e altamente qualificada, composta por profissionais que têm paixão por apoiar o desenvolvimento das crianças de maneira empática e eficaz. Com uma abordagem que envolve tanto as terapias tradicionais quanto alternativas, buscamos criar estratégias personalizadas que atendam às necessidades de cada criança e suas famílias.
        </p>
    </div>

    <img src="src/img/sobre-img.svg" alt="Imagem sobre a Singularis">
</div>

        

        <div id="equipe" class="main-equipe">
            <h1>NOSSA EQUIPE</h1>
        </div>

        <div id="equipeContainer" class="equipe-container">
        </div>

    </main>

    
       


    <!-- Footer -->
    <?php include('footer.php'); ?>


    <!-- Scripts -->
    <script src="js/dinamico.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
