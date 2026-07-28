<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once("connection.php");

$tokenadm = isset($_POST['tokenadm']) ? (string) $_POST['tokenadm'] : null;
$tokenuser = isset($_POST['tokenuser']) ? (string) $_POST['tokenuser'] : null;

if($tokenadm === null && $tokenuser === null) {
    echo "<script>alert('Token não encontrado!');</script>";
    exit();
}

if($tokenadm !== null) {
    hash_equals($_SESSION['tokenadm'], $tokenadm) or die("<script>alert('Token inválido!');</script>");
    $token1 = $tokenadm;
}
if($tokenuser !== null) {
    hash_equals($_SESSION['tokenuser'], $tokenuser) or die("<script>alert('Token inválido!');</script>");
    $token2 = $tokenuser;
    $idaluno = isset($_POST['idaluno']) ? (int) $_POST['idaluno'] : null;
}

$idaula = isset($_POST['trackid']) ? (int) $_POST['trackid'] : null;

if($idaula === null) {
    echo "<script>alert('Aula não encontrada!');</script>";
    exit();
}

else{
    if(isset($token1)){
        $sql = "SELECT * from aula WHERE id = '$idaula'";
        $result = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_assoc($result);
        if (empty($dados) || empty($dados['caminhoconteudo'])) {
            echo "<script>alert('Aula não encontrada!');</script>";
            exit();
        }
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
            exit;

        } else {
            echo "<script>alert('N foi possível realizar o download!');</script>";
            exit();
        }

    }


    if(isset($token2)){
        $sql = "SELECT * from aula WHERE id = '$idaula'";
        $result = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_assoc($result);
        if (empty($dados) || empty($dados['caminhoconteudo'])) {
            echo "<script>alert('Error na aula!');</script>";
            exit();
        }
        $stmt = $conexao->prepare(
            "SELECT statusal FROM cursoaluno ca 
            JOIN aula a ON a.idcurso = ca.idcurso 
            WHERE a.id = ? AND ca.idaluno = ? AND ca.statusal = 'ativo'"
        );
        $stmt->bind_param("ii", $idaula, $idaluno);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $autorizado = $resultado->fetch_assoc();

        if (!$autorizado) {
            echo "<script>alert('Error na aula!');</script>";
            exit(); 
        }   

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
            exit;

        } else {
            echo "<script>alert('N foi possível realizar o download!');</script>";
            exit();
        }

    }

}



?>