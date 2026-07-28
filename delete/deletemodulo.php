<?php
include_once('../connection.php');
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}
    $idmodulo = (int) $_GET['id'];
  
    if(!empty($id))
    {
        



        $sqlSelect = "SELECT * FROM modulo WHERE id = '$idmodulo' ";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM modulo WHERE id = '$idmodulo' ";
            $resultDelete = $conexao->query($sqlDelete);
           
        }
    }
    header("Location: ../dashadm.php");
    exit;
    


?>