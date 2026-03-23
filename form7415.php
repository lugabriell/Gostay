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
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>IdsEad</title>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <style>
    :root{
      --dark-blue: #0b3a72;
      --sky-blue:  #63c7ff;

      --radius: 12px;
      --glass: rgba(255,255,255,0.06);
    }

    *{box-sizing: border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background-color: var(--dark-blue);
      color:#fff;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
    }

    .container{
      width:100%;
      max-width:980px;
      background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
      border-radius:16px;
      box-shadow: 0 10px 30px rgba(11,58,114,0.25);
      overflow:hidden;
      display:grid;
      grid-template-columns: 1fr 420px;
      gap:0;
    }

    @media (max-width: 880px){
      .container{grid-template-columns:1fr;}
    }

    .hero{
      padding:36px;
      background: linear-gradient(180deg, rgba(99,167,255,0.04), rgba(11,58,114,0.02));
      display:flex;
      flex-direction:column;
      gap:16px;
      justify-content:center;
    }

    .hero h1{
      margin:0;
      font-size:28px;
      color:var(--sky-blue);
      letter-spacing: -0.4px;
    }
    .hero p{margin:0;color:rgba(255,255,255,0.85)}

    form{
      padding:28px;
      display:flex;
      flex-direction:column;
      gap:12px;
      background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
    }

    .row{display:flex;gap:12px}
    .row .field{flex:1}

    label{display:block;font-size:13px;color:rgba(255,255,255,0.85);margin-bottom:6px}

    input[type="text"], input[type="email"], input[type="tel"], select, textarea, input[type="password"]{
      width:100%;
      padding:12px 14px;
      border-radius:10px;
      border:1px solid rgba(255,255,255,0.06);
      background: rgba(255,255,255,0.02);
      color: #fff;
      font-size:15px;
      outline:none;
      transition: box-shadow .18s, border-color .12s, transform .12s;
    }
    input:focus, textarea:focus, select:focus{
      border-color: var(--sky-blue);
      box-shadow: 0 6px 20px rgba(99,167,255,0.14);
      transform: translateY(-1px);
    }

    textarea{min-height:110px;resize:vertical}

    .help{font-size:12px;color:rgba(255,255,255,0.6)}

    .actions{display:flex;gap:12px;align-items:center;margin-top:6px}

    .btn{
      border:0;
      padding:12px 18px;
      border-radius:10px;
      cursor:pointer;
      font-weight:600;
      font-size:15px;
      transition: transform .12s, box-shadow .12s;
      box-shadow: 0 6px 18px rgba(11,58,114,0.18);
    }
    .btn-primary{
      background: linear-gradient(90deg, var(--dark-blue), #154a87);
      color: #fff;
    }
    .btn-primary:hover{transform: translateY(-3px); box-shadow: 0 14px 30px rgba(11,58,114,0.28)}

    .btn-ghost{
      background:transparent;
      border:1px solid rgba(255,255,255,0.08);
      color:rgba(255,255,255,0.95);
    }

    .accent-pill{
      display:inline-flex;
      gap:10px;
      align-items:center;
      background:linear-gradient(90deg, rgba(99,199,255,0.12), rgba(11,58,114,0.06));
      padding:8px 12px;
      border-radius:999px;
      font-size:13px;
      border:1px solid rgba(99,199,255,0.08);
      color:var(--sky-blue);
      width:fit-content;
    }

    .side{
      background: linear-gradient(180deg, rgba(99,199,255,0.03), rgba(11,58,114,0.04));
      padding:24px;
      display:flex;
      flex-direction:column;
      gap:12px;
      align-items:stretch;
      justify-content:center;
    }
    .navbar {
        position: absolute;
        top: 15px;
        right: 20px;
    }

    .navbar a {
        text-decoration: none;
        background: #0b3a72;   
        color: #fff;
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s, transform 0.2s;
    }

    .navbar a:hover {
        background: #63c7ff;  
        color: #0b3a72;
        transform: translateY(-2px);
    }


    .logo{
      font-weight:700;
      color:var(--sky-blue);
      display:flex;
      gap:8px;
      align-items:center;
      letter-spacing:-0.6px;
    }
    .service{
        color: black;
    }

    .logo-mark{
      width:65px; 
      height:65px;
      border-radius:35px;
      display:inline-grid;
      place-items:center;

      box-shadow: 0 6px 18px rgba(11,58,114,0.2);
    }
    .logoimg{
        width:100%; 
        height:100%; 
        object-fit:cover; 
        border-radius:2px;
    }

    .small{font-size:13px;color:rgba(255,255,255,0.75)}

    @media (max-width:480px){
      .hero h1{font-size:20px}
      .container{border-radius:12px}
      .logo-mark{width:36px;height:36px}
    }

    .invalid{border-color:#ff6b6b !important; box-shadow: 0 6px 18px rgba(255,107,107,0.12)}

  </style>
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
      <p>Preencha os dados para se tornar um adm</p>

      <div class="accent-pill" aria-hidden="true">✓ Campos essenciais</div>
    </section>

    <form enctype="multipart/form-data" class="side" action="creates/createadm.php" method="POST" id="contactForm" novalidate>
      <div>
        <label for="nome">Nome completo </label>
        <input id="nome" name="nome" minlength="1" maxlength="250" type="text" required placeholder="Seu nome" />
      </div>

      <div class="row">
        <div class="field">
          <label for="email">E-mail *</label>
          <input id="email" name="email" type="email" minlength="1" maxlength="250" required placeholder="seu@exemplo.com" />
        </div>

      </div>
      <div>
        <div>
            <label for="senha">Senha </label>
            <input id="senha" name="senha" type="password"  required placeholder="Sua senha" />
        </div>
      </div>
      <div>
        <div>
          <label for="regiao">Região</label>
          <input type="text" name="regiao" id="regiao" required placeholder="Sua região aqui" />
        </div>
      </div>
      <div>
 

      <div class="actions">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-ghost">Limpar</button>
        <div style="margin-left:auto;font-size:13px;color:rgba(255,255,255,0.7)">Tempo de resposta: <strong>até 48h</strong></div>
      </div>
    </form>
  </div>
</body>
</html>
