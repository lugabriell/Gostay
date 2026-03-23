<?php
if(!empty($_POST)){
    if(isset($_POST['aula']) ){
        $idaula = $_POST['aula'];
        header("Location: editaraula.php?id=$idaula");
        exit();
    }
    elseif(isset($_POST['aulaaluno']) ){
        $idaula = $_POST['aulaaluno'];
        header("Location: formalunoaula.php?idaula=$idaula");
        exit();
    }
    elseif(isset($_POST['video']) ){
        $caminho = $_POST['video'];
        header("Location: player.php?trackid=$caminho");
        exit();
    }
    elseif(isset($_POST['conteudo']) ){
        $caminho = str_replace("creates/", "", $_POST['conteudo']);
        


        if (file_exists($caminho)) {

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($caminho) . '"');
            header('Content-Length: ' . filesize($caminho));

            readfile($caminho);
            header("Location:aulasadm.php");
            exit;

        } else {
            header("Location:aulaadm.php?conteudo=naoencontrada");
        }
        
        
        exit();
    }
    
}
else{
    header('Location: loginadm.php');
    exit();
}

?>