<?php
if(!empty($_POST)){
    if(isset($_POST['aluno']) ){
        $idaluno = $_POST['aluno'];
        header("Location: editaraluno.php?idaluno=$idaluno");
        exit();
    }
    elseif(isset($_POST['curso']) ){
        $idaluno = $_POST['curso'];
        header("Location: formalunocurso.php?idaluno=$idaluno");
        exit();
    }
    elseif(isset($_POST['aula'])){
        $idaluno = $_POST['aula'];
        header("Location: formalunoaula.php?idaluno=$idaluno");
    }
    else{
        header("Location: loginadm.php");
        exit();
    }
}
else{
    header('Location: loginadm.php');
    exit();
}

?>