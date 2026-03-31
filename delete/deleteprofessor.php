<?php
include_once('../connection.php');
    session_start();
    
    if($_SERVER['REQUEST_METHOD']!== 'POST'){
        exit("Método Inválido");
    }
    if (!isset($_POST['token']) ||
        !hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
        echo($_SESSION['tokenadm']);
    }
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        exit("ID inválido");
    }

    if(!empty($id))
    {
        



        $sqlSelect = "SELECT * FROM professor WHERE id = '$id'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM professor WHERE id = '$id'";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../profadm.php");
    


?>