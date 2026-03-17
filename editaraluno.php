<?php
    include_once('connection.php');
    session_start();

    // if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    //     header('Location: index.html');
    //     session_unset();
    //     session_destroy();
    // }
    
    // else{
    //   $_SESSION['verificação'] = 'Ativo';
          
    // }
    $idaluno = $_GET['idaluno'];
    $sql = "SELECT * FROM alunos WHERE id = '$idaluno'";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);


?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Formulário Responsivo — Azul</title>
  <link rel="stylesheet" href="stylealunoform.css">
  <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
</head>
<body>
  <div class="navbar">
    <a href="index.html">Voltar</a>
  </div>
  <div class="container" role="region" aria-label="Formulário de contato responsivo">
    <section class="hero" aria-hidden="false">
      <div class="logo">
        <div class="logo-mark"><img src="assets/Design sem nome (33).png" class="logoimg" alt="logo"></div>
        <div>
          <div style="font-size:14px;">Formulário</div>
          <div style="font-size:12px;" class="small"></div>
        </div>
      </div>

      <h1>Fale com a gente</h1>
      <p>Preencha os dados para se tornar um Azul</p>

      <div class="accent-pill" aria-hidden="true">✓ Campos essenciais</div>
    </section>

    <form enctype="multipart/form-data" class="side" action="edit/editaluno.php" method="POST" id="contactForm" novalidate>
      <div>
        <label for="nome">Nome completo </label>
        <input id="nome" name="nome" value="<?php echo($dados['nome']); ?>"  minlength="1" maxlength="250" type="text" required placeholder="Seu nome" />
      </div>
      <input type="hidden" name="id" id="id" value="<?php echo($idaluno); ?>">



      <div class="row">
        <div class="field">
          <label for="email">E-mail *</label>
          <input id="email" name="email" value="<?php echo($dados['email']); ?>"   minlength="1" maxlength="250" type="email" required placeholder="seu@exemplo.com" />
        </div>
        <div class="field">
          <label for="telefone">Telefone</label>
          <input id="telefone" name="telefone" value="<?php echo($dados['telefone']); ?>"   minlength="1" maxlength="250" type="tel" required placeholder="(XX) XXXXX-XXXX" />
        </div>
      </div>
      <div>
        <div>
            <label for="senha">Senha </label>
            <input id="senha" name="senha"  minlength="1" maxlength="30" type="password"  required placeholder="Sua senha" />
        </div>
      </div>
      <div><div>
        <label for="datanas">Data de Nascimento</label>
        <input id="datanas" name="datanas" value="<?php echo($dados['datanascimento']); ?>"  type="date" required />
      </div></div>
      <div>
        <div>
          <label for="formacao">Formação</label>
          <input type="text" name="formacao" value="<?php echo($dados['formacao']); ?>"   minlength="1" maxlength="250" id="formacao" required placeholder="Sua formação aqui" />
        </div>

        <?php 
        if(isset($_SESSION['nameadm']) && $_SESSION['emailadm']){
          $tipo = 'radio';
        }else{
          $tipo = 'hidden';
        } ?>
        <br>
        <label>
          <input type="<?php echo($tipo); ?>" name="autenticado" id="autenticado" <?php if($dados['autenticado'] == 'sim') echo 'checked'; ?> value="sim" required>
          Autenticado
      </label>

      <label>
          <input type="radio" name="autenticado"  id="autenticado" <?php if($dados['autenticado'] == 'nao') echo 'checked'; ?> value="nao">
          Não autenticado
      </label>
      </div>
      <div>
        <div>
          <label>Selecione uma imagem:</label><br>

          <input type="file" name="arquivo" id="arquivo" accept="image/*" required>
        </div>
      </div>

      <div class="actions">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-ghost">Limpar</button>
        <div style="margin-left:auto;font-size:13px;color:rgba(255,255,255,0.7)">Tempo de resposta: <strong>até 48h</strong></div>
      </div>
    </form>
  </div>
</body>
</html>
