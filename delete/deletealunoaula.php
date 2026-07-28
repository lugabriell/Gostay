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
    $idaula =filter_input(INPUT_POST, 'idcurso', FILTER_VALIDATE_INT);
    if (!$idaluno || !$idaula) {
        exit("ID inválido");
    }

    if(!empty($idaluno) and !empty($idaula))
    {
        



        $sqlSelect = "SELECT * FROM alunoaula WHERE idaluno = '$idaluno' AND idaula ='$idaula'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            $sqlDelete= "DELETE FROM alunoaula WHERE idaluno = '$idaluno' AND idaula ='$idaula'";
            $resultDelete = $conexao->query($sqlDelete);
            
        }
    }
    header("Location: ../aluno?id=$idaluno");
    exit;
    


?>