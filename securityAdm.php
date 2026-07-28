
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

        $sql = "SELECT email, senha, id, nome FROM adms WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            if(password_verify($userSenha, $userData['senha'])) {
                session_regenerate_id(true);
                $_SESSION['tokenadm'] = bin2hex(random_bytes(32));
                $_SESSION['emailadm'] = $userData['email'];
                $_SESSION['nameadm'] = $userData['nome'];
                $_SESSION['ipadm'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['uaadm'] = $_SERVER['HTTP_USER_AGENT'];

                header("Location: dashadm.php");
                
            } else {
                
                header("Location: loginadm.php?error=senha_incorreta");
                $_SESSION['tentativas']++;
            }
        } else {
            
            header("Location: loginadm.php?error=usuario_nao_encontrado");
            $_SESSION['tentativas']++;
        }
    } else {
           exit("Por favor, preencha todos os campos.");

    
    }
}
else{
    exit("Muitas tentativas. Tente novamente mais tarde.");
}   
?>