<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
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