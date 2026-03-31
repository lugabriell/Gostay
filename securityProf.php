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


if(isset($_POST['submit']) && !empty($_POST['senha']) && !empty($_POST['email'])) {
    
    $userEmail = $_POST['email'];
    $userSenha = $_POST['senha'];

    $sql = "SELECT email, senha, id, nome FROM professor WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        echo('1 etapa clear');
        if(password_verify($userSenha, $userData['senha'])) {
            echo('2 etapa clear');
            $_SESSION['emailadm'] = $userData['email'];
            $_SESSION['nameadm'] = $userData['nome'];

            header("Location: homeprof.php");
            
         } else {
            
            header("Location: loginprof.php?error=senha_incorreta");

        }
    } else {
        
         header("Location: loginprof.php?error=usuario_nao_encontrado");

    }
} else {
        echo ( 'Deu errado');

   
}
?>