 
<?php
include_once('../connection.php');
var_dump($_POST);
    if(isset($_POST['submit'])){
        $idaluno = $_POST['idaluno'];
        $statusa = $_POST['status'];
        $idcurso = $_POST['idcurso'];
        $sqleditado = 'UPDATE cursoaluno SET  statusa = ? WHERE idcurso = ? AND idaluno= ?;';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssi", $statusa, $idcurso, $idaluno);
        $stmt->execute();
        header("Location: ../curso.php?id=$idcurso"); 
    }
?>



