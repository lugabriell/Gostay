<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
require_once __DIR__ . "/../functions/sessions.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}


if(isset($_POST['submit'])){
    if (isset($_FILES['video']) && $_FILES['video']['error'] === 0 &&
        isset($_FILES['media']) && $_FILES['media']['error'] === 0){
        $videooriginal = $_FILES['video'];
        $mediaoriginal = $_FILES['media'];
    } else {
        header('Location: ../createaula.php?msg=erro_upload');
        exit;

    }
}
else{
    header('Location: ../nonvalidated.php');
    exit();
}
$idcurso = (int) $_POST['curso'];
$idprofessor = (int) $_POST['professor'];
$nome         = $_POST['nome'];
$duracao         = $_POST['duracao'];
$qtdalunos = $_POST['qtd-alunos'];
$ordem = $_POST['ordem'];

$descricao = $_POST['descricao'];
$statusa = $_POST['status'];

$videobd = salvarvideo($videooriginal, $conexao);
$mediabd = salvarconteudo($mediaoriginal, $conexao);


$stmt = $conexao->prepare("
    INSERT INTO aula
    (idcurso, idprofessor, nome, duracao, caminhoconteudo, caminhovideo, qtdalunos, ordem,  descricao,statusaula) 
    VALUES (?, ?, ?, ?, ?, ?,  ?, ?, ?,?)
");

$stmt->bind_param(
    "iissssisss",
    $idcurso,
    $idprofessor,
    $nome,
    $duracao,
    $mediabd,
    $videobd,
    $qtdalunos,
    $ordem,
    $descricao,
    $statusa
    
);


if ($stmt->execute()) {
   $sqlaula = $conexao->prepare("SELECT id FROM aula
    WHERE idcurso = ?
    AND idprofessor = ?
    AND nome = ?
    AND duracao = ?
    AND caminhoconteudo = ?
    AND caminhovideo = ?
    AND qtdalunos = ?
    AND ordem = ?
    AND descricao = ?
    AND statusaula = ?");

    $sqlaula->bind_param(
        "iissssisss",
        $idcurso,
        $idprofessor,
        $nome,
        $duracao,
        $mediabd,
        $videobd,
        $qtdalunos,
        $ordem,
        $descricao,
        $statusa
    );

    $sqlaula->execute();
    $resultaula = $sqlaula->get_result();
    $dadosaula = $resultaula->fetch_assoc();
    $idaula = $dadosaula['id'];
    $nao = "nao";
    $sqlalunoaula = "SELECT idaluno, statusa FROM cursoaluno WHERE idcurso = '$idcurso'";
    $resultalunoaula = mysqli_query($conexao, $sqlalunoaula);
    while($dadosalunoaula = mysqli_fetch_assoc($resultalunoaula)){
        if($dadosalunoaula['statusa'] == 'ativo'){
            $stmt2 =  $conexao->prepare("INSERT INTO alunoaula (idaula, statusal, progresso, datafim, datainicio, ultimaposicao) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param(
                "isssss",
                $idaula,
                $statusa,
                $nao,
                $nao,
                $nao,
                $nao
            );
            $stmt2->execute();
        }
    }

    header("Location: ../curso.php?id=$idcurso");
    $stmt->close();
    $conexao->close();
    exit();
//     // $result = mysqli_query($conexao, $sqlautenticado);
//     // $dados = mysqli_fetch_assoc($result);
    
//     // if(empty($dados['autenticado'])){
//     //     $_SESSION['idaluno'] = $dados['id'];
//     //     header('Location: ../autenticacao.php');
//     // }
//     // else{
//     //     header('Location: ../homepage.php');
        
//     // }
 } else {
    $stmt->close();
    $conexao->close();
    exit;
 }

 
?>