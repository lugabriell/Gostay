<?php

session_start();

include_once 'autenticar.php';


if(isset($_POST['submit'])){
    
    $retornoemail = enviaremail($_SESSION['email']);
    if($retornoemail == 'ok'){
        // var_dump($_SESSION);
        header('Location: autenticacao2.php');
        exit;
    }
    else{
        echo('deu errado');
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
        Vamos enviar um código de verificação para o e-mail cadastrado na sua conta.
        <?php echo($_SESSION['email']); ?>
    </p>

    <form action="autenticacao.php" method="POST">
        <button type="submit" name="submit">Enviar código</button>
    </form>
</div>

</body>
</html>
