<?php
require_once __DIR__ . "/../connection.php";

session_start();

$nome         = $_POST['nome'];
$email        = $_POST['email'];
$formacao     = $_POST['formacao'];
$bio          = $_POST['bio'];
$senha = $_POST['senha'];
$senhacripto = password_hash($senha,PASSWORD_ARGON2ID );
$autenticado  = $_POST['autenticado'];

$stmt = $conexao->prepare("
    INSERT INTO professor 
    (nome, email,senha, formacao, bio, autenticado) 
    VALUES (?, ?,?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssss",
    $nome,
    $email,
    $senhacripto,
    $formacao,
    $bio,
    $autenticado
);

if ($stmt->execute()) {
    header('Location: ../dashadm.php');
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>