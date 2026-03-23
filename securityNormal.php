<?php
session_start();
include_once('connection.php');


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
            header("Location: homepage.php");
            
         } else {
            
            header("Location: login.php?error=senha_incorreta");

        }
    } else {
        
         header("Location: login.php?error=usuario_nao_encontrado");

    }
} else {
        echo ( 'Deu errado');

   
}
?>