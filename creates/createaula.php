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