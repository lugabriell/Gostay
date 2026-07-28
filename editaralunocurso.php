<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
include_once('connection.php');
require_once __DIR__ . "/functions/validationadm.php";

    //Puxando as categorias do banco de dados + qtd de categorias
    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);
    $qtdcategoria = mysqli_num_rows($resultcategoria);

    //Puxando os ids e verificando se são nulos do aluno e do curso do banco de dados
    $idaluno = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $idcurso = isset($_GET['idcurso']) ? (int) $_GET['idcurso'] : null;
    if($idaluno === null || $idcurso === null) {
        header("Location: dashadm.php");
        exit();
    }

    //Puxando os dados do curso, aluno e cursoaluno do banco de dados respectivamente
    $selectcurso = "SELECT * from curso WHere id = '$idcurso'";
    $resultcurso = mysqli_query($conexao, $selectcurso);
    $dadoscurso = mysqli_fetch_assoc($resultcurso);


    $selectalunos = "SELECT * from alunos WHERE id = '$idaluno'";
    $resultalunos = mysqli_query($conexao, $selectalunos);
    $resultalunos2 = mysqli_query($conexao, $selectalunos);


    $selectalunocurso = "SELECT * from cursoaluno WHERE idcurso = '$idcurso' and idaluno = '$idaluno'";
    $resultalunocurso = mysqli_query($conexao, $selectalunocurso);
    $dadosalunocurso = mysqli_fetch_assoc($resultalunocurso);

    


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Formulário de contato moderno e responsivo">
    <title>Formulário de Contato</title>
     <?php require_once __DIR__ . '/functions/analytics.php'; ?>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">

    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <!-- Container principal do formulário -->
    <div class="form-container">
        <?php $dadosalunos = mysqli_fetch_assoc($resultalunos2); ?>
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro  <?php echo htmlspecialchars($dadosalunos['nome']) ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editalunocurso.php" method="POST">
            
            <!-- Campo Nome do Curso -->

            <input type="hidden" name="idcurso" value="<?php echo htmlspecialchars($idcurso); ?>">
            <input type="hidden" name="idaluno" value="<?php echo htmlspecialchars($idaluno) ?>">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
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