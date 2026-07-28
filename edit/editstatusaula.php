 
<?php
include_once('../connection.php');
include_once('../functions/savemedia.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}else{
    if(isset($_POST['submit'])){
        if (    !empty($_FILES['media']['name'])) {
            $mediaoriginal = $_FILES['media'];
            $mediabd = salvarconteudo($mediaoriginal, $conexao);
            $alteração=1;
        } else {
            $alteração = 0;
        }
        $idaula = (int) $_POST['idaula'];
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
        $stmt->close();
        $conexao->close();
        exit;
    }
}

?>



