<?php

if ($_SESSION['ipadm'] !== $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['uaadm'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    header("Location: loginadm.php?error=nao_e_permitido_troca_ip_ou_user_agent");
    exit();
}
if (!isset($_SESSION['tokenadm']) || !isset($_SESSION['nameadm']) || !isset($_SESSION['emailadm'])) {
    session_destroy();
    header("Location: loginadm.php");
    exit();
}
$email = filter_var($_SESSION['emailadm'], FILTER_VALIDATE_EMAIL);
$nome  = htmlspecialchars($_SESSION['nameadm'], ENT_QUOTES, 'UTF-8');

if (!$email || !$nome) {
    session_destroy();
    header("Location: loginadm.php");
    exit;
}

$stmt = $conexao->prepare("SELECT autenticado FROM adms WHERE email = ? AND nome = ?");
$stmt->bind_param("ss", $email, $nome);
$stmt->execute();
$dados = $stmt->get_result()->fetch_assoc();
if(empty($dados) || $dados['autenticado'] !== 'sim') {
    session_destroy();
    header("Location: loginadm.php?error=usuario_nao_encontrado");
    exit();
}

$stmt2 = $conexao->prepare("SELECT nome FROM adms WHERE email = ? AND nome = ?");
$stmt2->bind_param("ss", $email, $nome);
$stmt2->execute();
$dados2 = $stmt2->get_result()->fetch_assoc();
$nomeCompleto = $dados2['nome'];


$partesNome = explode(' ', trim($nomeCompleto));
$nomePrincipal = $partesNome[0] . ' ' . ($partesNome[1] ?? '');
$letras = strtoupper(
    substr($partesNome[0], 0, 1) .
    (isset($partesNome[1]) ? substr($partesNome[1], 0, 1) : '')
);