<?php 
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
require_once __DIR__ . "/../functions/sessions.php";


if(!isset ($_POST['idaluno']) || !isset($_POST['aula']) || !isset($_SESSION['tokenadm']) || !isset($_POST['token'])){
    header('Location: dashadm.php');
    exit();

}

$idaluno =(int) $_POST['idaluno'];
$idaula =(int) $_POST['aula'];
$status = $_POST['status'];

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}


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
    header("Location: ../aluno.php?id=$idaluno");
    $stmt->close();
    $conexao->close();
    exit();
}
$stmt->close();
$conexao->close();















?>