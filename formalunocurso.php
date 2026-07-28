<?php
include_once('connection.php');
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once __DIR__ . "/functions/validationadm.php";


    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);
    $qtdcategoria = mysqli_num_rows($resultcategoria);
    if($qtdcategoria === 0) {
        header("Location: dashadm.php");
        exit();
    }

    $idaluno = isset($_GET['idaluno']) ? (int) $_GET['idaluno'] : null;
    if($idaluno === null) {
        header("Location: dashadm.php");
        exit();
    }

    $selectcurso = "SELECT * from alunos WHere id = '$idaluno'";
    $resultcurso = mysqli_query($conexao, $selectcurso);
    $qtdcurso = mysqli_num_rows($resultcurso);
    if($qtdcurso === 0) {
        header("Location: dashadm.php");
        exit();
    }
    $dadoscurso = mysqli_fetch_assoc($resultcurso);


    $selectalunos = "SELECT * from curso";
    $resultalunos = mysqli_query($conexao, $selectalunos);
    $qtdalunos = mysqli_num_rows($resultalunos);
    if($qtdalunos === 0) {
        header("Location: dashadm.php");
        exit();
    }

    $idcurso = isset($_GET['idcurso']) ? (int) $_GET['idcurso'] : null;
    if($idcurso === null) {
        header("Location: dashadm.php");
        exit();
    }
    
    $selectcurso = "SELECT * from curso WHere id = '$idcurso'";
    $resultcurso = mysqli_query($conexao, $selectcurso);
    $qtdcurso = mysqli_num_rows($resultcurso);
    if($qtdcurso === 0) {
        header("Location: dashadm.php");
        exit();
    }
    $dadoscurso = mysqli_fetch_assoc($resultcurso);


    $selectalunos = "SELECT * from alunos";
    $resultalunos = mysqli_query($conexao, $selectalunos);



    

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
     <?php require_once __DIR__ . '/functions/analytics.php'; ?>

    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <!-- Container principal do formulário -->
    <div class="form-container">
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro Aluno <?php echo htmlspecialchars($dadoscurso['nome']); ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="creates/createalunocurso.php" method="POST">
            
            <!-- Campo Nome do Curso -->

            <input type="hidden" name="idcurso" value="<?php   if(isset($_GET['idaluno'])){ echo htmlspecialchars($idaluno);}else{echo htmlspecialchars($idcurso);}?>">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
            <label for="aluno"><?php   if(isset($_GET['idaluno'])){ echo("Curso");}else{echo("Aluno");}?></label>
            <select name="aluno">
                <?php while($dadosalunos = mysqli_fetch_assoc($resultalunos)) : ?>
                    <option value="<?php echo htmlspecialchars($dadosalunos['id']); ?>">
                        <?php echo htmlspecialchars($dadosalunos['nome']); ?>
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