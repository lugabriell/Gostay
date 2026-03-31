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
    $idcategoria = $_GET['id'];

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

    if(!empty($idcategoria)){
        $sqlSelect = "SELECT * FROM categoria WHERE id = '$idcategoria'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = $user_data['nome'];
                $descricao = $user_data['descricao'];

            }
        }
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
            <input type="hidden" name="idedit" id="idedit" value="<?php echo($idcategoria); ?>" >
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do curso"
                    required
                    value="<?php echo($nome); ?>"
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
                    value="<?php echo($descricao); ?>"
                >
            </div>


            <!-- Botão de Envio -->
            <button type="submit" name="submit">Cadastrar Categoria</button>
            
        </form>
    </div>
</body>
</html>