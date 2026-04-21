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
        $idaula = $_GET['id'];
        $stmt = $conexao->prepare("SELECT * FROM aula WHERE id = ?");
        $stmt->bind_param("i", $idaula);
        $stmt->execute();
        $result = $stmt->get_result();
        $dadosaula = $result->fetch_assoc();
       
    

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
    <!-- Container principal do formulário -->
    <div class="form-container">
        <?php  ?>
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Editar <?php echo($dadosaula['nome']) ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editstatusaula.php" method="POST"  enctype="multipart/form-data">
            
            <!-- Campo Nome do Curso -->
            <input type="hidden" name="token" value="<?php echo($_SESSION['tokenprof']); ?>">
            <input type="hidden" name="idaula" value="<?php echo($idaula); ?>">
            <div class="form-group">
                <input type="text" name="nome" id="nome" value="<?php echo($dadosaula['nome']); ?>">
                <label>Status</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="status" value="ativo"
                            <?php if($dadosaula['statusaula'] == 'ativo') echo 'checked'; ?> required>
                        <span>Ativo</span>
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="status" value="inativo"
                            <?php if($dadosaula['statusaula'] == 'inativo') echo 'checked'; ?>>
                        <span>Inativo</span>
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve"
                            <?php if($dadosaula['statusaula'] == 'em-breve') echo 'checked'; ?>>
                        <span>Em Breve</span>
                    </label>
                </div>
                <div>

            <div>
                <div>
                <label>Selecione o Conteúdo:</label><br>

                <input type="file" name="media" id="media" accept=".pdf, .pptx, .txt">
                </div>
            </div>


            </div>
            

            <!-- Botão de Envio -->
            <button type="submit" name="submit">Editar Aula</button>
            
        </form>
    </div>
</body>
</html>