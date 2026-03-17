<?php 
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";

if(!isset ($_POST['idcurso'])){
    header('Location: dashadm.php');

}

$idaluno = $_POST['aluno'];
$idcurso = $_POST['idcurso'];
$status = $_POST['status'];



$stmt = $conexao->prepare("
    INSERT INTO cursoaluno
    (idaluno, idcurso, statusa) 
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "iis", 
    $idaluno,
    $idcurso,
    $status
);

if($stmt->execute()){
    header("Location: ../curso.php?id=$idcurso");
}
$stmt->close();
$conexao->close();















?>