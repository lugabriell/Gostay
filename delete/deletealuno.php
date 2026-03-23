<?php
include_once('../connection.php');
    session_start();
    $id = $_GET['id'];
    
    if(isset($id))
    {
        



        $sqlSelect = "SELECT * FROM alunos WHERE id = '$id'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM alunos WHERE id = '$id'";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header("Location: ../alunosadm.php");
    


?>