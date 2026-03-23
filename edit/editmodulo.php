 
<?php
include_once('../connection.php');
var_dump($_POST);
    if(isset($_POST['submit'])){
        $nomeeditado = $_POST['nome'];
        $descricaoeditado = $_POST['ordem'];
        $idmodulo = $_POST['idmodulo'];
        $idcurso = $_POST['idcurso'];
        $sqleditado = 'UPDATE modulo SET  nome = ?, ordem = ? WHERE id = ? and idcurso = ?';
        
        $stmt = $conexao->prepare($sqleditado);
        $stmt->bind_param("ssii", $nomeeditado, $descricaoeditado, $idmodulo, $idcurso);
        $stmt->execute();
        header("Location: ../curso.php?id=$idcurso"); 
    }
?>



