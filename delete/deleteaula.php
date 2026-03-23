<?php
include_once('../connection.php');
    session_start();
    $idaula = $_GET['id'];
  
    if(!empty($_GET['id']))
    {
        



        $sqlSelect = "SELECT * FROM aula WHERE id = '$idaula' ";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM aula WHERE id = '$idaula' ";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../dashadm.php");
    


?>