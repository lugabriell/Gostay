<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
session_start();
if(isset($_POST['submit'])){
    if (isset($_FILES['video']) and isset($_FILES['media'])) {
        $videooriginal = $_FILES['video'];
        $mediaoriginal = $_FILES['media'];
    } else {
    
    echo "<script>alert('Você não enviou os arquivos.');</script>";

    }
}
else{
    //header('Location: ../nonvalidated.php');
}
$idcurso = $_POST['curso'];
$idprofessor = $_POST['professor'];
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
    $sqlaula = "SELECT idaula FROM sua_tabela 
        WHERE idcurso = '$idcurso'
        AND idprofessor = '$idprofessor'
        AND nome = '$nome'
        AND duracao = '$duracao'
        AND caminhoconteudo = '$mediabd'
        AND caminhovideo = '$videobd'
        AND qtdalunos = '$qtdalunos'
        AND ordem = '$ordem'
        AND descricao = '$descricao'
        AND statusaula = '$statusa'";
    $resultaula = mysqli_query($conexao, $sqlaula);
    $dadosaula = mysqli_fetch_assoc($resultaula);
    $idaula = $dadosaula['idaula'];
    $nao = "nao";
    $sqlalunoaula = "SELECT idaluno FROM cursoaluno WHERE idcurso = '$idcurso'";
    $resultalunoaula = mysqli_query($conexao, $sqlalunoaula);
    while($dadosalunoaula = mysqli_fetch_assoc($resultalunoaula)){
        $stmt2 =  $conexao->prepare("INSERT INTO alunoaula (idaula, idcurso, statusal, progresso, datafim, datainicio, ultimaposicao) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param(
            "iisssss",
            $idaula,
            $idcurso,
            $statusa,
            $nao,
            $nao,
            $nao,
            $nao

        );
        $stmt2->execute();
    }

    header("Location: ../curso.php?id=$idcurso");

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
     echo "Erro: " . $stmt->error;
 }

 $stmt->close();
 $conexao->close();
?>