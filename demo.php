<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ids Educacional - Demonstração</title>
<link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (2).png" type="image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --navy: #003366;
    --navy-deep: #001d3d;
    --navy-light: #0a4d8c;
    --yellow: #FFE135;
    --yellow-soft: rgba(255,225,53,0.16);
    --glass: rgba(255,255,255,0.08);
    --glass-border: rgba(255,255,255,0.18);
    --ink: #f4f7fb;
    --muted: rgba(244,247,251,0.68);
  }

  *{ box-sizing: border-box; }

  html,body{
    margin:0; padding:0; height:100%;
    background: var(--navy-deep);
    font-family:'Inter', sans-serif;
    color: var(--ink);
    overflow-x:hidden;
    overflow-y:hidden;
  }

  /* ---------- scroll personalizado (amarelo) ---------- */
  .page{
    scrollbar-width: thin;
    scrollbar-color: var(--yellow) rgba(255,255,255,0.06);
  }
  .page::-webkit-scrollbar{
    width:10px;
  }
  .page::-webkit-scrollbar-track{
    background: rgba(255,255,255,0.05);
  }
  .page::-webkit-scrollbar-thumb{
    background: var(--yellow);
    border-radius:999px;
    border:2px solid transparent;
    background-clip: padding-box;
  }
  .page::-webkit-scrollbar-thumb:hover{
    background: #ffe95c;
    background-clip: padding-box;
  }

  .page{
    position:relative;
    height:100vh;
    overflow-y:auto;
    overflow-x:hidden;
    display:flex;
    flex-direction:column;
    padding: 0 0 48px 0;
    background:
      radial-gradient(circle at 12% 18%, rgba(255,225,53,0.10), transparent 40%),
      radial-gradient(circle at 85% 75%, rgba(10,77,140,0.55), transparent 45%),
      linear-gradient(160deg, var(--navy-deep) 0%, var(--navy) 55%, #012a54 100%);
  }

  /* ---------- navbar ---------- */
  .navbar{
    position:relative;
    z-index:3;
    display:flex;
    align-items:center;
    justify-content:space-between;
    width:100%;
    padding: 20px clamp(24px, 5vw, 64px);
    background: rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.10);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
  }

  .navbar .logo-slot{
    height:38px;
    display:flex;
    align-items:center;
  }
  .navbar .logo-slot img{
    height:100%;
    width:auto;
    max-width:180px;
    object-fit:contain;
    display:block;
  }

  .navbar .nav-tag{
    font-size:12px;
    letter-spacing:0.12em;
    text-transform:uppercase;
    color: var(--yellow);
    font-weight:600;
    border:1px solid rgba(255,225,53,0.35);
    padding:8px 16px;
    border-radius:999px;
  }

  .main-area{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    padding: 48px 24px;
  }

  /* orbes decorativos com leve flutuação, dão vida ao fundo glass */
  .orb{
    position:absolute;
    border-radius:50%;
    filter: blur(60px);
    opacity:0.55;
    pointer-events:none;
    animation: float 14s ease-in-out infinite;
  }
  .orb-1{ width:340px; height:340px; background: var(--yellow); top:-90px; left:-90px; opacity:0.18; }
  .orb-2{ width:260px; height:260px; background: var(--navy-light); bottom:-60px; right:-40px; animation-delay:-6s; }
  .orb-3{ width:180px; height:180px; background: var(--yellow); bottom:20%; left:6%; opacity:0.10; animation-delay:-3s; }

  @keyframes float{
    0%,100%{ transform: translateY(0px) translateX(0px); }
    50%{ transform: translateY(-24px) translateX(14px); }
  }

  .container{
    position:relative;
    z-index:2;
    width:100%;
    max-width:1120px;
    display:grid;
    grid-template-columns: 1.05fr 0.95fr;
    gap:64px;
    align-items:center;
  }

  /* ---------- coluna de texto ---------- */
  .eyebrow{
    display:inline-flex;
    align-items:center;
    gap:10px;
    font-size:12.5px;
    letter-spacing:0.16em;
    text-transform:uppercase;
    color: var(--yellow);
    font-weight:600;
    margin-bottom:26px;
  }
  .eyebrow::before{
    content:"";
    width:26px; height:1px;
    background: var(--yellow);
    display:inline-block;
  }

  h1{
    font-family:'Fraunces', serif;
    font-optical-sizing: auto;
    font-weight:500;
    font-size: clamp(2.1rem, 3.6vw, 3.15rem);
    line-height:1.15;
    letter-spacing:-0.01em;
    margin:0 0 24px 0;
    color: var(--ink);
  }
  h1 em{
    font-style: normal;
    color: var(--yellow);
    font-weight:500;
  }

  .lead{
    font-size:16.5px;
    line-height:1.7;
    color: var(--muted);
    max-width:460px;
    margin:0 0 40px 0;
  }

  /* ---------- card glass / formulário ---------- */
  .card{
    position:relative;
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 22px;
    padding: 42px 38px 38px 38px;
    backdrop-filter: blur(22px) saturate(140%);
    -webkit-backdrop-filter: blur(22px) saturate(140%);
    box-shadow:
      0 24px 60px rgba(0,10,30,0.45),
      inset 0 1px 0 rgba(255,255,255,0.12);
    overflow:hidden;
  }

  .card::before{
    content:"";
    position:absolute;
    top:-40%; left:-20%;
    width:70%; height:180%;
    background: linear-gradient(120deg, rgba(255,225,53,0.10), transparent 60%);
    pointer-events:none;
  }

  .card-title{
    font-family:'Fraunces', serif;
    font-weight:500;
    font-size:1.35rem;
    margin:0 0 6px 0;
    color: var(--ink);
    position:relative;
  }
  .card-sub{
    font-size:13.5px;
    color: var(--muted);
    margin:0 0 30px 0;
    position:relative;
  }

  form{ position:relative; display:flex; flex-direction:column; gap:18px; }

  .field{ display:flex; flex-direction:column; gap:8px; }

  .field label{
    font-size:12px;
    letter-spacing:0.05em;
    text-transform:uppercase;
    color: rgba(244,247,251,0.55);
    font-weight:600;
  }

  .field input,
  .field select{
    appearance:none;
    -webkit-appearance:none;
    width:100%;
    padding:13px 16px;
    font-family:'Inter', sans-serif;
    font-size:14.5px;
    color: var(--ink);
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.16);
    border-radius:11px;
    outline:none;
    transition: border-color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
  }

  .field input::placeholder{ color: rgba(244,247,251,0.35); }

  .field input:focus,
  .field select:focus{
    border-color: var(--yellow);
    background: rgba(255,255,255,0.10);
    box-shadow: 0 0 0 4px rgba(255,225,53,0.14);
  }

  .field select{
    color: rgba(244,247,251,0.9);
    cursor:pointer;
  }
  .field select option{
    background: var(--navy-deep);
    color: var(--ink);
  }

  /* botão com animação de brilho + leve pulso na borda */
  .submit-btn{
    position:relative;
    margin-top:10px;
    padding:15px 20px;
    border:none;
    border-radius:12px;
    background: var(--yellow);
    color: var(--navy-deep);
    font-family:'Inter', sans-serif;
    font-size:15px;
    font-weight:700;
    letter-spacing:0.01em;
    cursor:pointer;
    overflow:hidden;
    isolation:isolate;
    transition: transform 0.2s ease, box-shadow 0.3s ease;
    box-shadow: 0 10px 26px rgba(255,225,53,0.22);
  }

  .submit-btn::after{
    content:"";
    position:absolute;
    top:0; left:-60%;
    width:40%; height:100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.65), transparent);
    transform: skewX(-20deg);
    animation: shimmer 2.6s ease-in-out infinite;
  }

  @keyframes shimmer{
    0%{ left:-60%; }
    45%{ left:120%; }
    100%{ left:120%; }
  }

  .submit-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 14px 34px rgba(255,225,53,0.34);
  }
  .submit-btn:active{
    transform: translateY(0px) scale(0.99);
  }

  .fine-print{
    margin-top:16px;
    font-size:11.5px;
    color: rgba(244,247,251,0.42);
    text-align:center;
    position:relative;
  }

  /* ---------- responsivo ---------- */
  @media (max-width: 880px){
    .container{ grid-template-columns: 1fr; gap:44px; }
    .lead{ max-width:100%; }
    .card{ padding:34px 26px; }
    .navbar{ padding:16px 20px; }
  }

  @media (prefers-reduced-motion: reduce){
    .orb, .submit-btn::after{ animation:none; }
  }
</style>
</head>
<body>

<div class="page">
  <nav class="navbar">
    <div class="logo-slot">
      <!-- substitua o src abaixo pela URL/base64 da logo; a imagem se adapta à altura da navbar -->
      <img src="assets/ACELERADOR DO POTENCIAL HUMANO (2).png" alt="Logo">
    </div>
    <span class="nav-tag">Acesso antecipado</span>
  </nav>

  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

  <div class="main-area">
  <div class="container">
    <!-- coluna de texto -->
    <div class="intro">
      <span class="eyebrow">Bioestimulador</span>
      <h1>Preencha o formulário e <em>ASSISTA</em> a demonstração de bioestimulador.</h1>
      <p class="lead">
        Reserve alguns minutos e veja, na prática, como a solução se encaixa na sua rotina.
        Sem compromisso, sem burocracia — apenas os dados essenciais para liberarmos o seu acesso.
      </p>
    </div>

    <!-- card do formulário -->
    <div class="card">
      <h2 class="card-title">Solicitar demonstração</h2>
      <p class="card-sub">Preencha os campos abaixo para receber o acesso.</p>

      <form action="savedemo.php" method="POST">
        <div class="field">
          <label for="nome">Nome completo</label>
          <input type="text" id="nome" name="nome" maxlength="190" placeholder="Como podemos te chamar?">
        </div>

        <div class="field">
          <label for="whatsapp">WhatsApp</label>
          <input type="tel" id="whatsapp" name="whatsapp" maxlength="190" placeholder="(00) 00000-0000">
        </div>

        <div class="field">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" maxlength="190" placeholder="voce@empresa.com">
        </div>

        <div class="field">
            <label for="formacao">Formação</label>
            <input type="text" id="formacao" name="formacao" maxlength="190" placeholder="Ex.: Médico, Fisioterapeuta, Esteticista...">
        </div>

        <button type="submit" class="submit-btn">Quero ver a demonstração</button>
        <p class="fine-print">Seus dados estão seguros e não serão compartilhados.</p>
      </form>
    </div>
  </div>
  </div>
</div>

</body>
</html>
<!-- 
<title>Ids Educacional - Demonstração</title>
        <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">

<img src="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" alt="Logo">


        <div class="field">

        </div> -->