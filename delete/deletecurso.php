<?php
include_once('../connection.php');
    session_start();
    $id = $_GET['id'];
    if(!empty($_GET['id']))
    {
        



        $sqlSelect = "SELECT * FROM curso WHERE id = '$id'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM curso WHERE id = '$id'";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../dashadm.php");
    


?>