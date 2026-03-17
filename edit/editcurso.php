<?php
require_once __DIR__ . "/../connection.php";

session_start();
$nome          = $_POST['nome'];
$qtdal         = $_POST['qtd-alunos'];
$professor     = $_POST['professor'];
$qtdm          = $_POST['qtd-modulos'];
$qtda          = $_POST['qtd-aulas'];
$cargahoraria  = $_POST['carga-horaria'];
$descricao     = $_POST['descricao'];
$status        = $_POST['status'];
$categoria     = $_POST['categoria'];
$nivel         = $_POST['nivel'];
$datacadastro  = $_POST['data-cadastro'];

// você preenche esse id
$idcurso = $_POST['id']; // ou vem por GET

$stmt = $conexao->prepare("
    UPDATE curso SET
        nome = ?,
        qtdal = ?,
        idprofessor = ?,
        qtdm = ?,
        qtda = ?,
        cargahoraria = ?,
        descricao = ?,
        statuscurso = ?,
        idcategoria = ?,
        nivel = ?,
        datacadastro = ?
    WHERE id = ?
");

$stmt->bind_param(
    "sisiissssssi",
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
    $idcurso
);

$stmt->execute();
header("Location: ../curso.php?id=$idcurso")



?>