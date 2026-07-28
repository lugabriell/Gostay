 
<?php
include_once('../connection.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}
    if(isset($_POST['submit'])){
        $nomeeditado = $_POST['nome'];
        $descricaoeditado = $_POST['ordem'];
        $idmodulo = $_POST['idmodulo'];
        $idcurso =(int) $_POST['idcurso'];
        $sqleditado = 'UPDATE modulo SET  nome = ?, ordem = ? WHERE id = ? and idcurso = ?';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssii", $nomeeditado, $descricaoeditado, $idmodulo, $idcurso);
        $stmt->execute();
        header("Location: ../curso.php?id=$idcurso");
        exit; 
    }
?>



