<?php
include_once('../connection.php');
    session_start();
    $idmedia = $_GET['id'];
  
    if(!empty($_GET['id']))
    {
        



        $sqlSelect = "SELECT * FROM media WHERE id = '$idmedia' ";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM media WHERE id = '$idmedia' ";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../videosadm.php");
    


?>