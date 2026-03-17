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

        $idcurso = $_GET['idcurso'];
    

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
            <h1>Cadastro de Módulo</h1>
            <p>Preencha as informações do módulo abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="creates/createmodulo.php" method="POST">
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome do Módulo</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do Módulo"
                    required
                >
            </div>

            <input type="hidden" name="idcurso" id="idcurso" value="<?php echo($idcurso); ?>">
            <div class="form-group">
                <label for="ordem">Número do Módulo</label>
                <input type="number" name="ordem" id="ordem" required placeholder="0">
            </div>


            <!-- Botão de Envio -->
            <button type="submit">Cadastrar Módulo</button>
            
        </form>
    </div>
</body>
</html>