<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}
$nome          = $_POST['nome'];
$email         = $_POST['email'];
$formacao     = $_POST['formacao'];
$senha         = $_POST['senha'];
$bio          = $_POST['bio'];
$autenticado = $_POST['autenticado'];
$idprofessor =(int) $_POST['idprofessor']; 
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

if(!$stmt->execute()){
    $stmt->close();
    $conexao->close();
    exit;
}
else{
    header("Location: ../professor.php?id=$idprofessor");
    $stmt->close();
    $conexao->close();
    exit();
}

?>