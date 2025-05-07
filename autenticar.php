<?php
session_start();
require_once("conexao.php");

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // E-mail não encontrado
    header("Location: login.php?erro=email_nao_encontrado");
    exit();
}

if (password_verify($senha, $user['senha'])) {
    $_SESSION['usuario'] = $user['email'];
    header("Location: portal.php");
    exit();
} else {
    // Senha incorreta
    header("Location: login.php?erro=senha_incorreta");
    exit();
}
?>
