 
<?php
include_once('../connection.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}

if(isset($_POST['submit'])){
    $idaluno = (int) $_POST['idaluno'];
    $idaula = (int) $_POST['idaula'];
    $statusa = $_POST['status'];
    $sqleditado = 'UPDATE alunoaula SET  statusal = ? WHERE idaula = ? AND idaluno= ?;';
    
    $stmt = $conexao->prepare($sqleditado);
    $stmt->bind_param("ssi", $statusa, $idaula, $idaluno);
    
    if(!$stmt->execute()){
        $stmt->close();
        $conexao->close();
        exit("DEU ERRADO");
    }
    header("Location: ../aluno.php?id=$idaluno"); 
    $stmt->close();
    $conexao->close();
    exit;
}
?>



