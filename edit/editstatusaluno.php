 
<?php
include_once('../connection.php');
session_start();
 $token = $_POST['token'];
if($token === $_SESSION['tokenprof']){
    if(isset($_POST['submit'])){
        $idaluno = $_POST['idaluno'];
        $statusa = $_POST['status'];
        $idcurso = $_POST['idcurso'];
        $sqleditado = 'UPDATE cursoaluno SET  statusa = ? WHERE idcurso = ? AND idaluno= ?;';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("sii", $statusa, $idcurso, $idaluno);
        $stmt->execute();
        header("Location: ../homeprof.php"); 
    }
}
else{
    echo "<script>alert('Não foi possível concluir essa operação, não autenticado');</script>";
}
?>



