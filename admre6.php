<?php
if(!empty($_POST)){
    if(isset($_POST['aula'])){
        header('Location: formaula.php');
        exit();
    }
    elseif(isset($_POST['curso'])  ){
        header('Location: formcurso.php');
        exit();
    }
    elseif(isset($_POST['professor'])){
        $idprofessor = $_POST['professor'];
        header("Location: editarprofessor.php?id=$idprofessor");
    }
    else{
        header('Location: loginadm.php');
        exit();
    }
}
else{
    header('Location: loginadm.php');
    exit();
}

?>