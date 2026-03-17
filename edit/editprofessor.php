<?php
require_once __DIR__ . "/../connection.php";

session_start();
$nome          = $_POST['nome'];
$email         = $_POST['email'];
$formacao     = $_POST['formacao'];
$senha         = $_POST['senha'];
$bio          = $_POST['bio'];
$autenticado = $_POST['autenticado'];
$idprofessor = $_POST['idprofessor']; 
$senhacripto = password_hash($senha, PASSWORD_ARGON2ID);
$stmt = $conexao->prepare("
    UPDATE professor SET
        nome = ?,
        email = ?,
        formacao = ?,
        bio = ?,
        autenticado = ?,
        senha = ?
        
    WHERE id = ?
");

$stmt->bind_param(
    "ssssssi",
    $nome,
    $email,
    $formacao,
    $bio,
    $autenticado,
    $senhacripto,

    $idprofessor
);

$stmt->execute();
header("Location: ../professor.php?id=$idprofessor");
exit();


?>