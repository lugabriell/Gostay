<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
session_start();

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {
    $arquivooriginal = $_FILES['arquivo'];
    $arquivobd = salvarft($arquivooriginal, $conexao);
} else {
    $arquivobd = null; // ou define uma imagem padrão
}


$nome        = $_POST['nome'] ?? null;
$email       = $_POST['email'] ?? null;
$senha       = $_POST['senha'] ?? null;
$telefone    = $_POST['telefone'] ?? null;
$datanas     = $_POST['datanas'] ?? null;
$formacao    = $_POST['formacao'] ?? null;

if (!$nome || !$email || !$senha) {
    header("Location: ../login.php?msg=dados_invalidos");
    exit;
}

$senhacripto = password_hash($senha, PASSWORD_ARGON2ID);
$autenticado = 'nao';

if (isset($_SESSION['nameadm']) && isset($_SESSION['emailadm'])) {

    $autenticado = $_POST['autenticado'] ?? 'nao';

    $stmt = $conexao->prepare("
        INSERT INTO alunos 
        (nome, email, senha, telefone, datanascimento, formacao, ftperfil, autenticado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
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

} else {

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
        $arquivobd
    );
}

if ($stmt->execute()) {

    $idaluno = $stmt->insert_id;

    if (!isset($_SESSION['nameadm']) && !isset($_SESSION['emailadm'])) {

        $_SESSION['emailaluno'] = $email;
        $_SESSION['nomealuno'] = $nome;
        $_SESSION['idaluno'] = $idaluno;
        $_SESSION['autenticado'] = 'nao';

        header('Location: ../homepage.php');
        exit;

    } else {

        header('Location: ../alunosadm.php');
        exit;
    }
// $result = mysqli_query($conexao, $sqlautenticado); // $dados = mysqli_fetch_assoc($result); // if(empty($dados['autenticado'])){ // $_SESSION['idaluno'] = $dados['id']; // header('Location: ../autenticacao.php'); // } // else{ // header('Location: ../homepage.php'); // }
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>