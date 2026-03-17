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
    $idcurso = $_GET['idcurso'];
    // $sqlmodulo = "SELECT * From modulo WHERE idcurso = '$idcurso'";
    // $resultmodulo = mysqli_query($conexao, $sqlmodulo);

    

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
            <h1>Cadastro de Aula</h1>
            <p>Preencha as informações da Aula abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="creates/createaula.php" enctype="multipart/form-data" class="side"  method="POST" novalidate>
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome da Aula</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do curso"
                    required
                >
            </div>
            <input type="hidden" name="idcurso" id="idcurso" value="<?php echo($idcurso); ?>">
            <!-- Campo Quantidade de Alunos -->
            <div class="form-group">
                <label for="duracao">Duração em Minutos</label>
                <input 
                    type="number" 
                    id="duracao" 
                    name="duracao" 
                    placeholder="0"
                    min="0"
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
                                  required
                              >
                              <span><?= htmlspecialchars($dadosprof['nome']) ?></span>
                          </label>
              <?php endwhile; ?>

              </div>
          </div>

              <?php
              
            if(!isset($_GET['idcurso'])){
                $sqlmodulo = "SELECT * From modulo";
                $resultmodulo = mysqli_query($conexao, $sqlmodulo);
                $sqlcursos2 = "SELECT * FROM curso";
                $resultcursos2 = mysqli_query($conexao, $sqlcursos2);
                while ($dadoscursos2 = mysqli_fetch_assoc($resultcursos2)): ?>
                    <label>Curso</label>
                    <label class="radio-label">
                        <input
                            type="radio"
                            name="modulo"
                            value="<?= $dadoscursos2['id'] ?>"
                            required
                        >
                <span><?= htmlspecialchars($dadoscursos2['nome']) ?></span>
            </label>
            <?php 
                endwhile;
                }
                else{                  
                    $idcurso = $_GET['idcurso'];
                    $sqlmodulo = "SELECT * From modulo WHERE idcurso = '$idcurso'";
                    $resultmodulo = mysqli_query($conexao, $sqlmodulo);
                }
            ?> 
            <div class="form-group">
              <div class="radio-group">
              <?php while ($dadosmodulo = mysqli_fetch_assoc($resultmodulo)): ?>
                          <label class="radio-label">
                              <input
                                  type="radio"
                                  name="modulo"
                                  value="<?= $dadosmodulo['id'] ?>"
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
                ></textarea>
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
                        <input type="radio" name="status" value="inativo">
                        <span>Inativo</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="status" value="em-breve">
                        <span>Em Breve</span>
                    </label>
                </div>
            </div>
            <div>
                <div>
                <label>Selecione um video:</label><br>

                <input type="file" name="video" required id="video" accept="video/*">
                </div>
            </div>
            <div>
                <div>
                <label>Selecione o Conteúdo:</label><br>

                <input type="file" name="media" id="media" accept=".pdf, .pptx, .txt">
                </div>
            </div>
            <div>
                <div>
                <label>Selecione o Poster do curso (Resolução: 1980x1080):</label><br>

                <input type="file" name="arquivo" id="arquivo" accept=".jpg, .jpeg, .png">
                </div>
            </div>


            <!-- Botão de Envio -->
            <button type="submit" name='submit'>Cadastrar Aula</button>
            
        </form>
    </div>
</body>
</html>