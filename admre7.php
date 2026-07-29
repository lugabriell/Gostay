<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once __DIR__ . "/functions/validationadm.php";
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