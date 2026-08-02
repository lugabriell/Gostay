<?php        
require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/functions/headers.php";
session_start();
$_SESSION['tokenn1'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GoStay — A maior plataforma de Estética da América Latina</title>
<link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
<?php require_once __DIR__ . '/functions/analytics.php'; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg-0:#080c16;
    --bg-1:#0c1322;
    --bg-2:#121b2e;
    --bg-3:#182541;
    --line: rgba(255,255,255,0.08);
    --line-strong: rgba(255,255,255,0.16);
    --text-0:#f4f6fb;
    --text-1:#aab2c5;
    --text-2:#717c95;
    --yellow:#f2c230;
    --yellow-soft: rgba(242,194,48,0.14);
    --blue:#3f6bff;
    --blue-soft: rgba(63,107,255,0.16);
    --font-display:'Sora', sans-serif;
    --font-body:'Ubuntu', sans-serif;
    --radius-lg: 22px;
    --radius-md: 14px;
    --radius-sm: 8px;
  }
  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{
    margin:0;
    background:var(--bg-0);
    color:var(--text-0);
    font-family:var(--font-body);
    line-height:1.5;
    -webkit-font-smoothing:antialiased;
    overflow-x:hidden;
  }
  h1,h2,h3,h4{
    font-family:var(--font-display);
    margin:0;
    letter-spacing:-0.01em;
  }
  p{margin:0;}
  a{color:inherit;text-decoration:none;}
  img{max-width:100%;display:block;}
  .wrap{
    max-width:1180px;
    margin:0 auto;
    padding:0 32px;
  }
  ::selection{background:var(--yellow-soft); color:var(--yellow);}

  /* ---------- fade-on-scroll ---------- */
  .fade{
    opacity:0;
    transform:translateY(28px);
    transition:opacity .8s cubic-bezier(.2,.7,.2,1), transform .8s cubic-bezier(.2,.7,.2,1);
  }
  .fade.in{
    opacity:1;
    transform:translateY(0);
  }
  .fade-d1{transition-delay:.08s;}
  .fade-d2{transition-delay:.16s;}
  .fade-d3{transition-delay:.24s;}
  .fade-d4{transition-delay:.32s;}
  @media (prefers-reduced-motion: reduce){
    .fade{opacity:1;transform:none;transition:none;}
  }

  /* ---------- nav ---------- */
  header{
    position:fixed;
    top:0; left:0; right:0;
    z-index:100;
    background:rgba(8,12,22,0.78);
    backdrop-filter:blur(14px);
    border-bottom:1px solid transparent;
    transform:translateY(-100%);
    transition:transform .4s cubic-bezier(.2,.7,.2,1), border-color .3s;
  }
  header.header-visible{
    transform:translateY(0);
    border-bottom:1px solid var(--line);
  }
  .nav{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:18px 32px;
    max-width:1180px;
    margin:0 auto;
  }
  .logo{
    display:flex;
    align-items:center;
    gap:10px;
    font-family:var(--font-display);
    font-weight:700;
    font-size:19px;
  }
  .logo .dot{
    width:9px;height:9px;border-radius:50%;
    background:var(--yellow);
    box-shadow:0 0 14px var(--yellow);
  }
  .nav-links{
    display:flex;
    gap:34px;
    font-size:14.5px;
    color:var(--text-1);
  }
  .nav-links a{transition:color .2s;}
  .nav-links a:hover{color:var(--text-0);}
  .nav-cta{
    display:flex;
    align-items:center;
    gap:16px;
  }
  .btn{
    font-family:var(--font-body);
    font-weight:500;
    font-size:14px;
    padding:11px 22px;
    border-radius:999px;
    border:1px solid transparent;
    cursor:pointer;
    transition:transform .2s, box-shadow .2s, background .2s, border-color .2s;
    display:inline-flex;
    align-items:center;
    gap:8px;
  }
  .btn-primary{
    background:var(--yellow);
    color:#181205;
    font-weight:700;
  }
  .btn-primary:hover{transform:translateY(-2px); box-shadow:0 10px 24px rgba(242,194,48,0.28);}
  .btn-ghost{
    border-color:var(--line-strong);
    color:var(--text-0);
    background:transparent;
  }
  .btn-ghost:hover{border-color:var(--blue); color:var(--blue);}
  .eyebrow{
    display:inline-flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    font-weight:600;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:var(--yellow);
    margin-bottom:16px;
  }
  .eyebrow::before{
    content:'';
    width:16px;height:1px;
    background:var(--yellow);
  }

  /* ---------- hero / carousel section ---------- */
  .hero{
    position:relative;
    min-height:720px;
    display:flex;
    align-items:flex-end;
    overflow:hidden;
    padding:0;
  }
  .hero-carousel{
    position:absolute;
    inset:0;
    z-index:0;
    overflow:hidden;
  }
  .hero-carousel .track{ height:100%; }
  .hero-overlay{
    position:absolute;
    inset:0;
    z-index:1;
    pointer-events:none;
    background:
      linear-gradient(100deg, rgba(8,12,22,.95) 0%, rgba(8,12,22,.82) 30%, rgba(8,12,22,.35) 58%, rgba(8,12,22,.6) 100%),
      linear-gradient(0deg, rgba(8,12,22,.92) 0%, rgba(8,12,22,.05) 42%);
  }
  .hero-content{
    position:relative;
    z-index:2;
    width:100%;
    padding:160px 32px 76px;
  }
  .hero-content-inner{
    max-width:1180px;
    margin:0 auto;
  }
  .hero h1{
    font-size:clamp(36px, 5.2vw, 64px);
    font-weight:700;
    line-height:1.06;
    max-width:700px;
  }
  .hero h1 .accent{ color:var(--yellow); }
  .hero-sub{
    font-size:16px;
    color:var(--text-1);
    max-width:460px;
    margin-top:22px;
  }
  .hero-actions{
    display:flex;
    gap:14px;
    margin-top:32px;
  }
  .hero .carousel-dots{ bottom:32px; right:32px; }
  .hero .carousel-prev{ left:24px; }
  .hero .carousel-next{ right:24px; }

  /* ---------- números (seção própria) ---------- */
  .stats-section{
    background:var(--bg-1);
    border-top:1px solid var(--line);
    border-bottom:1px solid var(--line);
  }
  .stat-row{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
  }
  .stat-card{
    background:var(--bg-2);
    border:1px solid var(--line);
    border-radius:var(--radius-md);
    padding:28px 24px;
    text-align:left;
    transition:border-color .3s, transform .3s;
  }
  .stat-card:hover{border-color:var(--yellow); transform:translateY(-4px);}
  .stat-number{
    font-family:var(--font-display);
    font-size:36px;
    font-weight:700;
    display:block;
    color:var(--yellow);
    margin-bottom:6px;
  }
  .stat-card span{
    font-size:13.5px;
    color:var(--text-1);
  }

  .carousel{
    position:relative;
    border-radius:var(--radius-lg);
    overflow:hidden;
    border:1px solid var(--line);
    background:var(--bg-2);
    aspect-ratio: 16/10;
  }
  .track{
    display:flex;
    height:100%;
    transition:transform .7s cubic-bezier(.65,0,.35,1);
  }
  .slide{
    min-width:100%;
    height:100%;
    position:relative;
    display:flex;
    align-items:flex-end;
    padding:32px;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
  }
  .slide::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(180deg, rgba(8,12,22,0) 30%, rgba(8,12,22,0.92) 100%);
  }
  .slide-content{
    position:relative;
    z-index:2;
  }
  .slide-tag{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:11.5px;
    font-weight:600;
    letter-spacing:.1em;
    text-transform:uppercase;
    padding:6px 12px;
    border-radius:999px;
    background:var(--yellow-soft);
    color:var(--yellow);
    margin-bottom:14px;
  }
  .slide-content h3{
    font-size:26px;
    font-weight:700;
    margin-bottom:6px;
  }
  .slide-content p{
    color:var(--text-1);
    font-size:14.5px;
    max-width:320px;
  }
  .carousel-nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:40px;height:40px;
    border-radius:50%;
    background:rgba(8,12,22,0.55);
    border:1px solid var(--line-strong);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    z-index:5;
    transition:background .2s, border-color .2s;
    backdrop-filter:blur(6px);
  }
  .carousel-nav:hover{background:var(--blue); border-color:var(--blue);}
  .carousel-prev{left:16px;}
  .carousel-next{right:16px;}
  .carousel-dots{
    position:absolute;
    bottom:20px; right:24px;
    display:flex;
    gap:8px;
    z-index:5;
  }
  .dot{
    width:22px;height:4px;
    border-radius:4px;
    background:rgba(255,255,255,0.28);
    cursor:pointer;
    overflow:hidden;
    position:relative;
    transition:background .2s;
  }
  .dot.active{background:rgba(255,255,255,0.35);}
  .dot.active .dot-fill{
    animation:fillDot 5.5s linear forwards;
  }
  .dot-fill{
    position:absolute;
    inset:0;
    background:var(--yellow);
    width:0%;
  }
  @keyframes fillDot{ from{width:0%;} to{width:100%;} }

  /* ---------- generic section ---------- */
  section{
    padding:96px 0;
  }
  .section-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:24px;
    margin-bottom:48px;
  }
  .section-head h2{
    font-size:clamp(26px,3vw,36px);
    font-weight:700;
    max-width:560px;
  }
  .section-head p{
    color:var(--text-1);
    max-width:340px;
    font-size:14.5px;
  }
  .divider{
    border:none;
    border-top:1px solid var(--line);
  }

  /* ---------- autorais ---------- */
  .carousel.autorais-carousel{
    aspect-ratio: 21/9;
  }

  /* ---------- metodologia ---------- */
  .method-list{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
  }
  .method-card{
    background:var(--bg-2);
    border:1px solid var(--line);
    border-radius:var(--radius-md);
    padding:26px 22px;
    transition:border-color .3s, transform .3s;
  }
  .method-card:hover{border-color:var(--yellow); transform:translateY(-4px);}
  .method-num{
    font-family:var(--font-display);
    font-size:13px;
    color:var(--yellow);
    font-weight:700;
    margin-bottom:18px;
  }
  .method-card h4{
    font-size:17px;
    margin-bottom:10px;
  }
  .method-card p{
    font-size:13.5px;
    color:var(--text-1);
  }

  /* ---------- professores (carrossel) ---------- */
  .teacher-carousel{
    position:relative;
  }
  .teacher-track{
    display:flex;
    gap:22px;
    overflow-x:auto;
    scroll-snap-type:x mandatory;
    scroll-behavior:smooth;
    padding-bottom:6px;
    -ms-overflow-style:none;
    scrollbar-width:none;
  }
  .teacher-track::-webkit-scrollbar{display:none;}
  .teacher-card{
    flex:0 0 260px;
    scroll-snap-align:start;
    border-radius:var(--radius-md);
    overflow:hidden;
    border:1px solid var(--line);
    background:var(--bg-2);
    transition:transform .3s, border-color .3s;
  }
  .teacher-card:hover{transform:translateY(-6px); border-color:var(--blue);}
  .teacher-photo{
    aspect-ratio:3/3.4;
    background:var(--bg-3);
    position:relative;
    overflow:hidden;
  }
  .teacher-photo img{width:100%; height:100%; object-fit:cover;}
  .teacher-info{padding:18px 18px 22px;}
  .teacher-info h4{font-size:16px; margin-bottom:4px;}
  .teacher-info p{font-size:12.5px; color:var(--text-2);}
  .carousel-controls{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-bottom:20px;
  }
  .carousel-controls .carousel-nav{
    position:static;
    transform:none;
  }

  /* ---------- planos ---------- */
  .plans{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:22px;
  }
  .plan-card{
    background:var(--bg-2);
    border:1px solid var(--line);
    border-radius:var(--radius-lg);
    padding:32px 28px;
    display:flex;
    flex-direction:column;
    transition:transform .3s, border-color .3s;
  }
  .plan-card:hover{transform:translateY(-6px);}
  .plan-card.featured{
    border-color:var(--yellow);
    background:linear-gradient(180deg, var(--bg-3), var(--bg-2));
    box-shadow:0 24px 48px rgba(242,194,48,0.10);
  }
  .plan-tag{
    display:inline-flex;
    align-self:flex-start;
    font-size:11px;
    font-weight:700;
    letter-spacing:.08em;
    text-transform:uppercase;
    padding:6px 12px;
    border-radius:999px;
    background:var(--bg-3);
    color:var(--text-1);
    margin-bottom:18px;
  }
  .plan-card.featured .plan-tag{
    background:var(--yellow-soft);
    color:var(--yellow);
  }
  .plan-card h3{font-size:22px; margin-bottom:10px;}
  .plan-card > p.desc{
    color:var(--text-1);
    font-size:14px;
    margin-bottom:22px;
  }
  .plan-features{
    list-style:none;
    padding:0; margin:0 0 28px;
    display:flex;
    flex-direction:column;
    gap:12px;
  }
  .plan-features li{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:13.5px;
    color:var(--text-1);
  }
  .check{
    width:18px;height:18px;
    border-radius:50%;
    background:var(--blue-soft);
    color:var(--blue);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:11px;
    flex-shrink:0;
  }
  .plan-card.featured .check{background:var(--yellow-soft); color:var(--yellow);}
  .plan-card .btn{
    margin-top:auto;
    width:100%;
    justify-content:center;
  }

  /* ---------- parceiros (carrossel/marquee) ---------- */
  .partners-box{
    background:var(--bg-2);
    border:1px solid var(--line);
    border-radius:var(--radius-lg);
    padding:44px 0;
    overflow:hidden;
  }
  .partners-intro{
    padding:0 44px;
    margin-bottom:32px;
    max-width:520px;
  }
  .partners-intro p{
    color:var(--text-1);
    font-size:14px;
    margin-top:8px;
  }
  .marquee-mask{
    position:relative;
    -webkit-mask-image:linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
    mask-image:linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
  }
  .partner-track{
    display:flex;
    gap:16px;
    width:max-content;
    animation:marquee 22s linear infinite;
  }
  .partner-track:hover{animation-play-state:paused;}
  @keyframes marquee{
    from{transform:translateX(0);}
    to{transform:translateX(-50%);}
  }
  .partner-logo{
    background:var(--bg-3);
    border:1px solid var(--line);
    border-radius:var(--radius-sm);
    height:64px;
    min-width:150px;
    padding:0 24px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:var(--font-display);
    font-weight:700;
    color:var(--text-1);
    font-size:13px;
    letter-spacing:.03em;
    transition:border-color .3s, color .3s;
    flex-shrink:0;
  }
  .partner-logo:hover{border-color:var(--blue); color:var(--text-0);}

  /* ---------- sobre nós ---------- */
  .about-grid{
    display:grid;
    grid-template-columns:0.9fr 1.1fr;
    gap:60px;
    align-items:center;
  }
  .about-visual{
    aspect-ratio:1/1;
    border-radius:var(--radius-lg);
    background:var(--bg-2);
    border:1px solid var(--line);
    position:relative;
    overflow:hidden;
  }
  .about-visual video{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
  }
  .about-visual::after{
    content:'';
    position:absolute;
    inset:0;
    background:
      radial-gradient(circle at 30% 30%, rgba(242,194,48,0.18), transparent 55%),
      radial-gradient(circle at 70% 70%, rgba(63,107,255,0.22), transparent 55%);
    mix-blend-mode:screen;
    pointer-events:none;
  }
  .about-text p{
    color:var(--text-1);
    font-size:15px;
    margin-top:18px;
    max-width:520px;
  }
  .about-cols{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px;
    margin-top:32px;
  }
  .about-cols h4{
    font-size:15px;
    margin-bottom:8px;
    color:var(--text-0);
  }
  .about-cols p{
    font-size:13px;
    color:var(--text-2);
  }

  /* ---------- footer ---------- */
  footer{
    border-top:1px solid var(--line);
    padding:56px 0 32px;
  }
  .foot-top{
    display:flex;
    justify-content:space-between;
    gap:40px;
    padding-bottom:40px;
    border-bottom:1px solid var(--line);
    margin-bottom:24px;
  }
  .foot-cols{
    display:flex;
    gap:60px;
  }
  .foot-cols h5{
    font-size:12.5px;
    letter-spacing:.08em;
    text-transform:uppercase;
    color:var(--text-2);
    margin-bottom:14px;
  }
  .foot-cols a{
    display:block;
    font-size:13.5px;
    color:var(--text-1);
    margin-bottom:10px;
    transition:color .2s;
  }
  .foot-cols a:hover{color:var(--text-0);}
  .foot-bottom{
    display:flex;
    justify-content:space-between;
    font-size:12.5px;
    color:var(--text-2);
  }

  @media (max-width:900px){
    .method-list, .plans, .about-grid{
      grid-template-columns:1fr;
    }
    .method-list{grid-template-columns:1fr 1fr;}
    .stat-row{grid-template-columns:1fr 1fr;}
    .partners-intro{padding:0 24px;}
    .carousel.autorais-carousel{aspect-ratio:4/5;}
    .hero{min-height:560px;}
    .hero-content{padding:120px 20px 56px;}
    .hero .carousel-nav{display:none;}
    .nav-links{display:none;}
    .foot-top{flex-direction:column; gap:24px;}
    section{padding:64px 0;}
  }
</style>
</head>
<body>

<header>
  <div class="nav">
    <div class="logo">  <img src="assets/ACELERADOR DO POTENCIAL HUMANO (1).png"
         alt="gostay"
         style="height: 100px; width: auto; object-fit: contain; display: block;"></div>
    <nav class="nav-links">
      <a href="login.php">Início</a>
      <a href="login.php">Autorais</a>
      <a href="login.php">Metodologia</a>
      <a href="login.php">Professores</a>
      <a href="login.php">Planos</a>
      <a href="login.php">Sobre nós</a>
    </nav>
    <div class="nav-cta">
      <a class="btn btn-ghost" href="login.php">Já sou aluno</a>
      <a class="btn btn-primary" href="login.php">Começar agora</a>
    </div>
  </div>
</header>

<main>

  <!-- CARD PRINCIPAL -->
  <section id="hero" class="hero">

    <div class="hero-carousel" id="carousel">
      <div class="track" id="track">
        <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=1920&auto=format&fit=crop')"></div>
        <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1612531386530-97286d97c2d2?q=80&w=1920&auto=format&fit=crop')"></div>
        <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=1920&auto=format&fit=crop')"></div>
        <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1551601651-2a8555f1a136?q=80&w=1920&auto=format&fit=crop')"></div>
      </div>
    </div>
    <div class="hero-overlay"></div>

    <div class="carousel-nav carousel-prev" id="prev">&#8592;</div>
    <div class="carousel-nav carousel-next" id="next">&#8594;</div>
    <div class="carousel-dots" id="dots"></div>

    <div class="hero-content">
      <div class="hero-content-inner fade">
        <div class="eyebrow">Domine a estética profissional</div>
        <h1>A maior plataforma de<br><span class="accent">Estética</span> da América Latina</h1>
        <p class="hero-sub">Do básico ao avançado, reunimos conteúdo científico, prática clínica real e atualização constante em harmonização facial, corporal, capilar e muito mais.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="login.php">Conheça os planos</a>
          <a class="btn btn-ghost" href="login.php">Fale conosco</a>
        </div>
      </div>
    </div>
  </section>

  <section id="numeros" class="stats-section">
    <div class="wrap">
      <div class="section-head fade">
        <h2>Números que comprovam nosso impacto</h2>
        <p>Resultados construídos com ciência, prática e consistência ao longo dos anos.</p>
      </div>
      <div class="stat-row">
        <div class="stat-card fade fade-d1">
          <b class="stat-number" data-target="40" data-prefix="+" data-suffix=" mil">0 mil</b>
          <span>Alunos formados</span>
        </div>
        <div class="stat-card fade fade-d2">
          <b class="stat-number" data-target="120" data-prefix="+">0</b>
          <span>Aulas científicas</span>
        </div>
        <div class="stat-card fade fade-d3">
          <b class="stat-number" data-target="18">0</b>
          <span>Professores especialistas</span>
        </div>
        <div class="stat-card fade fade-d4">
          <b class="stat-number" data-target="4.9" data-decimals="1" data-suffix="/5">0/5</b>
          <span>Avaliação média</span>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- AUTORAIS -->
  <section id="autorais">
    <div class="wrap">
      <div class="section-head fade">
        <h2>Conteúdos autorais para acelerar sua carreira</h2>
        <p>Material técnico, planejamento e negócio, feito por quem vive a clínica todos os dias.</p>
      </div>

      <div class="fade fade-d1">
        <div class="carousel autorais-carousel" id="autoraisCarousel">
          <div class="track" id="autoraisTrack">

            <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1580281657702-257584239a55?q=80&w=1200&auto=format&fit=crop')">
              <div class="slide-content">
                <span class="slide-tag">Cursos online</span>
                <h3>Programas de Formação</h3>
                <p>Técnica, planejamento e negócio. Domine cada área que importa na sua carreira em estética.</p>
              </div>
            </div>

            <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1200&auto=format&fit=crop')">
              <div class="slide-content">
                <span class="slide-tag">Livro</span>
                <h3>Intercorrências em Procedimentos Estéticos</h3>
                <p>O livro que fica na sua mesa e salva sua carreira: protocolo completo para intercorrências.</p>
              </div>
            </div>

            <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=1200&auto=format&fit=crop')">
              <div class="slide-content">
                <span class="slide-tag">Ao vivo</span>
                <h3>Aulas e mentorias ao vivo</h3>
                <p>Tire dúvidas em tempo real com quem aplica os protocolos na prática todos os dias.</p>
              </div>
            </div>

            <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1587854692152-cbe660dbde88?q=80&w=1200&auto=format&fit=crop')">
              <div class="slide-content">
                <span class="slide-tag">Artigos</span>
                <h3>Biblioteca de artigos exclusivos</h3>
                <p>Estudos, cases clínicos e atualizações científicas produzidos pelo nosso corpo docente.</p>
              </div>
            </div>

          </div>

          <div class="carousel-nav carousel-prev" id="autoraisPrev">&#8592;</div>
          <div class="carousel-nav carousel-next" id="autoraisNext">&#8594;</div>
          <div class="carousel-dots" id="autoraisDots"></div>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- METODOLOGIA -->
  <section id="metodologia">
    <div class="wrap">
      <div class="section-head fade">
        <h2>Uma metodologia construída para a prática clínica real</h2>
        <p>Ciência, segurança e repetição — o caminho que consolida técnica em confiança.</p>
      </div>
      <div class="method-list">
        <div class="method-card fade fade-d1">
          <div class="method-num">Fundamentos</div>
          <h4>Base científica</h4>
          <p>Anatomia, farmacologia e biossegurança antes de qualquer agulha.</p>
        </div>
        <div class="method-card fade fade-d2">
          <div class="method-num">Demonstração</div>
          <h4>Protocolos ao vivo</h4>
          <p>Workshops presenciais com aplicação em pacientes reais.</p>
        </div>
        <div class="method-card fade fade-d3">
          <div class="method-num">Supervisão</div>
          <h4>Prática guiada</h4>
          <p>Cursos presenciais com acompanhamento especializado passo a passo.</p>
        </div>
        <div class="method-card fade fade-d4">
          <div class="method-num">Atualização</div>
          <h4>Formação contínua</h4>
          <p>Pós-graduação e conteúdo renovado conforme a estética evolui.</p>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- PROFESSORES -->
  <section id="professores">
    <div class="wrap">
      <div class="section-head fade">
        <h2>Aprenda com os melhores professores do Brasil</h2>
        <p>Especialistas que vivem a estética na teoria e na clínica.</p>
      </div>
      <div class="carousel-controls fade">
        <div class="carousel-nav" id="teacherPrev">&#8592;</div>
        <div class="carousel-nav" id="teacherNext">&#8594;</div>
      </div>
      <div class="teacher-carousel fade fade-d1">
        <div class="teacher-track" id="teacherTrack">
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?q=80&w=600&auto=format&fit=crop" alt="Wagner Baseggio"></div>
            <div class="teacher-info"><h4>Wagner Baseggio</h4><p>Doutor em odontologia e fundador da GoStay</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=600&auto=format&fit=crop" alt="Bel Guerra"></div>
            <div class="teacher-info"><h4>Bel Guerra</h4><p>Doutora, especialista em Estética Facial e Corporal</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=600&auto=format&fit=crop" alt="Guilherme Cattani"></div>
            <div class="teacher-info"><h4>Guilherme Cattani</h4><p>Advogado especialista em proteção jurídica para profissionais da estética</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1607990281513-2c110a25bd8c?q=80&w=600&auto=format&fit=crop" alt="Professora convidada"></div>
            <div class="teacher-info"><h4>Camila Duarte</h4><p>Especialista em bioestimuladores e preenchimento</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1620331311520-246422fd82f9?q=80&w=600&auto=format&fit=crop" alt="Professor convidado"></div>
            <div class="teacher-info"><h4>Rafael Menezes</h4><p>Especialista em estética corporal e capilar</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=600&auto=format&fit=crop" alt="Marina Costa"></div>
            <div class="teacher-info"><h4>Marina Costa</h4><p>Especialista em preenchimento labial e contorno facial</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=600&auto=format&fit=crop" alt="Diego Ferreira"></div>
            <div class="teacher-info"><h4>Diego Ferreira</h4><p>Mestre em anatomia facial aplicada à harmonização</p></div>
          </div>
          <div class="teacher-card">
            <div class="teacher-photo"><img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?q=80&w=600&auto=format&fit=crop" alt="Juliana Prado"></div>
            <div class="teacher-info"><h4>Juliana Prado</h4><p>Farmacêutica especialista em bioestimuladores de colágeno</p></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- PLANOS -->
  <section id="planos">
    <div class="wrap">
      <div class="section-head fade">
        <h2>Modelos de cobrança</h2>
        <p>Escolha o plano ideal para o seu ritmo de aprendizado e objetivos profissionais.</p>
      </div>
      <div class="plans">
        <div class="plan-card fade fade-d1">
          <span class="plan-tag">Básico</span>
          <h3>GoStay Starter</h3>
          <p class="desc">Ideal para quem está começando e quer explorar conteúdos essenciais com flexibilidade.</p>
          <ul class="plan-features">
            <li><span class="check">✓</span>Acesso a cursos selecionados</li>
            <li><span class="check">✓</span>Certificado digital</li>
            <li><span class="check">✓</span>Suporte por e-mail</li>
            <li><span class="check">✓</span>Atualizações mensais</li>
          </ul>
          <a class="btn btn-ghost" href="login.php">Conhecer</a>
        </div>
        <div class="plan-card featured fade fade-d2">
          <span class="plan-tag">★ Mais popular</span>
          <h3>GoStay Max</h3>
          <p class="desc">Grandes aulas, experiências imperdíveis e os melhores professores em um único plano.</p>
          <ul class="plan-features">
            <li><span class="check">✓</span>Acesso completo ao catálogo</li>
            <li><span class="check">✓</span>Certificados reconhecidos</li>
            <li><span class="check">✓</span>Mentoria ao vivo mensal</li>
            <li><span class="check">✓</span>Suporte prioritário 24/7</li>
            <li><span class="check">✓</span>Downloads para estudo offline</li>
          </ul>
          <a class="btn btn-primary" href="login.php">Conhecer</a>
        </div>
        <div class="plan-card fade fade-d3">
          <span class="plan-tag">Pro</span>
          <h3>GoStay Pro</h3>
          <p class="desc">Para profissionais que querem o máximo em crescimento acelerado e networking de alto nível.</p>
          <ul class="plan-features">
            <li><span class="check">✓</span>Tudo do Black</li>
            <li><span class="check">✓</span>Trilhas personalizadas com IA</li>
            <li><span class="check">✓</span>Acesso antecipado a lançamentos</li>
            <li><span class="check">✓</span>Comunidade exclusiva Pro</li>
          </ul>
          <a class="btn btn-ghost" href="login.php">Conhecer</a>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- CANAIS PARCEIROS -->
  <section id="parceiros">
    <div class="wrap">
      <div class="section-head fade">
        <h2>Canais e parceiros</h2>
        <p>Leve a GoStay para onde você estiver.</p>
      </div>
      <div class="partners-box fade fade-d1">
        <div class="partners-intro">
          <h3 style="font-size:22px;">Marcas e canais que caminham com a GoStay</h3>
          <p>Parceiros que apoiam nossos alunos com conteúdo, produtos e visibilidade profissional.</p>
        </div>
        <div class="marquee-mask">
          <div class="partner-track">
            <div class="partner-logo">Instagram</div>
            <div class="partner-logo">TikTok</div>
            <div class="partner-logo">YouTube</div>
            <div class="partner-logo">Profhilo</div>
            <div class="partner-logo">Expert</div>
            <div class="partner-logo">Clínica+</div>
            <div class="partner-logo">Instagram</div>
            <div class="partner-logo">TikTok</div>
            <div class="partner-logo">YouTube</div>
            <div class="partner-logo">Profhilo</div>
            <div class="partner-logo">Expert</div>
            <div class="partner-logo">Clínica+</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- SOBRE NÓS -->
  <section id="sobre">
    <div class="wrap">
      <div class="about-grid">
        <div class="about-visual fade">
          <video autoplay muted loop playsinline poster="https://images.unsplash.com/photo-1612531386530-97286d97c2d2?q=80&w=800&auto=format&fit=crop">
            <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4" type="video/mp4">
          </video>
        </div>
        <div class="about-text fade fade-d2">
          <div class="eyebrow">Sobre nós</div>
          <h2 style="font-size:clamp(24px,3vw,32px);">Aprenda com ciência. Aplique com segurança. Destaque-se na estética.</h2>
          <p>A GoStay nasceu para elevar o padrão da estética na América Latina, unindo rigor científico, prática clínica real e atualização constante em harmonização facial, corporal e capilar em uma única plataforma.</p>
          <div class="about-cols">
            <div>
              <h4>Missão</h4>
              <p>Formar profissionais seguros, técnicos e éticos em cada etapa da carreira.</p>
            </div>
            <div>
              <h4>Corpo docente</h4>
              <p>Especialistas que vivem a clínica e trazem experiência real para a sala de aula.</p>
            </div>
          </div>
          <div class="hero-actions" style="margin-top:28px;">
            <a class="btn btn-primary" href="login.php">Vá para a página de suporte</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<footer>
  <div class="wrap">
    <div class="foot-top">
      <div class="logo"> <img src="assets/ACELERADOR DO POTENCIAL HUMANO (1).png"
          alt="gostay"
          style="height: 140px; width: auto; object-fit: contain; display: block;"></div>
      <div class="foot-cols">
        <div>
          <h5>Plataforma</h5>
          <a href="login.php">Professores</a>
          <a href="login.php">Pesquisas</a>
          <a href="login.php">Conteúdos</a>
        </div>
        <div>
          <h5>Área do aluno</h5>
          <a href="login.php">Login</a>
          <a href="login.php">Suporte</a>
          <a href="login.php">Planos</a>
        </div>
        <div>
          <h5>Legal</h5>
          <a href="login.php">Termos de uso</a>
          <a href="login.php">Política de privacidade</a>
          <a href="login.php">Garantia de 7 dias</a>
        </div>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© 2026 GoStay — Todos os direitos reservados.</span>
      <span>Feito com Sora + Ubuntu</span>
    </div>
  </div>
</footer>

<script>
  // ---------- navbar aparece só ao rolar ----------
  const header = document.querySelector('header');
  function onScrollHeader(){
    if(window.scrollY > 40){
      header.classList.add('header-visible');
    } else {
      header.classList.remove('header-visible');
    }
  }
  window.addEventListener('scroll', onScrollHeader, { passive:true });
  onScrollHeader();

  // ---------- fade on scroll ----------
  const faders = document.querySelectorAll('.fade');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
  faders.forEach(el => io.observe(el));

  // ---------- contagem animada dos números ----------
  function animateStatNumber(el){
    const target = parseFloat(el.dataset.target);
    const decimals = el.dataset.decimals ? parseInt(el.dataset.decimals, 10) : 0;
    const prefix = el.dataset.prefix || '';
    const suffix = el.dataset.suffix || '';
    const duration = 1600;
    let start = null;

    function frame(ts){
      if(!start) start = ts;
      const progress = Math.min((ts - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const value = target * eased;
      el.textContent = prefix + value.toFixed(decimals) + suffix;
      if(progress < 1){
        requestAnimationFrame(frame);
      } else {
        el.textContent = prefix + target.toFixed(decimals) + suffix;
      }
    }
    requestAnimationFrame(frame);
  }

  const statObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        animateStatNumber(entry.target);
        statObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  document.querySelectorAll('.stat-number').forEach(el => statObserver.observe(el));

  // ---------- carousel (função reutilizável) ----------
  function setupCarousel({ trackId, dotsId, prevId, nextId, intervalMs }){
    const track = document.getElementById(trackId);
    const dotsWrap = document.getElementById(dotsId);
    const prevBtn = document.getElementById(prevId);
    const nextBtn = document.getElementById(nextId);
    const slides = Array.from(track.children);
    let index = 0;
    let timer;

    slides.forEach((_, i) => {
      const d = document.createElement('div');
      d.className = 'dot' + (i === 0 ? ' active' : '');
      d.innerHTML = '<span class="dot-fill"></span>';
      d.addEventListener('click', () => goTo(i));
      dotsWrap.appendChild(d);
    });
    const dots = Array.from(dotsWrap.children);

    function render(){
      track.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((d, i) => d.classList.toggle('active', i === index));
    }
    function goTo(i){
      index = (i + slides.length) % slides.length;
      render();
      restart();
    }
    function next(){ goTo(index + 1); }
    function prev(){ goTo(index - 1); }
    function restart(){
      clearInterval(timer);
      timer = setInterval(next, intervalMs);
    }

    nextBtn.addEventListener('click', next);
    prevBtn.addEventListener('click', prev);
    render();
    restart();
  }

  setupCarousel({ trackId:'track', dotsId:'dots', prevId:'prev', nextId:'next', intervalMs:5500 });
  setupCarousel({ trackId:'autoraisTrack', dotsId:'autoraisDots', prevId:'autoraisPrev', nextId:'autoraisNext', intervalMs:6500 });

  // ---------- carrossel de professores ----------
  const teacherTrack = document.getElementById('teacherTrack');
  const teacherPrev = document.getElementById('teacherPrev');
  const teacherNext = document.getElementById('teacherNext');

  function teacherStep(){
    const card = teacherTrack.querySelector('.teacher-card');
    if(!card) return 0;
    const style = getComputedStyle(teacherTrack);
    const gap = parseFloat(style.columnGap || style.gap || 22);
    return card.getBoundingClientRect().width + gap;
  }
  teacherNext.addEventListener('click', () => {
    teacherTrack.scrollBy({ left: teacherStep(), behavior: 'smooth' });
  });
  teacherPrev.addEventListener('click', () => {
    teacherTrack.scrollBy({ left: -teacherStep(), behavior: 'smooth' });
  });
</script>

</body>
</html>
