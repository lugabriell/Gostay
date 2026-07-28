<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/functions/validationadm.php";

    //Puxando as categorias do banco de dados + qtd de categorias
    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);
    $qtdcategoria = mysqli_num_rows($resultcategoria);



    //Puxando os ids do aluno e da aula do banco de dados
    $idaluno = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $idaula = isset($_GET['idaula']) ? (int) $_GET['idaula'] : null;
    if($idaluno === null || $idaula === null) {
        header("Location: dashadm.php");
        exit();
    }  
    //Puxando os dados do aluno e da aula do banco de dados
    $selectcurso = "SELECT * FROM alunoaula WHERE idaluno = $idaluno AND idaula = $idaula";
    $resultcurso = mysqli_query($conexao, $selectcurso);
    $dadoscurso = mysqli_fetch_assoc($resultcurso);

    //Puxando os dados da aula 
    $sqlaulanome = "SELECT * FROM aula WHERE id = '$idaula'";
    $resultaulanome = mysqli_query($conexao, $sqlaulanome);
    $dadosaulanome = mysqli_fetch_assoc($resultaulanome);

    //Puxando os dados do aluno
    $sqlalunonome = "SELECT * FROM alunos WHERE id = '$idaluno'";
    $resultalunonome = mysqli_query($conexao, $sqlalunonome);
    $dadosalunonome = mysqli_fetch_assoc($resultalunonome);

    //Puxando todas as aulas do banco de dados
    $selectalunos = "SELECT * from aula";
    $resultalunos = mysqli_query($conexao, $selectalunos);


        

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
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Edit Aula <?php echo htmlspecialchars($dadosaulanome['nome']); ?> <br>Aluno: <?php echo htmlspecialchars($dadosalunonome['nome']); ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editalunoaula.php" method="POST">
            
            <!-- Campo Nome do Curso -->

            <input type="hidden" name="idaluno" value="<?php  echo htmlspecialchars($idaluno);?>">
            <input type="hidden" name="idaula" value="<?php echo htmlspecialchars($idaula); ?>">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
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