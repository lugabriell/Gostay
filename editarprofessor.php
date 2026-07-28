<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
include_once('connection.php');
require_once __DIR__ . "/functions/validationadm.php";



    $sqlcategoria = 'SELECT * from categoria';
    $resultcategoria =mysqli_query($conexao, $sqlcategoria);
    $qtdcategoria = mysqli_num_rows($resultcategoria);


    $idprofessor = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if($idprofessor === null) {
        header("Location: dashadm.php");
        exit();
    }
    $sqlprofessor = "SELECT * From professor where id = '$idprofessor'";
    $resultprofessor = mysqli_query($conexao, $sqlprofessor);
    $dadosprofessor = mysqli_fetch_assoc($resultprofessor);
    $qtdprofessor = mysqli_num_rows($resultprofessor);
    if($qtdprofessor === 0) {
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
            <h1>Cadastro de Professor</h1>
            <p>Preencha as informações do professor abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editprofessor.php" method="POST">
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome do Professor</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="<?php echo htmlspecialchars($dadosprofessor['nome']); ?>"
                    placeholder="Digite o nome do Professor"
                    required
                >
            </div>
            <input type="hidden" name="idprofessor" id="idprofessor" value="<?php echo htmlspecialchars($idprofessor); ?>">
            input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenadm']); ?>">
            <!-- Campo Quantidade de Alunos -->
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="seuemail@email"
                    value="<?php echo htmlspecialchars($dadosprofessor['email']); ?>"
                    minlength="0"
                    required
                >
            </div>



            <!-- Campo Quantidade de Módulos -->
            <div class="form-group">
                <label for="formacao">Formação</label>
                <input 
                    type="text" 
                    id="formacao" 
                    name="formacao" 
                    value="<?php echo htmlspecialchars($dadosprofessor['formacao']); ?>"
                    placeholder="Sua formação"
                    minlength="0"
                    required
                >
            </div>

            <!-- Campo Quantidade de Aulas -->
            <div class="form-group">
                <label for="senha">Senha</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    placeholder="sua senha"
                    minlength="1"
                    required
                >
            </div>



            <!-- Campo Descrição -->
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea 
                    id="bio" 
                    name="bio"
                    placeholder="Sua Bio..."
                    required
                ><?php echo htmlspecialchars($dadosprofessor['bio']); ?></textarea>
            </div>

            <!-- Campo Status (Radio) -->
            <div class="form-group">
                <label>Autenticado</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="autenticado" <?php if($dadosprofessor['autenticado'] == 'sim') echo 'checked'; ?> value="sim" required>
                        <span>Ativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="autenticado"<?php if($dadosprofessor['autenticado'] == 'nao') echo 'checked'; ?> value="nao">
                        <span>Inativo</span>
                    </label>
                </div>
            </div>


            <!-- Botão de Envio -->
            <button type="submit">Editar professor</button>
            
        </form>
    </div>
</body>
</html>