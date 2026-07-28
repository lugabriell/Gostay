<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once __DIR__ . "/connection.php";


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
        if(password_verify($userSenha, $userData['senha'])) {
            session_regenerate_id(true);
            $_SESSION['tokenprof'] = bin2hex(random_bytes(32));
            $_SESSION['emailprof'] = $userData['email'];
            $_SESSION['nameprof'] = $userData['nome'];
            $_SESSION['idprof'] =  $userData['id'];
            $_SESSION['tokenprof'] = bin2hex(random_bytes(32));
            $_SESSION['ipprof'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['uaprof'] = $_SERVER['HTTP_USER_AGENT'];
            header("Location: homeprof.php");
            exit;
         } else {
            
            header("Location: loginprof.php?error=senha_incorreta");
            exit;
        }
    } else {
        
         header("Location: loginprof.php?error=usuario_nao_encontrado");
        exit;
    }
} else {
        header("Location: loginprof.php?error=erro_interno");
        exit;
}
?>