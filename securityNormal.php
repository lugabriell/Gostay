<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
session_start();
include_once('connection.php');
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
    $_SESSION['maxtentativas'] = 5;
}
if($_SESSION['tentativas'] < $_SESSION['maxtentativas']){
    if(isset($_POST['submit']) && !empty($_POST['senha']) && !empty($_POST['email'])) {
        
        $userEmail = $_POST['email'];
        $userSenha = $_POST['senha'];

        $sql = "SELECT email, senha, id, nome, autenticado FROM alunos WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            if(password_verify($userSenha, $userData['senha'])) {
                
                $_SESSION['email'] = $userData['email'];
                $_SESSION['nome'] = $userData['nome'];
                $_SESSION['autenticado'] = $userData['autenticado'];
                $_SESSION['id'] = $userData['id'];
                $_SESSION['tentativas'] = 0;
                header("Location: homepage.php");
                
            } else {
                $_SESSION['tentativas']++;
                header("Location: login.php?error=senha_incorreta");

            }
        } else {
            $_SESSION['tentativas']++;
            header("Location: login.php?error=usuario_nao_encontrado");

        }
    } else {
            echo ( 'Erro Interno');

    
    }
}
else{
    exit("Muitas tentativas. Tente novamente mais tarde.");
}
?>