<?php 
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";


$idaluno = $_POST['idaluno'];
$idaula = $_POST['aula'];
$status = $_POST['status'];



$stmt = $conexao->prepare("
    INSERT INTO alunoaula
    (idaluno, idaula, statusal) 
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "iis", 
    $idaluno,
    $idaula,
    $status
);

if($stmt->execute()){
    echo($idaluno);
    header("Location: ../aluno.php?id=$idaluno");
}
$stmt->close();
$conexao->close();















?>