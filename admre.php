<?php
if(!empty($_POST)){
    if(isset($_POST['curso']) && $_POST['curso'] =='curso' && !isset($_POST['categorias'])){
        header('Location: formcurso.php');
        exit();
    }
    elseif(isset($_POST['categoria']) && $_POST['categoria'] =='categoria' && !isset($_POST['curso'])){
        header('Location: formcategoria.php');
        exit();
    }
    elseif(isset($_POST['categorias']) && $_POST['categorias'] =='categorias' && !isset($_POST['curso'])){
        header('Location: testando.php');
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