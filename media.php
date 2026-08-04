<?php
declare(strict_types=1);

require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once("connection.php");

function abortar(string $mensagem): never {
    echo "<script>alert('" . addslashes($mensagem) . "');</script>";
    exit();
}

function enviarArquivo(string $caminho): never {
    if (!file_exists($caminho)) {
        abortar('Não foi possível realizar o download!');
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($caminho) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($caminho));

    readfile($caminho);
    exit();
}

function buscarAula(mysqli $conexao, int $idaula): ?array {
    $stmt = $conexao->prepare("SELECT * FROM aula WHERE id = ?");
    $stmt->bind_param("i", $idaula);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();
    $stmt->close();
    return $dados ?: null;
}

$tokenadm  = isset($_POST['tokenadm'])  ? (string) $_POST['tokenadm']  : null;
$tokenuser = isset($_POST['tokenuser']) ? (string) $_POST['tokenuser'] : null;

if ($tokenadm === null && $tokenuser === null) {
    abortar('Token não encontrado!');
}

$isAdmin = false;
$isAluno = false;
$idaluno = null;

if ($tokenadm !== null) {
    if (!isset($_SESSION['tokenadm']) || !hash_equals((string) $_SESSION['tokenadm'], $tokenadm)) {
        abortar('Token inválido!');
    }
    $isAdmin = true;
}

if ($tokenuser !== null) {
    if (!isset($_SESSION['tokenuser']) || !hash_equals((string) $_SESSION['tokenuser'], $tokenuser)) {
        abortar('Token inválido!');
    }
    $isAluno = true;
    $idaluno = isset($_SESSION['id']) ? (int) $_SESSION['id'] : 0;
    if ($idaluno <= 0) {
        abortar('Aluno não encontrado!');
    }
}

$idaula = isset($_POST['trackid']) ? (int) $_POST['trackid'] : 0;
if ($idaula <= 0) {
    abortar('Aula não encontrada!');
}

if ($isAdmin) {
    $dados = buscarAula($conexao, $idaula);
    if ($dados === null || empty($dados['caminhoconteudo'])) {
        abortar('Aula não encontrada!');
    }
    enviarArquivo("creates/" . $dados['caminhoconteudo']);
}

if ($isAluno) {
    // Verifica autorização ANTES de buscar/expor o conteúdo
    $stmt = $conexao->prepare(
        "SELECT statusa FROM cursoaluno ca
         JOIN aula a ON a.idcurso = ca.idcurso
         WHERE a.id = ? AND ca.idaluno = ? AND ca.statusa = 'ativo'"
    );
    $stmt->bind_param("ii", $idaula, $idaluno);
    $stmt->execute();
    $autorizado = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$autorizado) {
        header("Location: infos.php?trackid=" . urlencode((string) $idaula));
        exit();
    }

    $dados = buscarAula($conexao, $idaula);
    if ($dados === null || empty($dados['caminhoconteudo'])) {
        abortar('Erro na aula!');
    }
    enviarArquivo("creates/" . $dados['caminhoconteudo']);
}