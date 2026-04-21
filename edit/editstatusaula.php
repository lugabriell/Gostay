 
<?php
include_once('../connection.php');
include_once('../functions/savemedia.php');
session_start();
 $token = $_POST['token'];
if($token === $_SESSION['tokenprof']){
    if(isset($_POST['submit'])){
        if (    !empty($_FILES['media']['name'])) {
            $mediaoriginal = $_FILES['media'];
            $mediabd = salvarconteudo($mediaoriginal, $conexao);
            $alteração=1;
        } else {
            $alteração = 0;
        }
        $idaula = $_POST['idaula'];
        $nome = $_POST['nome'];
        $status = $_POST['status'];
        echo($alteração);
        if($alteração === 0 ){
            $sqleditado = 'UPDATE aula SET  statusaula = ?, nome = ? WHERE id = ?';
            $stmt = $conexao->prepare($sqleditado);
            $stmt->bind_param("ssi", $status, $nome, $idaula);
            $stmt->execute();
        }else{
            $sqleditado = 'UPDATE aula SET  statusaula = ?, nome = ?, caminhoconteudo = ? WHERE id = ?';
            $stmt = $conexao->prepare($sqleditado);
            $stmt->bind_param("sssi", $status, $nome,$mediabd, $idaula);
            $stmt->execute();
        }
        header("Location: ../aulasprof.php"); 
    }
}
else{
    echo "<script>alert('Não foi possível concluir essa operação, não autenticado');</script>";
}
?>



