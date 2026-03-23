<?php
session_start();
include_once('connection.php');


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
            $_SESSION['emailadm'] = $userData['email'];
            $_SESSION['nameadm'] = $userData['nome'];

            header("Location: dashadm.php");
            
         } else {
            
            header("Location: loginadm.php?error=senha_incorreta");

        }
    } else {
        
         header("Location: loginadm.php?error=usuario_nao_encontrado");

    }
} else {
        echo ( 'Deu errado');

   
}
?>