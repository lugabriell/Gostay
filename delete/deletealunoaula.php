<?php
include_once('../connection.php');
    session_start();
    $idaluno = $_GET['idaluno'];
    $idaula = $_GET['idaula'];
    if(!empty($_GET['idaluno']) and !empty($_GET['idaula']))
    {
        



        $sqlSelect = "SELECT * FROM alunoaula WHERE idaluno = '$idaluno' AND idaula ='$idaula'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM alunoaula WHERE idaluno = '$idaluno' AND idaula ='$idaula'";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../aluno?id=$idaluno");
    


?>