<?php
include_once('../connection.php');
    session_start();
    $idaluno = $_GET['idaluno'];
    $idcurso = $_GET['idcurso'];
    if(!empty($_GET['idaluno']) and !empty($_GET['idcurso']))
    {
        



        $sqlSelect = "SELECT * FROM cursoaluno WHERE idaluno = '$idaluno' AND idcurso ='$idcurso'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM cursoaluno WHERE idaluno = '$idaluno' AND idcurso ='$idcurso'";
            $resultDelete = $conexao->query($sqlDelete);
            echo('bom bom');
        }
    }
    header("Location: ../curso?idcurso=$idcurso");
    


?>