<?php
if(!empty($_POST)){
    if(isset($_POST['aluno']) && $_POST['aluno'] =='aluno'){
        header('Location: formAluno.php');
        exit();
    }
    elseif(isset($_POST['curso']) && $_POST['curso'] =='curso' ){
        header('Location: formcurso.php');
        exit();
    }
    elseif(isset($_POST['cursos']) && $_POST['cursos'] =='cursos'){
        header('Location: dashadm.php');
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