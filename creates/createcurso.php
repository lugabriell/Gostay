<?php
require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../functions/savemedia.php";
require_once __DIR__ ."/../functions/headers.php";
require_once __DIR__ . "/../functions/sessions.php";


if (!hash_equals($_SESSION['tokenadm'], $_POST['token'])) {
    header('Location: dashadm.php');
    exit;
}

$nome          = $_POST['nome'];
$qtdal        = $_POST['qtd-alunos'];
$professor         = (int) $_POST['professor'];
$qtdm      = $_POST['qtd-modulos'];
$qtda = $_POST['qtd-aulas'];
$cargahoraria = $_POST['carga-horaria'];
$descricao = $_POST['descricao'];
$status = $_POST['status'];
$categoria = $_POST['categoria'];
$arquivooriginal = $_FILES['arquivo'];
$arquivobd = salvarft($arquivooriginal, $conexao);
$arquivooriginal2 = $_FILES['arquivo2'];
$arquivobd2 = salvarft($arquivooriginal2, $conexao);
$nivel = $_POST['nivel'];
$datacadastro = $_POST['data-cadastro'];
$tipo = $_POST['tipo'];

$stmt = $conexao->prepare("
    INSERT INTO curso 
    (nome, qtdal, idprofessor, qtdm, qtda, cargahoraria, descricao, statuscurso, idcategoria, nivel, datacadastro, ftcurso,tipo,posterft) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)
");

$stmt->bind_param(
    "sisiisssssssss",
    $nome,
    $qtdal,
    $professor,
    $qtdm,
    $qtda,
    $cargahoraria,
    $descricao,
    $status,
    $categoria,
    $nivel,
    $datacadastro,
    $arquivobd,
    $tipo,
    $arquivobd2
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
