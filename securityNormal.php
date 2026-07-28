<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once __DIR__ . "/connection.php";
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
                session_regenerate_id(true);
                $_SESSION['email'] = $userData['email'];
                $_SESSION['tokenuser'] = bin2hex(random_bytes(32));
                $_SESSION['nome'] = $userData['nome'];
                $_SESSION['autenticado'] = $userData['autenticado'];
                $_SESSION['id'] = $userData['id'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['tentativas'] = 0;
                header("Location: homepage.php");
                exit;
            } else {
                $_SESSION['tentativas']++;
                header("Location: login.php?error=nao_foi_possivel_encontrar_o_usuario");
                exit;
            }
        } else {
            $_SESSION['tentativas']++;
            header("Location: login.php?error=nao_foi_possivel_encontrar_o_usuario");
            exit;

        }
    } else {
           header("Location: login.php?error=erro_interno");
           exit;

    
    }
}
else{
    header("Location: login.php?error=tentativas_excedidas");
    exit;
}
?>