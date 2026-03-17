<?php
if(!empty($_POST)){
    if(isset($_POST['professor']) ){
        header("Location: formprofessor.php");
        exit();
    }

}
else{
    header('Location: dashadm.php');
    exit();
}

?>