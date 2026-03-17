<?php
include_once('../connection.php');
    session_start();
    $idcategoria = $_GET['id'];
  
    if(!empty($_GET['id']))
    {
        



        $sqlSelect = "SELECT * FROM categoria WHERE id = '$idcategoria' ";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM categoria WHERE id = '$idcategoria' ";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../videosadm.php");
    


?>