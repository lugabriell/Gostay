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
$nao = "nao";
if($stmt->execute()){
    $sqlaula = "SELECT * FROM aula WHERE idcurso = '$idcurso'";
    $resultaula = mysqli_query($conexao, $sqlaula);
    while($dadosaula = mysqli_fetch_assoc($resultaula)){
        $stmt2 = $conexao->prepare("
        INSERT INTO alunoaula (idaluno, idaula, statusal,progresso, ultimaposicao, datainicio,datafim) VALUES (?,?,?,?,?,?,?)");
        $stmt2->bind_param(
            "iisssss",
            $idaluno,
            $dadosaula['id'],
            $status,
            $nao,
            $nao,
            $nao,
            $nao
        );
        if($stmt2->execute()){
            header("Location: ../curso.php?id=$idcurso");
        }
        else{
            header("Location: ../curso.php?id=$idcurso?user=naoencontrado");
        }
    }
}
$stmt->close();
$conexao->close();















?>