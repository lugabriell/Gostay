<?php
include_once('../connection.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}
    
    if($_SERVER['REQUEST_METHOD']!== 'POST'){
        exit("Método Inválido");
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        exit("ID inválido");
    }
    

    if(!empty($id))
    {
        



        $sqlSelect = "SELECT * FROM aula WHERE id = '$id' ";
        $result = $conexao->query($sqlSelect);
        
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM aula WHERE id = '$id' ";
            $resultDelete = $conexao->query($sqlDelete);
            
        }
    }
    
    header("Location: ../dashadm.php");
    exit;
    


?>