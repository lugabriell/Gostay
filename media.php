<?php
require_once("connection.php");

$idaula = $_GET['trackid'];
$sql = "SELECT * from aula WHERE id = '$idaula'";
$result = mysqli_query($conexao, $idaula);
$dados = mysqli_fetch_assoc($result);
$caminho = "creates/". $dados['caminhoconteudo'];
if (file_exists($caminho)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($caminho).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($caminho));

    readfile($caminho);
    header("Location: infos.php?$idaula");
    exit;

} else {
    echo "<script>alert('N foi possível realizar o download!');</script>";
}




?>