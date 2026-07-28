<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
require_once __DIR__ . "/../functions/sessions.php";
require_once __DIR__ . "/../functions/headers.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}
if(isset($_POST['submit'])){
    if (    !empty($_FILES['video']['name']) && !empty($_FILES['media']['name'])) {
        $videooriginal = $_FILES['video'];
        $mediaoriginal = $_FILES['media'];
        $videobd = salvarvideo($videooriginal, $conexao);
        $mediabd = salvarconteudo($mediaoriginal, $conexao);
        $alteração=1;
    } else {
        $alteração = 0;
    }
}
else{
    header('Location: ../nonvalidated.php');
}
$idaula = (int) $_POST['idaula'];
$idcurso = (int) $_POST['idcurso'];
$idprofessor = (int) $_POST['professor'];
$nome         = $_POST['nome'];
$duracao         = $_POST['duracao'];
$qtdalunos = $_POST['qtd-alunos'];
$ordem = $_POST['ordem'];
$idmodulo = $_POST['modulo'];
$descricao = $_POST['descricao'];
$statusa = $_POST['status'];

$sqlselect = "SELECT * From aula where id = '$idaula'";
$result = mysqli_query($conexao, $sqlselect);
$dadosresult =mysqli_fetch_assoc($result);
$numrows  = mysqli_num_rows($result);
if($numrows > 0){
    if($alteração == 1){
        $urlvideo = $dadosresult['caminhovideo'];
        $urlmedia = $dadosresult['caminhoconteudo'];
        $stmtvideo = $conexao->prepare("
        INSERT INTO media
        (idaula, caminho) 
        VALUES (?, ?)
        ");
        
        $stmtvideo->bind_param(
            "is",
            $idaula,
            $urlvideo,

        );
        $stmtmedia = $conexao->prepare("
        INSERT INTO media
        (idaula, caminho) 
        VALUES (?, ?)
        ");
        
        $stmtmedia->bind_param(
            "is",
            $idaula,
            $urlmedia,

        );
        $stmt = $conexao->prepare("
        Update aula
        SET 
        idcurso = ?,
        idprofessor = ?,
        nome = ?,
        duracao = ?,
        caminhoconteudo = ?,
        caminhovideo = ?,
        qtdalunos = ?,
        ordem = ?,
        idmodulo = ?,
        descricao = ?,
        statusaula = ?
        WHERE id = ?
        ");

        $stmt->bind_param(
            "iissssisissi",
            $idcurso,
            $idprofessor,
            $nome,
            $duracao,
            $mediabd,
            $videobd,
            $qtdalunos,
            $ordem,
            $idmodulo,
            $descricao,
            $statusa,
            $idaula
            
        );

    }
    else{
        $stmt = $conexao->prepare("
        Update aula
        SET 
        idcurso = ?,
        idprofessor = ?,
        nome = ?,
        duracao = ?,

        qtdalunos = ?,
        ordem = ?,
        idmodulo = ?,
        descricao = ?,
        statusaula = ?
        WHERE id = ?
        ");

        $stmt->bind_param(
            "iissisissi",
            $idcurso,
            $idprofessor,
            $nome,
            $duracao,
            $qtdalunos,
            $ordem,
            $idmodulo,
            $descricao,
            $statusa,
            $idaula
            
        );

    }



}


if ($stmt->execute() and $alteração == 1) {
    if($stmtmedia->execute()){
        if($stmtvideo->execute()){
            header("Location: ../curso.php?id=$idcurso");
            exit;
        }
        else{
            exit;
        }
    }
    else{
         exit;
    }
    
    

}  
elseif($stmt->execute() and $alteração == 0){
        header("Location: ../curso.php?id=$idcurso");
        exit;
}
else{
    exit;
}

 $stmt->close();
 $conexao->close();
?>