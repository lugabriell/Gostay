<?php
if(!empty($_POST)){
    if(isset($_POST['aula'])){
        header('Location: formaula.php');
        exit();
    }

}
else{
    header('Location: loginadm.php');
    exit();
}

?>