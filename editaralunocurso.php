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
        if(!isset($_SESSION['emailadm']) && !isset($_SESSION['nameadm'])){
            header('Location: nonvalidated.php');
        }
        else{
            $email = $_SESSION['emailadm'];
            $nome = $_SESSION['nameadm'];
            $sql = "SELECT autenticado FROM adms WHERE email = '$email' AND nome = '$nome' ";
            $result = mysqli_query($conexao, $sql);
            $dados = mysqli_fetch_assoc($result);
            $sqlcategoria = 'SELECT * from categoria';
            $resultcategoria =mysqli_query($conexao, $sqlcategoria);
            $qtdcategoria = mysqli_num_rows($resultcategoria);
            if(empty($dados)){
                header('Location: nonvalidated.php');
            }
            else{
                if($dados['autenticado'] == 'nao'){
                    header('Location: nonvalidated.php');
                }
            }


        }
        $idcurso = $_GET['idcurso'];
        $idaluno = $_GET['id'];
        $selectcurso = "SELECT * from curso WHere id = '$idcurso'";
        $resultcurso = mysqli_query($conexao, $selectcurso);
        $dadoscurso = mysqli_fetch_assoc($resultcurso);
        $selectalunos = "SELECT * from alunos WHERE id = '$idaluno'";
        $resultalunos = mysqli_query($conexao, $selectalunos);
        $resultalunos2 = mysqli_query($conexao, $selectalunos);
        $selectalunocurso = "SELECT * from cursoaluno WHERE idcurso = '$idcurso' and idaluno = '$idaluno'";
        $resultalunocurso = mysqli_query($conexao, $selectalunocurso);
        $dadosalunocurso = mysqli_fetch_assoc($resultalunocurso);

    

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
        <?php $dadosalunos = mysqli_fetch_assoc($resultalunos2); ?>
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro  <?php echo($dadosalunos['nome']) ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editalunocurso.php" method="POST">
            
            <!-- Campo Nome do Curso -->

            <input type="hidden" name="idcurso" value="<?php echo($idcurso); ?>">
            <input type="hidden" name="idaluno" value="<?php echo($idaluno) ?>">
            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="status" value="ativo"
                            <?php if($dadosalunocurso['statusa'] == 'ativo') echo 'checked'; ?> required>
                        <span>Ativo</span>
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="status" value="inativo"
                            <?php if($dadosalunocurso['statusa'] == 'inativo') echo 'checked'; ?>>
                        <span>Inativo</span>
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve"
                            <?php if($dadosalunocurso['statusa'] == 'em-breve') echo 'checked'; ?>>
                        <span>Em Breve</span>
                    </label>
                </div>

            </div>
            

            <!-- Botão de Envio -->
            <button type="submit" name="submit">Editar Aluno</button>
            
        </form>
    </div>
</body>
</html>