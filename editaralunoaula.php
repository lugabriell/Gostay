<?php
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

    

    if(isset($_GET['idaula']) && isset($_GET['id'])){
        $idaluno = $_GET['id'];
        $idaula = $_GET['idaula'];
        $selectcurso = "SELECT * from alunoaula WHere idaluno = '$idaluno' AND idaula = '$idaula'";
        $resultcurso = mysqli_query($conexao, $selectcurso);
        $dadoscurso = mysqli_fetch_assoc($resultcurso);
        $sqlaulanome = "SELECT * FROM aula WHERE id = '$idaula'";
        $resultaulanome = mysqli_query($conexao, $sqlaulanome);
        $dadosaulanome = mysqli_fetch_assoc($resultaulanome);
        $sqlalunonome = "SELECT * FROM alunos WHERE id = '$idaluno'";
        $resultalunonome = mysqli_query($conexao, $sqlalunonome);
        $dadosalunonome = mysqli_fetch_assoc($resultalunonome);
        $selectalunos = "SELECT * from aula";
        $resultalunos = mysqli_query($conexao, $selectalunos);
    }
    else{
        //header("Location: aluno.php?id=$idaluno");
    
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
            <h1>Edit Aula <?php echo($dadosaulanome['nome']); ?> <br>Aluno: <?php echo($dadosalunonome['nome']); ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editalunoaula.php" method="POST">
            
            <!-- Campo Nome do Curso -->

            <input type="hidden" name="idaluno" value="<?php  echo($idaluno);?>">
            <input type="hidden" name="idaula" value="<?php echo($idaula); ?>">
            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="status" value="ativo" <?php if($dadoscurso['statusal'] == 'ativo') echo 'checked'; ?> required>
                        <span>Ativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="inativo"<?php if($dadoscurso['statusal'] == 'inativo') echo 'checked'; ?>>
                        <span>Inativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve" <?php if($dadoscurso['statusal'] == 'em-breve') echo 'checked'; ?>>
                        <span>Em Breve</span>
                    </label>
                </div>
            </div>
            

            <!-- Botão de Envio -->
            <button type="submit" name="submit">Editar aula de aluno</button>
            
        </form>
    </div>
</body>
</html>