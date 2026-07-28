 
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
        $descricaoeditado = $_POST['descricao'];
        $idedit = (int) $_POST['idedit'];
        $sqleditado = 'UPDATE categoria SET  nome = ?, descricao = ? WHERE id = ?;';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssi", $nomeeditado, $descricaoeditado, $idedit);
        $stmt->execute();
        header('Location: ../testando.php'); 
        $stmt->close();
        $conexao->close();
        exit;
    }
?>



