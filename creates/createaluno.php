<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
session_start();

if (isset($_FILES['arquivo'])) {
    $arquivooriginal = $_FILES['arquivo'];
} else {
    echo "Arquivo não enviado";
}


$nome          = $_POST['nome'];
$email         = $_POST['email'];

$senha         = $_POST['senha'];

$telefone      = $_POST['telefone'];
$senhacripto   = password_hash($senha, PASSWORD_ARGON2ID);
$datanas = $_POST['datanas'];
$formacao = $_POST['formacao'];
$arquivooriginal = $_FILES['arquivo'];
$autenticado = 'nao';
$arquivobd = salvarft($arquivooriginal, $conexao);

if(isset($_SESSION['nameadm']) && isset($_SESSION['emailadm'])){
    $autenticado = $_POST['autenticado'];
    
    $stmt = $conexao->prepare("
        INSERT INTO alunos 
        (nome, email, senha, telefone, datanascimento, formacao, ftperfil, autenticado) 
        VALUES (?, ?, ?, ?, ?, ?, ?,?)
    ");

    $stmt->bind_param(
        "ssssssss",
        $nome,
        $email,
        $senhacripto,
        $telefone,
        $datanas,
        $formacao,
        $arquivobd,
        $autenticado
        
    );
}else{
        $stmt = $conexao->prepare("
        INSERT INTO alunos 
        (nome, email, senha, telefone, datanascimento, formacao, ftperfil) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssss",
        $nome,
        $email,
        $senhacripto,
        $telefone,
        $datanas,
        $formacao,
        $arquivobd,
       
        
    );
}

$sqlautenticado = "SELECT * FROM alunos WHERE email = '$email' AND nome = '$nome'";
$resultaluno = mysqli_query($conexao, $sqlautenticado);
$dadosaluno = mysqli_fetch_assoc($resultaluno);


if ($stmt->execute()) {
    if(!isset($_SESSION['nameadm']) && !isset($_SESSION['emailadm'])){
        $_SESSION['emailaluno'] = $email;
        $_SESSION['nomealuno'] = $nome;
        $_SESSION['idaluno'] = $dadosaluno['id'];
        $_SESSION['autenticado'] = 'nao';
        header('Location: ../homepage.php');
    }
    else{
        header('Location: ../alunosadm.php');
    }
   
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