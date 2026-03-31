<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
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