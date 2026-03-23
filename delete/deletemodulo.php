<?php
include_once('../connection.php');
    session_start();
    $idmodulo = $_GET['id'];
  
    if(!empty($_GET['id']))
    {
        



        $sqlSelect = "SELECT * FROM modulo WHERE id = '$idmodulo' ";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM modulo WHERE id = '$idmodulo' ";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../dashadm.php");
    


?>