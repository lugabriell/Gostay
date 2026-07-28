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

    $idaluno = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $idcurso =filter_input(INPUT_POST, 'idcurso', FILTER_VALIDATE_INT);
    
    if (!$idaluno || !$idcurso) {
        exit("ID inválido");
    }

    if(!empty($idaluno) || !empty($idcurso))
    {
        



        $sqlSelect = "SELECT * FROM cursoaluno WHERE idaluno = '$idaluno' AND idcurso ='$idcurso'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM cursoaluno WHERE idaluno = '$idaluno' AND idcurso ='$idcurso'";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header("Location: ../curso.php?id=$idcurso");
    exit;
    


?>