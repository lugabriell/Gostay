<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
    include_once('connection.php');
    session_start();
        if(!isset($_SESSION['emailprof']) && !isset($_SESSION['nameprof']) && !isset($_SESSION['idprof'])){
            header('Location: nonvalidated.php');
        }
        $idcurso = $_GET['idcurso'];
        
        $selectcurso = "SELECT * from curso where id = '$idcurso'";
        $resultcurso = mysqli_query($conexao, $selectcurso);
        $dadoscurso = mysqli_fetch_assoc($resultcurso);
    // if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    //     header('Location: index.html');
    //     session_unset();
    //     session_destroy();
    // }
    
    // else{
    //   $_SESSION['verificação'] = 'Ativo';
          
    // }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Formulário de contato moderno e responsivo">
    <title>Formulário de Contato</title>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">

    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <div class="form-container">
        
        <div class="form-header">
            <h1>Editar o curso: <?php echo($dadoscurso['nome']); ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editstatuscurso.php" method="POST">
            <input type="hidden" name="token" value="<?php echo($_SESSION['tokenprof']); ?>">
            <input type="hidden" name="idcurso" value="<?php echo($idcurso); ?>">
            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="status" value="ativo"
                            <?php if($dadoscurso['statuscurso'] == 'ativo') echo 'checked'; ?> required>
                        <span>Ativo</span>
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="status" value="inativo"
                            <?php if($dadoscurso['statuscurso']  == 'inativo') echo 'checked'; ?>>
                        <span>Inativo</span>
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve"
                            <?php if($dadoscurso['statuscurso']  == 'em-breve') echo 'checked'; ?>>
                        <span>Em Breve</span>
                    </label>
                </div>

            </div>
            

            <!-- Botão de Envio -->
            <button type="submit" name="submit">Editar Curso</button>
            
        </form>
    </div>
</body>
</html>