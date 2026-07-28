 
<?php
include_once('../connection.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}else{
    if(isset($_POST['submit'])){
        $statusa = $_POST['status'];
        $idcurso = (int) $_POST['idcurso'];
        $sqleditado = 'UPDATE curso SET  statuscurso = ? WHERE id = ? ';
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("si", $statusa, $idcurso,);
        if(!$stmt->execute()){
            $stmt->close();
            $conexao->close();
            exit;
        }
        header("Location: ../cursosprof.php"); 
        $stmt->close();
        $conexao->close();
        exit;
    }
}

?>



