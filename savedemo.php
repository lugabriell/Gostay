<?php
include_once("connection.php");
session_start();
$nome = $_POST['nome'];
$telefone = $_POST['whatsapp'];
$formacao = $_POST['formacao'];
$email = $_POST['email'];

$stmt = $conexao->prepare("INSERT INTO demo (nome, telefone, formacao, email) VALUES (?,?, ?, ?)");

$stmt->bind_param("ssss", $nome, $telefone, $formacao, $email);

$stmt->execute();
if($stmt->affected_rows > 0){
    session_regenerate_id(true);
    $_SESSION['autorizado'] = 'sim';
    header('Location: demoplayer.php');
} else {
    header('Location: demo.php?error=nao_foi_possivel_salvar');
}
?>