<?php
// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco
    require_once('conexao.php');

    // Coleta e sanitiza os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $nascimento = $_POST['nascimento'];
    $diagnostico = $_POST['diagnostico'];
    $medicamentos = $_POST['medicamentos'];
    $motivacao = $_POST['motivacao'];
    $dificuldades = $_POST['dificuldades'];
    $desenvolvimento = $_POST['desenvolvimento'];

    // Verifica se o CPF já está cadastrado
    $sql_verifica = "SELECT id FROM criancas WHERE cpf = :cpf";
    $stmt_verifica = $pdo->prepare($sql_verifica);
    $stmt_verifica->bindParam(':cpf', $cpf);
    $stmt_verifica->execute();

    if ($stmt_verifica->rowCount() > 0) {
        $erro = "Já existe uma criança cadastrada com este CPF.";
    } else {
        // Insere os dados no banco
        $sql = "INSERT INTO criancas (nome, sobrenome, cpf, nascimento, diagnostico, medicamentos, motivacao, dificuldades, desenvolvimento)
                VALUES (:nome, :sobrenome, :cpf, :nascimento, :diagnostico, :medicamentos, :motivacao, :dificuldades, :desenvolvimento)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nascimento', $nascimento);
        $stmt->bindParam(':diagnostico', $diagnostico);
        $stmt->bindParam(':medicamentos', $medicamentos);
        $stmt->bindParam(':motivacao', $motivacao);
        $stmt->bindParam(':dificuldades', $dificuldades);
        $stmt->bindParam(':desenvolvimento', $desenvolvimento);

        if ($stmt->execute()) {
            echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'login.php';
            </script>";
            exit();
        } else {
            $erro = 'Erro ao cadastrar: ' . $stmt->errorInfo()[2];
        }        
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro da Criança</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/formularios.css">
</head>
<body>
    

    <!-- Header -->
    <?php include('header.php'); ?>


    
    <main>
    <div class="main-header">
        <h1>CADASTRE-SE</h1>
        <h2>Dados da criança</h2>
    </div>

    <form method="POST" class="registration-form">
        <div class="form-row">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" required>
            </div>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" required>
        </div>

        <div class="form-group">
            <label for="nascimento">Data de Nascimento</label>
            <input type="date" id="nascimento" name="nascimento" required>
        </div>

        <div class="form-group">
            <label for="diagnostico">Diagnóstico</label>
            <input type="text" id="diagnostico" name="diagnostico">
        </div>

        <div class="form-group">
            <label for="medicamentos">Medicamentos</label>
            <input type="text" id="medicamentos" name="medicamentos">
        </div>

        <div class="form-group">
            <label for="motivacao">Motivação do Atendimento</label>
            <textarea id="motivacao" name="motivacao"></textarea>
        </div>

        <div class="form-group">
            <label for="dificuldades">Principais Dificuldades</label>
            <textarea id="dificuldades" name="dificuldades"></textarea>
        </div>

        <div class="form-group">
            <label for="desenvolvimento">Desenvolvimento Infantil</label>
            <textarea id="desenvolvimento" name="desenvolvimento"></textarea>
        </div>

        <div class="form-submit">
            <button type="submit" class="submit-btn">Cadastrar</button>
        </div>

        <?php if (isset($erro)): ?>
            <p class="error"><?= $erro ?></p>
        <?php elseif (isset($sucesso)): ?>
            <p class="success"><?= $sucesso ?></p>
        <?php endif; ?>
    </form>
</main>


    <!-- Footer -->
    <?php include('footer.php'); ?>

</body>
</html>