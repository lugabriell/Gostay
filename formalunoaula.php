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

    

    if(isset($_GET['idaluno'])){
        $idaluno = $_GET['idaluno'];
        $selectcurso = "SELECT * from alunos WHere id = '$idaluno'";
        $resultcurso = mysqli_query($conexao, $selectcurso);
        $dadoscurso = mysqli_fetch_assoc($resultcurso);
        $selectalunos = "SELECT * from aula";
        $resultalunos = mysqli_query($conexao, $selectalunos);
    }
    else{
        $idaula = $_GET['idaula'];
        $selectcurso = "SELECT * from aula WHere id = '$idaula'";
        $resultcurso = mysqli_query($conexao, $selectcurso);
        $dadoscurso = mysqli_fetch_assoc($resultcurso);
        $selectalunos = "SELECT * from alunos";
        $resultalunos = mysqli_query($conexao, $selectalunos);
    
    }
        

    

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
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro Aula <?php echo($dadoscurso['nome']); ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="creates/createalunoaula.php" method="POST">
            
            <!-- Campo Nome do Curso -->

            <input type="hidden" name="idaluno" value="<?php   if(isset($_GET['idaluno'])){ echo($idaluno);}else{echo($idaula);}?>">
            <label for="aula"><?php   if(isset($_GET['idaluno'])){ echo("Aula");}else{echo("Aluno");}?></label>
            <select name="aula">
                <?php while($dadosalunos = mysqli_fetch_assoc($resultalunos)) : ?>
                    <option value="<?php echo $dadosalunos['id']; ?>">
                        <?php echo $dadosalunos['nome']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="status" value="ativo" required>
                        <span>Ativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="inativo">
                        <span>Inativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve">
                        <span>Em Breve</span>
                    </label>
                </div>
            </div>
            

            <!-- Botão de Envio -->
            <button type="submit" name="submit">Cadastrar Aluno</button>
            
        </form>
    </div>
</body>
</html>