<?php 
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
require_once __DIR__ . "/../functions/sessions.php";



if(!isset ($_POST['trackid']) || !isset($_POST['token']) || !isset($_SESSION['id']) || !isset($_SESSION['tokenuser'])){
    header('Location: homepage.php');
     exit;
}
if (!hash_equals($_SESSION['tokenuser'], $_POST['token'])) {
    header('Location: homepage.php');
    exit;
}
$idaluno = (int) $_SESSION['id'];

if($idaluno <= 0){
    header("Location: homepage.php");
    exit;
}
$idcurso = (int)$_POST['trackid'];
$status = "ativo";

$check = $conexao->prepare("SELECT id FROM cursoaluno WHERE idaluno = ? AND idcurso = ?");
$check->bind_param("ii", $idaluno, $idcurso);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    header("Location: ../infos.php?trackid=$idcurso");
    exit;
}
$check->close();

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
    $stmt->close();
    $conexao->close();
     exit;
}
$stmt->close();
$conexao->close();
header("Location: ../infos.php?trackid=$idcurso&erro=1");
exit;















?>