<?php
include_once('../connection.php');
    session_start();
    if($_SERVER['REQUEST_METHOD']!== 'POST'){
        exit("Método Inválido");
    }
    if (!isset($_POST['token']) ||
        !hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
        echo($_SESSION['tokenadm']);
    }
    $idaluno = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $idaula =filter_input(INPUT_POST, 'idcurso', FILTER_VALIDATE_INT);
    if (!$id || !$idaula) {
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
            echo('bom bom');
        }
    }
    header("Location: ../aluno?id=$idaluno");
    


?>