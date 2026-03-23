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
$formacao      = $_POST['formacao'];
$senhacripto   = password_hash($senha, PASSWORD_ARGON2ID);
$bio = $_POST['bio'];
$arquivooriginal = $_FILES['arquivo'];
$autenticado = 'nao';
$arquivobd = salvarft($arquivooriginal, $conexao);


$stmt = $conexao->prepare("
    INSERT INTO professor 
    (nome, email, senha, formacao, bio,  ftperfil, autenticado) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "sssssss",
    $nome,
    $email,
    $senhacripto,
    $formacao,
    $bio,
    $arquivobd,
    $autenticado
    
);
$sqlautenticado = "SELECT * FROM alunos WHERE email = '$email'";
echo($arquivobd);
if($arquivobd !== false){


    if ($stmt->execute()) {
        $_SESSION['emailprof'] = $email;
        $_SESSION['nomeprof'] = $nome;
        $_SESSION['autenticadoprof'] = 'nao';
        header('Location: ../homeprof.php');
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
}
else{
    header('Location: formProf.php?arquivo=naofoipossivelconcluir');
}
$stmt->close();
$conexao->close();
?>