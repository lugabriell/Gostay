<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
include_once('connection.php');
require_once __DIR__ . "/functions/validationadm.php";

    //Puxando o id da categoria do banco de dados, além de puxar todas as categorias do banco de dados + qtd de categorias
    $idcategoria = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);
    $qtdcategoria = mysqli_num_rows($resultcategoria);

    if($idcategoria === null) {
        header("Location: dashadm.php");
        exit();
    }
    
    //Verificação se a categoria existe no banco de dados
    if(!empty($idcategoria)){
        $sqlSelect = "SELECT * FROM categoria WHERE id = '$idcategoria'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = htmlspecialchars($user_data['nome']) ?? 'invalido';
                $descricao = htmlspecialchars($user_data['descricao']) ?? 'invalido';

            }
        }
        else{
            header("Location: dashadm.php");
            exit();
        }
    }
    else{
        header("Location: dashadm.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Formulário de contato moderno e responsivo">
    <title>Formulário de Contato</title>
     <?php require_once __DIR__ . '/functions/analytics.php'; ?>
    <link rel="stylesheet" href="styleform.css">
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
</head>
<body>
    <!-- Container principal do formulário -->
    <div class="form-container">
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro de Categoria</h1>
            <p>Preencha as informações da categoria abaixo</p>
        </div>

       

        <!-- Formulário -->
        <form action="edit/editcategoria.php" method="POST">
            <input type="hidden" name="idedit" id="idedit" value="<?php echo htmlspecialchars($idcategoria); ?>" >
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do curso"
                    required
                    value="<?php echo htmlspecialchars($nome); ?>"
                >
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input 
                    type="text" 
                    id="descricao" 
                    name="descricao" 
                    placeholder="Descrição da Categoria"
                    required
                    value="<?php echo htmlspecialchars($descricao); ?>"
                >
            </div>


            <!-- Botão de Envio -->
            <button type="submit" name="submit">Cadastrar Categoria</button>
            
        </form>
    </div>
</body>
</html>