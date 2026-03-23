<?php 
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
session_start();

if(!isset ($_GET['trackid'])){
    header('Location: homepage.php');

}

$idaluno = $_SESSION['id'];
$idcurso = $_GET['trackid'];
$status = "ativo";



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
    header("Location: ../infos.php?trackid=$idcurso");
}
$stmt->close();
$conexao->close();















?>