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
    <style>
        /* ===================================
           RESET E CONFIGURAÇÕES GLOBAIS
        =================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            line-height: 1.6;
        }

        /* ===================================
           CONTAINER PRINCIPAL DO FORMULÁRIO
        =================================== */
        .form-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 40px;
        }

        /* ===================================
           CABEÇALHO DO FORMULÁRIO
        =================================== */
        .form-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .form-header h1 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #7f8c8d;
            font-size: 14px;
        }

        /* ===================================
           ESTRUTURA DO FORMULÁRIO
        =================================== */
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ===================================
           GRUPOS DE CAMPOS (label + input)
        =================================== */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* ===================================
           LABELS DOS CAMPOS
        =================================== */
        label {
            color: #2c3e50;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        /* ===================================
           INPUTS E TEXTAREA - ESTILO BASE
        =================================== */
        input,
        textarea {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            font-family: inherit;
            color: #2c3e50;
            background: #f8f9fa;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            transition: all 0.3s ease;
            outline: none;
        }

        /* Textarea específico */
        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* ===================================
           ESTADOS DE INTERAÇÃO DOS INPUTS
        =================================== */
        
        /* Estado hover - quando o mouse passa sobre o campo */
        input:hover,
        textarea:hover {
            border-color: #c5d4e8;
            background: #ffffff;
        }

        /* Estado focus - quando o campo está selecionado */
        input:focus,
        textarea:focus {
            border-color: #4169E1;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(65, 105, 225, 0.1);
        }

        /* Placeholder com cor suave */
        input::placeholder,
        textarea::placeholder {
            color: #95a5a6;
        }

        /* ===================================
           CAMPOS RADIO BUTTONS
        =================================== */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #f8f9fa;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .radio-label:hover {
            border-color: #c5d4e8;
            background: #ffffff;
        }

        /* Radio button customizado */
        .radio-label input[type="radio"] {
            width: 18px;
            height: 18px;
            margin: 0;
            padding: 0;
            cursor: pointer;
            accent-color: #4169E1;
        }

        .radio-label span {
            color: #2c3e50;
            font-size: 15px;
        }

        /* Estado quando o radio está selecionado */
        .radio-label:has(input[type="radio"]:checked) {
            border-color: #4169E1;
            background: rgba(65, 105, 225, 0.05);
        }

        .radio-label:has(input[type="radio"]:checked) span {
            color: #4169E1;
            font-weight: 500;
        }

        /* ===================================
           INPUT TYPE DATE
        =================================== */
        input[type="date"] {
            cursor: pointer;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: opacity(0.6);
            transition: filter 0.3s ease;
        }

        input[type="date"]:hover::-webkit-calendar-picker-indicator {
            filter: opacity(1);
        }

        /* ===================================
           INPUT TYPE NUMBER
        =================================== */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* ===================================
           BOTÃO DE ENVIO
        =================================== */
        button[type="submit"] {
            width: 100%;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            color: #ffffff;
            background: #4169E1;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        /* Estado hover do botão */
        button[type="submit"]:hover {
            background: #2950c7;
            box-shadow: 0 6px 20px rgba(65, 105, 225, 0.3);
            transform: translateY(-2px);
        }

        /* Estado active do botão (quando clicado) */
        button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(65, 105, 225, 0.2);
        }

        /* ===================================
           RESPONSIVIDADE MOBILE
        =================================== */
        @media (max-width: 600px) {
            .form-container {
                padding: 28px 24px;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .form-header p {
                font-size: 13px;
            }

            input,
            textarea {
                font-size: 16px; /* Evita zoom no iOS */
            }

            button[type="submit"] {
                padding: 16px 24px;
            }

            .radio-label {
                padding: 14px 16px;
            }

            .radio-label span {
                font-size: 16px;
            }
        }

        /* ===================================
           ACESSIBILIDADE - MODO ESCURO
        =================================== */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            }

            .form-container {
                background: #2c3e50;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            }

            .form-header h1 {
                color: #ecf0f1;
            }

            .form-header p {
                color: #95a5a6;
            }

            label {
                color: #ecf0f1;
            }

            input,
            textarea {
                background: #34495e;
                border-color: #4a5f7f;
                color: #ecf0f1;
            }

            input:hover,
            textarea:hover {
                border-color: #5a7aa3;
                background: #3d566e;
            }

            input::placeholder,
            textarea::placeholder {
                color: #7f8c8d;
            }

            .radio-label {
                background: #34495e;
                border-color: #4a5f7f;
            }

            .radio-label:hover {
                border-color: #5a7aa3;
                background: #3d566e;
            }

            .radio-label span {
                color: #ecf0f1;
            }

            .radio-label:has(input[type="radio"]:checked) {
                border-color: #4169E1;
                background: rgba(65, 105, 225, 0.15);
            }

            .radio-label:has(input[type="radio"]:checked) span {
                color: #5a9cf8;
            }
        }
    </style>
</head>
<body>
    <!-- Container principal do formulário -->
    <div class="form-container">
        
        <!-- Cabeçalho do formulário -->
        <div class="form-header">
            <h1>Cadastro de Curso</h1>
            <p>Preencha as informações do curso abaixo</p>
        </div>

        <!-- Formulário -->
        <form action="creates/createcurso.php" enctype="multipart/form-data" method="POST">
            
            <!-- Campo Nome do Curso -->
            <div class="form-group">
                <label for="nome">Nome do Curso</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Digite o nome do curso"
                    required
                >
            </div>

            <!-- Campo Quantidade de Alunos -->
            <div class="form-group">
                <label for="qtd-alunos">Quantidade de Alunos</label>
                <input 
                    type="number" 
                    id="qtd-alunos" 
                    name="qtd-alunos" 
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


            <!-- Campo Quantidade de Módulos -->
            <div class="form-group">
                <label for="qtd-modulos">Quantidade de Módulos</label>
                <input 
                    type="number" 
                    id="qtd-modulos" 
                    name="qtd-modulos" 
                    placeholder="0"
                    min="1"
                    required
                >
            </div>

            <!-- Campo Quantidade de Aulas -->
            <div class="form-group">
                <label for="qtd-aulas">Quantidade de Aulas</label>
                <input 
                    type="number" 
                    id="qtd-aulas" 
                    name="qtd-aulas" 
                    placeholder="0"
                    min="1"
                    required
                >
            </div>

            <!-- Campo Carga Horária -->
            <div class="form-group">
                <label for="carga-horaria">Carga Horária (horas)</label>
                <input 
                    type="number" 
                    id="carga-horaria" 
                    name="carga-horaria" 
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
             <div class="form-group">
                <label>Tipo</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="tipo" value="pago" required>
                        <span>Pago</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="tipo" value="gratis">
                        <span>Gratuito</span>
                    </label>
                </div>
            </div>

            <!-- Campo Categoria (Radio) -->
            <div class="form-group">
              <label>Categoria</label>
              <div class="radio-group">

              <?php while ($dadoscategoria = mysqli_fetch_assoc($resultcategoria)): ?>
                          <label class="radio-label">
                              <input
                                  type="radio"
                                  name="categoria"
                                  value="<?= $dadoscategoria['id'] ?>"
                                  required
                              >
                              <span><?= htmlspecialchars($dadoscategoria['nome']) ?></span>
                          </label>
              <?php endwhile; ?>

              </div>
          </div>

            <!-- Campo Nível (Radio) -->
            <div class="form-group">
                <label>Nível</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="nivel" value="iniciante" required>
                        <span>Iniciante</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="nivel" value="intermediario">
                        <span>Intermediário</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="nivel" value="avancado">
                        <span>Avançado</span>
                    </label>
                </div>
            </div>

            <!-- Campo Data de Cadastro -->
            <div class="form-group">
                <label for="data-cadastro">Data de Cadastro</label>
                <input 
                    type="date" 
                    id="data-cadastro" 
                    name="data-cadastro" 
                    required
                >
            </div>
            <div>
                <div>
                <label>Selecione o Poster do curso (Resolução: 1080x1980):</label><br>

                <input type="file" name="arquivo" id="arquivo" accept=".jpg, .jpeg, .png">
                </div>
            </div>
            <div>
                <div>
                <label>Selecione o 2 Poster do curso (Resolução: 1920x1080):</label><br>

                <input type="file" name="arquivo2" id="arquivo2" accept=".jpg, .jpeg, .png">
                </div>
            </div>

            <!-- Botão de Envio -->
            <button type="submit">Cadastrar Curso</button>
            
        </form>
    </div>
</body>
</html>