<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
include_once 'connection.php';
include_once 'autenticar.php';
session_start();


if(isset($_POST['submit'])){
    if($_POST['codigo'] == $_SESSION['codigoaluno']){
        
        $stmt = $conexao->prepare(
            "UPDATE alunos SET autenticado = 'sim' WHERE email = ? AND nome = ? AND id = ?"
            );
        $stmt->bind_param("sss", $_SESSION['email'], $_SESSION['name'], $_SESSION['idaluno']);
        $stmt->execute();
        header('Location: homepage.php');
        
    }
    else{
        echo('deu não');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de E-mail</title>
    <link rel="stylesheet" href="styleh.css">
</head>
<body>

<div class="box">
    <h2>Confirme seu e-mail</h2>
    <p>
        Um código foi enviado para o e-mail:<br>
        <strong><?php echo $_SESSION['email']; ?></strong><br><br>
        Digite o código abaixo:
    </p>

    <form action="autenticacao2.php" method="POST">
        <input 
            type="text" 
            name="codigo"
            class="codigo-input"
            placeholder="000000"
            maxlength="6"
            required
        >

        <button type="submit" name="submit">Confirmar código</button>
    </form>
</div>

</body>
</html>
