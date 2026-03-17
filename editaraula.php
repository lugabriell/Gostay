<?php
    include_once('connection.php');
    session_start();


    $sql = "SELECT nome, id From professor ";
    $resultprof = mysqli_query($conexao, $sql);

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
    $idaula = $_GET['id'];
    $sqlaula = "SELECT * From aula WHERE id = '$idaula'";
    $resultaula = mysqli_query($conexao, $sqlaula);
    $dadosaula = mysqli_fetch_assoc($resultaula);
    $idcurso = $dadosaula['idcurso'];
    $idmodulo2 = $dadosaula['idmodulo'];
    $sqlmodulo= "SELECT * FRom modulo where idcurso='$idcurso'";
    $resultmodulo = mysqli_query($conexao, $sqlmodulo);

    

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
            <h1>Cadastro de Aula</h1>
            <p>Preencha as informações da Aula abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="edit/editaula.php" enctype="multipart/form-data" class="side"  method="POST" novalidate>
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome da Aula</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do curso"
                    value="<?php echo($dadosaula['nome']); ?>"
                    required
                >
            </div>
            <input type="hidden" name="idcurso" id="idcurso" value="<?php echo($idcurso); ?>">
            <!-- Campo Quantidade de Alunos -->
             <input type="hidden" name="idaula" id="idaula" value="<?php echo($idaula); ?>">
            <div class="form-group">
                <label for="duracao">Duração em horas</label>
                <input 
                    type="number" 
                    id="duracao" 
                    name="duracao" 
                    placeholder="0"
                    min="0"
                    value="<?php echo($dadosaula['duracao']); ?>"
                    required
                >
            </div>

            <!-- Campo Professor (Radio) -->
          <div class="form-group">
              <label>Professor</label>
              <div class="radio-group">

              <?php while ($dadosprof = mysqli_fetch_assoc($resultprof)): ?>
                          <label class="radio-label">
                              <input
                                  type="radio"
                                  name="professor"
                                  value="<?= $dadosprof['id'] ?>"
                                    <?= ($dadosprof['id'] == $dadosaula['idprofessor']) ? 'checked' : '' ?>
                                  required
                              >
                              <span><?= htmlspecialchars($dadosprof['nome']) ?></span>
                          </label>
              <?php endwhile; ?>

              </div>
          </div>
          <div class="form-group">
              <label>Módulo</label>
              <div class="radio-group">

              <?php while ($dadosmodulo = mysqli_fetch_assoc($resultmodulo)): ?>
                          <label class="radio-label">
                              <input
                                  type="radio"
                                  name="modulo"
                                  value="<?= $dadosmodulo['id'] ?>"
                                <?= ($dadosmodulo['id'] == $idmodulo2) ? 'checked' : '' ?>
                                  required
                              >
                              <span><?= htmlspecialchars($dadosmodulo['nome']) ?></span>
                          </label>
              <?php endwhile; ?>

              </div>
          </div>


            <!-- Campo Quantidade de Módulos -->
            <div class="form-group">
                <label for="qtd-alunos">Quantidade de Alunos</label>
                <input 
                    type="number" 
                    id="qtd-alunos" 
                    name="qtd-alunos" 
                    placeholder="0"
                    value="<?php echo($dadosaula['qtdalunos']); ?>"
                    min="1"
                    required
                >
            </div>

            <!-- Campo Quantidade de Aulas -->
            <div class="form-group">
                <label for="ordem">Número da Aula</label>
                <input 
                    type="number" 
                    id="ordem" 
                    name="ordem" 
                    value="<?php echo($dadosaula['ordem']); ?>"
                    placeholder="0"
                    min="1"
                    required
                >
            </div>

            <!-- Campo Descrição -->
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea 
                    id="descricao" 
                    name="descricao" 
                
                    placeholder="Descreva o curso..."
                    required
                ><?= htmlspecialchars($dadosaula['descricao']); ?></textarea>
            </div>

            <!-- Campo Status (Radio) -->
            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="status" value="ativo" required>
                        <span>Ativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="inativo" required>
                        <span>Inativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve" required>
                        <span>Em Breve</span>
                    </label>
                </div>
            </div>
            <div>
                <div>
                <label>Selecione um video:</label><br>

                <input type="file" name="video" id="video" accept="video/*">
                </div>
            </div>
            <div>
                <div>
                <label>Selecione o Conteúdo:</label><br>

                <input type="file" name="media" id="media" accept=".pdf, .pptx, .txt">
                </div>
            </div>


            <!-- Botão de Envio -->
            <button type="submit" name='submit'>Cadastrar Aula</button>
            
        </form>
    </div>
</body>
</html>