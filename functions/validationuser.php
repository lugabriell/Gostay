<?php
if (!isset($_SESSION['ip']) || !isset($_SESSION['ua']) ||     $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['ua'] !== $_SERVER['HTTP_USER_AGENT']){
    if ($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] || 
        $_SESSION['ua'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        header("Location: login.php?error=nao_e_permitido_troca_ip_ou_user_agent");
        exit();
    }
    if (!isset($_SESSION['tokenuser']) || !isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
    $email = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);
    $nome  = htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8');

    if (!$email || !$nome) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    $stmt = $conexao->prepare("SELECT autenticado FROM alunos WHERE email = ? AND nome = ?");
    $stmt->bind_param("ss", $email, $nome);
    $stmt->execute();
    $dados = $stmt->get_result()->fetch_assoc();
    if(empty($dados) || $dados['autenticado'] !== 'sim') {
        session_destroy();
        header("Location: login.php?error=usuario_nao_encontrado");
        exit();
    }

    $stmt2 = $conexao->prepare("SELECT nome FROM alunos WHERE email = ? AND nome = ?");
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
}
else{
    header("Location: login.php?error");
    session_destroy();
    exit;
}