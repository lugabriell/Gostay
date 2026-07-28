<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
include_once('connection.php');
require_once __DIR__ . "/functions/validationadm.php";

    //Puxandos os ids, e verificando se eles existem, caso não existam, redireciona para dashadm.php
    $idcurso= isset($_GET['idcurso']) ? (int) $_GET['idcurso'] : null;
    if($idcurso === null ) {
        header("Location: dashadm.php");
        exit();
    }

    //Puxando os dados do curso do banco de dados, para poder editar o status do curso
    $selectcurso = "SELECT * from curso where id = '$idcurso'";
    $resultcurso = mysqli_query($conexao, $selectcurso);
    $dadoscurso = mysqli_fetch_assoc($resultcurso);

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
    <div class="form-container">
        
        <div class="form-header">
            <h1>Editar o curso: <?php echo htmlspecialchars($dadoscurso['nome']); ?></h1>
            <p>Preencha as informações abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editstatuscurso.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
            <input type="hidden" name="idcurso" value="<?php echo htmlspecialchars($idcurso); ?>">
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