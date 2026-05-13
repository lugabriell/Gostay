<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../codehex.php";
require_once __DIR__ . "/../functions/savemedia.php";
session_start();
if(isset($_POST)){
    if (  !empty($_FILES['arquivo']['name']) ) {
        $arquivooriginal = $_FILES['arquivo'];
        $videobd = salvarft($arquivooriginal, $conexao);
        $alteração=1;
        
    } else {
        
        $alteração = 0;
    }
    
}

// else{
//     header('Location: ../nonvalidated.php');
// }
$idaluno = $_POST['id'];
$nome         = $_POST['nome'];
$formacao         = $_POST['formacao'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$datanascimento = $_POST['datanas'];
$senhacripto = password_hash($senha, PASSWORD_ARGON2ID);

$sqlselect = "SELECT * From alunos where id = '$idaluno'";
$result = mysqli_query($conexao, $sqlselect);
$dadosresult =mysqli_fetch_assoc($result);
$numrows  = mysqli_num_rows($result);
if(isset($_SESSION['nameadm'])){
    $autenticado= $_POST['autenticado'];
    if($alteração == 1){
        $stmt = $conexao->prepare("
        Update alunos
        SET
        nome = ?,
        formacao = ?,
        email = ?,
        telefone = ?,
        senha = ?,
        datanascimento = ?,
        autenticado = ?,
        ftperfil = ?
        WHERE id = ?
        ");

        $stmt->bind_param(
            "ssssssssi",
            $nome,
            $formacao,
            $email,
            $telefone,
            $senhacripto,
            $datanascimento,
            $autenticado,
            $videobd,
            $idaluno
            
        );

    }
    else{
        $stmt = $conexao->prepare("
        Update alunos
        SET
        nome = ?,
        formacao = ?,
        email = ?,
        telefone = ?,
        senha = ?,
        datanascimento = ?,
        autenticado = ?
        WHERE id = ?
        ");


        $stmt->bind_param(
            "sssssssi",
            $nome,
            $formacao,
            $email,
            $telefone,
            $senhacripto,
            $datanascimento,
            $autenticado,
            $idaluno
            
        );

    }



}
else{
        $stmt = $conexao->prepare("
        Update alunos
        SET
        nome = ?,
        formacao = ?,
        email = ?,
        telefone = ?,
        senha = ?,
        datanascimento = ?
        WHERE id = ?
        ");


        $stmt->bind_param(
            "ssssssi",
            $nome,
            $formacao,
            $email,
            $telefone,
            $senhacripto,
            $datanascimento,
            $idaluno
            
        );
}


 if ($stmt->execute()) {
    header("Location: ../aluno.php?id=$idaluno");
 }  

 else{
     echo("<script>alert('Não foi possível atualizar a aula Erro:". $stmt->error ." ');</script>");
 }

 $stmt->close();
 $conexao->close();
?>