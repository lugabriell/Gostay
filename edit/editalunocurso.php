 
<?php
include_once('../connection.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}

if(isset($_POST['submit'])){
        $idaluno = (int)$_POST['idaluno'];
        $statusa = $_POST['status'];
        $idcurso = (int)$_POST['idcurso'];
        $sqleditado = 'UPDATE cursoaluno SET  statusa = ? WHERE idcurso = ? AND idaluno= ?;';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssi", $statusa, $idcurso, $idaluno);
    
        if(!$stmt->execute()){
            $stmt->close();
            $conexao->close();
            exit("DEU ERRADO");
        }

        header("Location: ../curso.php?id=$idcurso"); 
        $stmt->close();
        $conexao->close();
        exit;
    }
?>



