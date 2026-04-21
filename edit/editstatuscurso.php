 
<?php
include_once('../connection.php');
session_start();
 $token = $_POST['token'];
if($token === $_SESSION['tokenprof']){
    if(isset($_POST['submit'])){
        $statusa = $_POST['status'];
        $idcurso = $_POST['idcurso'];
        $sqleditado = 'UPDATE curso SET  statuscurso = ? WHERE id = ? ';
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("si", $statusa, $idcurso,);
        $stmt->execute();
        header("Location: ../cursosprof.php"); 
    }
}
else{
    echo "<script>alert('Não foi possível concluir essa operação, não autenticado');</script>";
}
?>



