<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
session_start();

// if (isset($_FILES['arquivo'])) {
//     $arquivooriginal = $_FILES['arquivo'];
// } else {
//     echo "Arquivo não enviado";
// }


$nome          = $_POST['nome'];
$email         = $_POST['email'];
$senha         = $_POST['senha'];
$regiao      = $_POST['regiao'];
$autenticado = 'nao';
$senhacripto   = password_hash($senha, PASSWORD_ARGON2ID);


$stmt = $conexao->prepare("
    INSERT INTO adms
    (nome, email, senha, regiao, autenticado ) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "sssss",
    $nome,
    $email,
    $senhacripto,
    $regiao,
    $autenticado
    
);



if ($stmt->execute()) {
    $_SESSION['emailadm'] = $email;
    $_SESSION['nomeadm'] = $nome;
    header('Location: dashadm.php');
    // header('Location: ../homepage.php');
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