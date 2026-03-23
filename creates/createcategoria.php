<?php
require_once __DIR__ . "/../connection.php";

session_start();
$nome          = $_POST['nome'];
$descricao        = $_POST['descricao'];

$stmt = $conexao->prepare("
    INSERT INTO categoria 
    (nome, descricao) 
    VALUES (?, ?)
");

$stmt->bind_param(
    "ss",
    $nome,
    $descricao,

);



if ($stmt->execute()) {
    
    header('Location: ../dashadm.php');
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
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>