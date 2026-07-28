<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../functions/sessions.php";

if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}

$idcurso = (int) $_POST['idcurso'];
$nome          = $_POST['nome'];
$ordem        = $_POST['ordem'];

$stmt = $conexao->prepare("
    INSERT INTO modulo 
    (nome, ordem, idcurso) 
    VALUES (?, ?,?)
");

$stmt->bind_param(
    "sis",
    $nome,
    $ordem,
    $idcurso,

);



if ($stmt->execute()) {
    
    header("Location: ../curso.php?id=$idcurso");
    $stmt->close();
    $conexao->close();
    exit;
    // $result = mysqli_query($conexao, $sqlautenticado);
    // $dados = mysqli_fetch_assoc($result);
    
    // if(empty($dados['autenticado'])){
    //     $_SESSION['idaluno'] = $dados['id'];
    //     header('Location: ../autenticacao.php');
    // }
    // else{
    //     header('Location: ../homepage.php');
        
    // }
} else {
    $stmt->close();
    $conexao->close();
    exit;
}

$stmt->close();
$conexao->close();
?>