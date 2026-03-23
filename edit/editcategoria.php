 
<?php
include_once('../connection.php');
var_dump($_POST);
    if(isset($_POST['submit'])){
        $nomeeditado = $_POST['nome'];
        $descricaoeditado = $_POST['descricao'];
        $idedit = $_POST['idedit'];
        $sqleditado = 'UPDATE categoria SET  nome = ?, descricao = ? WHERE id = ?;';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssi", $nomeeditado, $descricaoeditado, $idedit);
        $stmt->execute();
        header('Location: ../testando.php'); 
    }
?>



