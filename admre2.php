<?php
if(!empty($_POST)){
    if(isset($_POST['modulo'])){
        $idcurso = $_POST['modulo'];
        header("Location: formmodulo.php?idcurso=$idcurso");
        exit();
    }
    elseif(isset($_POST['alunos']) ){
        $idcurso = $_POST['alunos'];
        header("Location: formalunocurso.php?idcurso=$idcurso");
        exit();
    }
    elseif(isset($_POST['aula']) ){
        $idcurso = $_POST['aula'];
        header("Location: formaula.php?idcurso=$idcurso");
        exit();
    }
    elseif(isset($_POST['curso']) ){
        $idcurso = $_POST['curso'];
        header("Location: editarcurso.php?id=$idcurso");
        exit();
    }

    else{
        header('Location: dashadm.php');
        exit();
    }
}
else{
    header('Location: dashadm.php');
    exit();
}

?>