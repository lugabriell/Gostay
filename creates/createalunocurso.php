<?php 
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
require_once __DIR__ . "/../functions/sessions.php";

if(!isset ($_POST['idcurso']) || !isset($_SESSION['tokenadm']) || !isset($_POST['aluno']) || !isset($_POST['token'])){
    header('Location: dashadm.php');
    exit();

}
if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}

$idaluno = (int)$_POST['aluno'];
$idcurso = (int)$_POST['idcurso'];
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
$sucesso = true;
$nao = "nao";
if($stmt->execute()){
    $sqlaula = "SELECT * FROM aula WHERE idcurso = '$idcurso'";
    $resultaula = mysqli_query($conexao, $sqlaula);
    while($dadosaula = mysqli_fetch_assoc($resultaula)){
        $idaula =(int) $dadosaula['id'];
        $stmt2 = $conexao->prepare("
        INSERT INTO alunoaula (idaluno, idaula, statusal,progresso, ultimaposicao, datainicio,datafim) VALUES (?,?,?,?,?,?,?)");
        $stmt2->bind_param(
            "iisssss",
            $idaluno,
            $idaula,
            $status,
            $nao,
            $nao,
            $nao,
            $nao
        );
        if(!$stmt2->execute()){
            $sucesso = false;
        }
        $stmt2->close();
    }
}
$stmt->close();
if($sucesso){
    header("Location:../curso.php?id=$idcurso");
    $stmt->close();
    $conexao->close();
    exit();
}
else{
    header("Location:../curso.php?id=$idcurso&user=naoencontrado");
    $stmt->close();
    $conexao->close();
    exit;
}
$stmt->close();
$conexao->close();















?>