<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$nomeResponsavel = explode('@', $usuario)[0];
$nomeCrianca = "Luna Fernandes";
$idadeCrianca = 5;
$consultasFuturas = [
    ["Data" => "2025-05-10", "Hora" => "14:30", "Especialidade" => "Pediatria"],
    ["Data" => "2025-06-02", "Hora" => "10:00", "Especialidade" => "Oftalmologia Infantil"]
];
$consultasPassadas = [
    ["Data" => "2025-04-12", "Especialidade" => "Dermatologia", "Resumo" => "Tratamento de alergia a picada de inseto"],
    ["Data" => "2025-03-20", "Especialidade" => "Nutrição", "Resumo" => "Avaliação alimentar e plano nutricional infantil"]
];
$vacinasPendentes = ["Hepatite A (2ª dose)", "Varicela", "Febre amarela"];
$examesRecentes = [
    ["Nome" => "Exame de sangue completo", "Data" => "2025-04-01", "Resultado" => "Normal"],
    ["Nome" => "Raio-X tórax", "Data" => "2025-03-05", "Resultado" => "Sem alterações"]
];
$observacoes = "Paciente em bom estado geral. Leve rinite alérgica em períodos sazonais. Recomendado uso diário de protetor solar.";
$clinicaInfo = [
    "Nome" => "Clínica Infantil Esperança",
    "Endereço" => "Av. dos Pioneiros, 1234 - Centro",
    "Contato" => "(98) 3333-4444",
    "Horário" => "Seg a Sex, 08h às 18h"
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Portal do Responsável</title>
    <link rel="stylesheet" href="./css/portal.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

    <!-- Header -->
    <?php include('header.php'); ?>

<main>
    <h1>Portal do Responsável</h1>
    <p><strong>Responsável logado:</strong> <?php echo $usuario; ?></p>

    <h2>Informações da Criança</h2>
    <p><strong>Nome:</strong> <?php echo $nomeCrianca; ?></p>
    <p><strong>Idade:</strong> <?php echo $idadeCrianca; ?> anos</p>

    <h3>Consultas Futuras</h3>
    <ul>
        <?php foreach ($consultasFuturas as $consulta): ?>
            <li><?php echo "{$consulta['Data']} às {$consulta['Hora']} - {$consulta['Especialidade']}"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Consultas Realizadas</h3>
    <ul>
        <?php foreach ($consultasPassadas as $consulta): ?>
            <li><?php echo "{$consulta['Data']} - {$consulta['Especialidade']}: {$consulta['Resumo']}"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Vacinas Pendentes</h3>
    <ul>
        <?php foreach ($vacinasPendentes as $vacina): ?>
            <li><?php echo $vacina; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Exames Recentes</h3>
    <ul>
        <?php foreach ($examesRecentes as $exame): ?>
            <li><?php echo "{$exame['Data']} - {$exame['Nome']}: {$exame['Resultado']}"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Observações do Pediatra</h3>
    <p><?php echo $observacoes; ?></p>

    <hr>

    <h2>Informações da Clínica</h2>
    <p><strong>Nome:</strong> <?php echo $clinicaInfo['Nome']; ?></p>
    <p><strong>Endereço:</strong> <?php echo $clinicaInfo['Endereço']; ?></p>
    <p><strong>Contato:</strong> <?php echo $clinicaInfo['Contato']; ?></p>
    <p><strong>Horário de Funcionamento:</strong> <?php echo $clinicaInfo['Horário']; ?></p>

    <hr>

    <div class="logout"><a href="index.php">Sair do Portal</a></div>
</main>

    <!-- Footer -->
    <?php include('footer.php'); ?>


</body>
</html>
