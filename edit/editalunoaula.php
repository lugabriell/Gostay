 
<?php
include_once('../connection.php');
var_dump($_POST);
    if(isset($_POST['submit'])){
        $idaluno = $_POST['idaluno'];
        $idaula = $_POST['idaula'];
        $statusa = $_POST['status'];
        $sqleditado = 'UPDATE alunoaula SET  statusal = ? WHERE idaula = ? AND idaluno= ?;';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssi", $statusa, $idaula, $idaluno);
        $stmt->execute();
        header("Location: ../aluno.php?id=$idaluno"); 
    }
?>



