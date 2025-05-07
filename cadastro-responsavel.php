<?php
// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco
    require_once('conexao.php');

    // Coleta e sanitiza os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];

    // Verifica se o e-mail ou CPF já está cadastrado
    $sql_verifica = "SELECT id FROM usuarios WHERE email = :email OR cpf = :cpf";
    $stmt_verifica = $pdo->prepare($sql_verifica);
    $stmt_verifica->bindParam(':email', $email);
    $stmt_verifica->bindParam(':cpf', $cpf);
    $stmt_verifica->execute();

    if ($stmt_verifica->rowCount() > 0) {
        $erro = "Já existe um usuário com este e-mail ou CPF.";
    } else {
        // Insere os dados
        $sql = "INSERT INTO usuarios (nome, sobrenome, cpf, email, senha, telefone, endereco, bairro, cep)
                VALUES (:nome, :sobrenome, :cpf, :email, :senha, :telefone, :endereco, :bairro, :cep)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cep', $cep);

    if ($stmt->execute()) {
        echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href = 'cadastro-crianca.php';
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
    <title>Cadastro do Responsável</title>
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
        <h1>CADASTRE-SE</h1>
        <h2>Dados do responsável</h2>
    </div>

    <form class="registration-form" method="POST" action="cadastro-responsavel.php">
        <div class="form-grid">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Nome" required>
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome completo</label>
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome completo" required>
            </div>

            <div class="form-group full-width">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
            </div>

            <div class="form-group full-width">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="seuemail@exemplo.com" required>
            </div>

            <div class="form-group full-width">
                <label for="senha">Senha</label>
                <div class="password-input">
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
                    <i class="toggle-password fas fa-eye"></i>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
            </div>

            <div class="form-group full-width">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" placeholder="Ex: Rua 1 Casa 1" required>
            </div>

            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" required>
            </div>

            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" placeholder="00000-000" required>
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="submit-btn">Seguir</button>
        </div>

        <?php if (isset($erro)): ?>
            <p class="error"><?= $erro ?></p>
        <?php endif; ?>
    </form>
</main>


    <!-- Footer -->
    <?php include('footer.php'); ?>


    <script src="js/login.js"></script>
</body>
</html>
