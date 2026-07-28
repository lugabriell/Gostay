<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
include_once('connection.php');
require_once __DIR__ . "/functions/validationadm.php";

    //Puxando as categorias do banco de dados + qtd de categorias
    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);
    $qtdcategoria = mysqli_num_rows($resultcategoria);

    //Puxando o id do módulo do banco de dados + dados do módulo
    $idmodulo = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if($idmodulo === null) {
        header("Location: dashadm.php");
        exit();
    }
    $sqlmodulo = "SELECT * From modulo where id = '$idmodulo'" ;   
    $resultmodulo = mysqli_query($conexao, $sqlmodulo);
    $qtdmodulo = mysqli_num_rows($resultmodulo);
    if($qtdmodulo === 0) {
        header("Location: dashadm.php");
        exit();
    }
    else{
        $dadosmodulo = mysqli_fetch_assoc($resultmodulo);
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
     <?php require_once __DIR__ . '/functions/analytics.php'; ?>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">

    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <!-- Container principal do formulário -->
    <div class="form-container">
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro de Módulo</h1>
            <p>Preencha as informações do módulo abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editmodulo.php" method="POST">
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome do Módulo</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do Módulo"
                    required
                    value="<?php echo htmlspecialchars($dadosmodulo['nome']); ?>"
                >
            </div>
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
            <input type="hidden" name="idmodulo" id="idmodulo" value="<?php echo htmlspecialchars($dadosmodulo['id']); ?>">
            <input type="hidden" name="idcurso" id="idcurso" value="<?php echo htmlspecialchars($dadosmodulo['idcurso']); ?>">
            <div class="form-group">
                <label for="ordem">Número do Módulo</label>
                <input type="number" value="<?php echo htmlspecialchars($dadosmodulo['ordem']); ?>" name="ordem" id="ordem" required placeholder="0">
            </div>


            <!-- Botão de Envio -->
            <button type="submit">Cadastrar Módulo</button>
            
        </form>
    </div>
</body>
</html>