<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
session_start();
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
$idaula = $_POST['idaula'];
$idcurso = $_POST['idcurso'];
$idprofessor = $_POST['professor'];
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
            var_dump($idcurso);
            header("Location: ../curso.php?id=$idcurso");
        }
        else{
            echo("<script>alert('Não foi possível salvar o vídeo');</script>");
        }
    }
    else{
         echo("<script>alert('Não foi possível salvar a média');</script>");
    }
    
    

}  
elseif($stmt->execute() and $alteração == 0){
        header("Location: ../curso.php?id=$idcurso");
}
else{
    echo("<script>alert('Não foi possível atualizar a aula Erro:". $stmt->error ." ');</script>");
}

 $stmt->close();
 $conexao->close();
?>