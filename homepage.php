<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
  session_start();
  include_once("connection.php");
  $idaluno = $_SESSION['id'];
  if(!isset($_SESSION['email'])|| !isset($_SESSION['nome'])){
    header("Location:login.php");
  }
  $sqlmycourse = "SELECT * FROM cursoaluno WHERE idaluno = '$idaluno'";
  $sqlfreecourse = "SELECT * FROM curso WHERE tipo = 'gratis' AND statuscurso = 'ativo'";
  $resultmycourse = mysqli_query($conexao, $sqlmycourse);
  $resultfreecourse = mysqli_query($conexao, $sqlfreecourse);
  $resultfreecourse2 = mysqli_query($conexao, $sqlfreecourse);
  $dadosfreecourse = mysqli_fetch_assoc($resultfreecourse2);
  $idcategoria = $dadosfreecourse['idcategoria'];
  $sqlcategoria = "SELECT nome FROM categoria WHERE id ='$idcategoria'";
  $resultcategoria = mysqli_query($conexao, $sqlcategoria);
  $dadoscategoria = mysqli_fetch_assoc($resultcategoria);
  $resultfreecourse3 = mysqli_query($conexao, $sqlfreecourse);
  $sqlnovidades = "SELECT * FROM curso WHERE tipo ='gratis' AND statuscurso = 'ativo' ORDER BY datacadastro DESC";
  $resultnovidades = mysqli_query($conexao, $sqlnovidades);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GoStay</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
   <?php require_once __DIR__ . '/functions/analytics.php'; ?>
  <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <style>
    :root {
      --navy-deep:   #050d1a;
      --navy-mid:    #071428;
      --navy-card:   #0b1c35;
      --navy-border: #122040;
      --blue-accent: #1a5cff;
      --blue-glow:   rgba(26, 92, 255, 0.18);
      --gold:        #f5c400;
      --gold-dark:   #c99a00;
      --white:       #ffffff;
      --white-80:    rgba(255,255,255,0.8);
      --white-40:    rgba(255,255,255,0.4);
      --white-10:    rgba(255,255,255,0.07);
      --text-body:   #afc0d8;
      --radius-card: 16px;
      --transition:  0.3s cubic-bezier(.4,0,.2,1);
      --nav-h: 80px;
      --accent: var(--blue-accent);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--navy-deep);
      color: var(--white);
      overflow-x: hidden;
      line-height: 1.6;
    }

    img { display: block; width: 100%; object-fit: cover; }
    a { text-decoration: none; color: inherit; }

    .container {
      width: min(1200px, 92vw);
      margin: 0 auto;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.6;
    }

    /* =============================
       HEADER / NAV (igual ao index.php)
    ============================= */
    header {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 14px 0;
      background: rgba(5, 13, 26, 0.75);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--navy-border);
    }

    .nav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .nav-logo {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: 1.45rem;
      letter-spacing: -0.02em;
    }

    .nav-logo span.go, .logo span.go { color: var(--blue-accent); }
    .nav-logo span.stay, .logo span.stay { color: var(--white); }

    nav ul {
      display: flex;
      list-style: none;
      gap: 32px;
    }

    nav ul li a {
      font-size: 0.9rem;
      color: var(--white-80);
      transition: color var(--transition);
    }
    nav ul li a:hover { color: var(--white); }

    .nav-actions { display: flex; align-items: center; gap: 16px; }

    .nav-user {
      font-size: 0.85rem;
      color: var(--text-body);
      white-space: nowrap;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 13px 30px;
      border-radius: 999px;
      font-family: 'DM Sans', sans-serif;
      font-weight: 500;
      font-size: 0.95rem;
      cursor: pointer;
      transition: var(--transition);
      border: none;
    }

    .btn-gold { background: var(--gold); color: var(--navy-deep); }
    .btn-gold:hover {
      background: var(--gold-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(245,196,0,0.35);
    }

    .btn-outline {
      background: transparent;
      color: var(--white);
      border: 1.5px solid var(--white-40);
    }
    .btn-outline:hover {
      border-color: var(--white-80);
      background: var(--white-10);
    }

    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 4px;
    }
    .hamburger span {
      display: block;
      width: 24px; height: 2px;
      background: var(--white);
      border-radius: 2px;
      transition: var(--transition);
    }

    /* =============================
       SECTION LABEL / TITLE
    ============================= */
    .section-label {
      font-family: 'Josefin Sans', sans-serif;
      font-size: 0.7rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--blue-accent);
      margin-bottom: 8px;
    }

    .section-title {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: clamp(1.8rem, 4vw, 3rem);
      line-height: 1.15;
    }

    /* =============================
       HERO
    ============================= */
    .hero {
      position: relative;
      width: 100%;
      min-height: clamp(520px, 82vh, 780px);
      display: flex;
      align-items: center;
      padding-top: var(--nav-h);
      overflow: hidden;
    }

    .hero-bg {
      position: absolute; inset: 0;
      background:
        linear-gradient(160deg,
          rgba(5,13,26,.92) 0%,
          rgba(7,20,40,.7) 45%,
          rgba(5,13,26,.35) 100%),
        url('<?php echo("creates/" . $dadosfreecourse['posterft']); ?>') center/cover no-repeat;
      transform: scale(1.04);
      animation: hero-zoom 18s ease-in-out infinite alternate;
    }

    @keyframes hero-zoom {
      0%   { transform: scale(1.04); }
      100% { transform: scale(1.14); }
    }

    .hero-gradient {
      position: absolute; inset: 0;
      background: linear-gradient(90deg, rgba(5,13,26,.85) 0%, rgba(5,13,26,.15) 60%, transparent 100%);
      z-index: 1;
    }

    .hero-gradient-bottom {
      position: absolute; bottom: 0; left: 0; right: 0;
      height: 220px;
      background: linear-gradient(to bottom, transparent, var(--navy-deep));
      z-index: 2;
    }

    .hero-content {
      position: relative;
      z-index: 3;
      width: min(1200px, 92vw);
      margin: 0 auto;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--white-10);
      border: 1px solid var(--navy-border);
      border-radius: 999px;
      padding: 6px 16px;
      font-size: 0.78rem;
      color: var(--text-body);
      margin-bottom: 22px;
    }

    .hero-badge::before {
      content: '';
      width: 6px; height: 6px;
      border-radius: 50%;
      background: var(--gold);
      display: inline-block;
    }

    .hero-title {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: clamp(2.2rem, 5vw, 4rem);
      line-height: 1.1;
      letter-spacing: -0.03em;
      margin-bottom: 16px;
      max-width: 720px;
    }

    .hero-meta {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.9rem;
      color: var(--text-body);
      margin-bottom: 18px;
    }

    .hero-genre { color: var(--gold); font-weight: 600; }
    .hero-sep { opacity: 0.5; }

    .hero-desc {
      color: var(--text-body);
      font-size: 1.02rem;
      max-width: 560px;
      margin-bottom: 34px;
      line-height: 1.7;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    .btn-primary {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 30px; border-radius: 999px;
      font-weight: 500; font-size: 0.95rem; cursor: pointer;
      transition: var(--transition); border: none;
      background: var(--gold); color: var(--navy-deep);
    }
    .btn-primary:hover {
      background: var(--gold-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(245,196,0,0.35);
    }

    .btn-ghost {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 30px; border-radius: 999px;
      font-weight: 500; font-size: 0.95rem; cursor: pointer;
      transition: var(--transition);
      background: transparent; color: var(--white);
      border: 1.5px solid var(--white-40);
    }
    .btn-ghost:hover {
      border-color: var(--white-80);
      background: var(--white-10);
    }

    /* =============================
       MAIN / SECTIONS
    ============================= */
    .main {
      position: relative;
      z-index: 1;
      background: var(--navy-deep);
    }

    .section, .section-destaques {
      padding: 56px 0;
    }

    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 22px;
    }

    .section-header .section-title {
      font-size: clamp(1.3rem, 2.4vw, 1.7rem);
    }

    .empty-msg {
      color: var(--text-body);
      font-size: 0.9rem;
      padding: 12px 0 24px;
      display: block;
    }

    /* =============================
       CARROSSEL
    ============================= */
    .carousel-wrapper { position: relative; }

    .carousel-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 5;
      width: 40px; height: 40px;
      border-radius: 50%;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      color: var(--white);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: var(--transition);
    }
    .carousel-btn:hover {
      border-color: var(--blue-accent);
      background: var(--blue-accent);
    }
    .carousel-btn.prev { left: -6px; }
    .carousel-btn.next { right: -6px; }

    .carousel-track-outer {
      overflow-x: auto;
      scroll-behavior: smooth;
      scrollbar-width: none;
      cursor: grab;
    }
    .carousel-track-outer::-webkit-scrollbar { display: none; }
    .carousel-track-outer:active { cursor: grabbing; }

    .carousel-track {
      display: flex;
      gap: 16px;
      padding: 4px 2px 8px;
      width: max-content;
    }

    /* =============================
       CARDS
    ============================= */
    .card-link { display: block; flex-shrink: 0; }

    .card {
      width: 220px;
      cursor: pointer;
    }

    .card-poster {
      position: relative;
      height: 130px;
      border-radius: 12px;
      overflow: hidden;
      background: linear-gradient(135deg, #0d1f30, #1a2a3a);
      border: 1px solid var(--navy-border);
      transition: var(--transition);
    }
    .card:hover .card-poster {
      border-color: var(--blue-accent);
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(26,92,255,0.18);
    }

    .card-poster img {
      width: 100%; height: 100%;
      object-fit: cover;
    }

    .card-title-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 10px 12px;
      background: linear-gradient(to top, rgba(5,13,26,0.92), transparent);
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--white);
    }

    .card-badge {
      padding: 3px 10px;
      border-radius: 999px;
      font-size: 0.68rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .card-badge.hot  { background: rgba(26,92,255,0.15); color: #7aabff; border: 1px solid rgba(26,92,255,0.3); }
    .card-badge.new  { background: rgba(245,196,0,0.15); color: var(--gold); border: 1px solid rgba(245,196,0,0.3); }

    .card-wide {
      width: 320px;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: var(--radius-card);
      overflow: hidden;
      transition: var(--transition);
      cursor: pointer;
    }
    .card-wide:hover {
      border-color: var(--blue-accent);
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(26,92,255,0.15);
    }

    .card-wide-img {
      width: 100%;
      height: 170px;
      object-fit: cover;
    }

    .card-wide-title-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 12px;
      background: linear-gradient(to top, rgba(5,13,26,0.88), transparent);
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--white);
    }

    .card-wide-body { padding: 14px 16px; }

    .card-wide-meta {
      font-size: 0.8rem;
      color: var(--text-body);
    }

    /* =============================
       FOOTER (igual ao index.php)
    ============================= */
    footer {
      background: var(--navy-deep);
      border-top: 1px solid var(--navy-border);
      padding: 64px 0 32px;
      position: relative;
      z-index: 1;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr 1fr;
      gap: 48px;
      padding-bottom: 48px;
      border-bottom: 1px solid var(--navy-border);
    }

    .footer-brand .logo {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 800;
      font-size: 1.6rem;
      margin-bottom: 14px;
    }

    .footer-brand p {
      font-size: 0.875rem;
      color: var(--text-body);
      line-height: 1.6;
      max-width: 260px;
      margin-bottom: 24px;
    }

    .footer-social { display: flex; gap: 10px; }

    .social-btn {
      width: 36px; height: 36px;
      border-radius: 8px;
      background: var(--white-10);
      border: 1px solid var(--navy-border);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white-80);
      transition: var(--transition);
      cursor: pointer;
    }
    .social-btn:hover {
      background: var(--blue-accent);
      border-color: var(--blue-accent);
      color: var(--white);
    }

    .footer-col h4 {
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 600;
      font-size: 0.85rem;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 20px;
    }

    .footer-col ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .footer-col ul li a {
      font-size: 0.875rem;
      color: var(--text-body);
      transition: color var(--transition);
    }
    .footer-col ul li a:hover { color: var(--white); }

    .footer-divider {
      border: none;
      height: 1px;
      background: var(--navy-border);
      margin: 0;
    }

    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 28px;
      font-size: 0.8rem;
      color: var(--white-40);
    }

    /* =============================
       RESPONSIVE
    ============================= */
    @media (max-width: 900px) {
      nav ul, .nav-actions { display: none; }
      nav ul.open {
        display: flex; flex-direction: column;
        position: fixed; inset: 64px 0 0 0;
        background: rgba(5,13,26,0.97);
        padding: 32px; gap: 24px; z-index: 99;
      }
      .hamburger { display: flex; }

      .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
    }

    @media (max-width: 600px) {
      .footer-top { grid-template-columns: 1fr; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
      .hero-actions { flex-direction: column; align-items: flex-start; }
      .carousel-btn { display: none; }
    }
  </style>
</head>
<body>

  <header>
    <div class="container nav-inner">
      <div class="nav-logo">
        <span class="go">Go</span><span class="stay">Stay</span>
      </div>
      <nav>
        <ul id="nav-menu">
          <li><a href="#destaques">Destaques</a></li>
          <li><a href="#gratuitos">Gratuitos</a></li>
          <li><a href="#cursos">Meus Cursos</a></li>
        </ul>
      </nav>
      <div class="nav-actions">
        <span class="nav-user">Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
        <a href="logout.php" class="btn btn-outline" style="padding:10px 22px;font-size:.85rem;">Sair</a>
      </div>
      <div class="hamburger" id="hamburger" aria-label="Menu" role="button" tabindex="0">
        <span></span><span></span><span></span>
      </div>
    </div>
  </header>

  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-gradient"></div>
    <div class="hero-gradient-bottom"></div>
    <div class="hero-content">
      <div class="hero-badge">Em destaque agora</div>
      <h1 class="hero-title"><span><?php echo($dadosfreecourse['nome']); ?></span></h1>
      <div class="hero-meta">
        <span class="hero-genre"><?php echo($dadoscategoria['nome']); ?></span>
        <span class="hero-sep">·</span>
        <span class="hero-duration"><?php echo($dadosfreecourse['cargahoraria']); ?>H</span>
      </div>
      <p class="hero-desc">
        <?php echo($dadosfreecourse['descricao']); ?>
      </p>
      <div class="hero-actions">
        <a href="infos.php?trackid=<?php echo($dadosfreecourse['id']); ?>" class="btn-primary">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Assistir
        </a>
        <a href="infos.php?trackid=<?php echo($dadosfreecourse['id']); ?>" class="btn-ghost">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          Mais Informações
        </a>
      </div>
    </div>
  </section>

  <main class="main">

    <!-- DESTAQUES -->
    <section id="destaques" class="section-destaques">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Destaques</h2>
        </div>
        <div class="carousel-wrapper" id="carousel-hot">
          <button class="carousel-btn prev" onclick="scrollCarousel('carousel-hot', -1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <div class="carousel-track-outer">
            <div class="carousel-track">
            <?php
              while($dadosfreecourse2 = mysqli_fetch_assoc($resultfreecourse)):
            ?>
              <a class="card-link" href="infos.php?trackid=<?php echo($dadosfreecourse2['id']); ?>">
                <div class="card">
                  <div class="card-poster">
                    <img src="<?php echo("creates/". $dadosfreecourse2['ftcurso']); ?>" alt="imagem do curso" loading="lazy"/>
                    <div class="card-title-overlay"><span><?php echo($dadosfreecourse2['nome']); ?></span></div>
                  </div>
                </div>
              </a>
              <?php endwhile; ?>
            </div>
          </div>
          <button class="carousel-btn next" onclick="scrollCarousel('carousel-hot', 1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- GRATUITOS -->
    <section id="gratuitos" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Gratuitos</h2>
        </div>
        <div class="carousel-wrapper" id="carousel-rec">
          <button class="carousel-btn prev" onclick="scrollCarousel('carousel-rec', -1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <div class="carousel-track-outer">
            <div class="carousel-track">
            <?php
              while($dadosfreecourse3 = mysqli_fetch_assoc($resultfreecourse3)):
            ?>
              <a class="card-link" href="infos.php?trackid=<?php echo($dadosfreecourse3['id']); ?>">
                <div class="card">
                  <div class="card-poster">
                    <img src="<?php echo("creates/". $dadosfreecourse3['ftcurso']); ?>" alt="imagem do curso" loading="lazy"/>
                    <div class="card-title-overlay"><span><?php echo($dadosfreecourse3['nome']); ?></span></div>
                  </div>
                </div>
              </a>
              <?php endwhile; ?>
            </div>
          </div>
          <button class="carousel-btn next" onclick="scrollCarousel('carousel-rec', 1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- NOVIDADES -->
    <section id="novidades" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Novidades</h2>
        </div>
        <div class="carousel-wrapper" id="carousel-new">
          <button class="carousel-btn prev" onclick="scrollCarousel('carousel-new', -1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <div class="carousel-track-outer">
            <div class="carousel-track">
              <?php while($dadosnovidades = mysqli_fetch_assoc($resultnovidades)):
                        $idcategoria2 = $dadosnovidades['idcategoria'];
                        $sqlcategoria2 = "SELECT nome FROM categoria WHERE id ='$idcategoria2'";
                        $resultcategoria2 = mysqli_query($conexao, $sqlcategoria2);
                        $dadoscategoria2 = mysqli_fetch_assoc($resultcategoria2);
              ?>
              <a class="card-link" href="infos.php?trackid=<?php echo($dadosnovidades['id']); ?>">
                <div class="card-wide">
                  <div style="position:relative;overflow:hidden;">
                    <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                    <img class="card-wide-img" src="<?php echo("creates/". $dadosnovidades['posterft']) ?>" alt="imagem do curso" loading="lazy"/>
                    <div class="card-wide-title-overlay"><span><?php echo($dadosnovidades['nome']); ?></span></div>
                  </div>
                  <div class="card-wide-body">
                    <div class="card-wide-meta"><?php echo($dadosnovidades['cargahoraria']) ?>H · <?php echo($dadoscategoria2['nome']); ?></div>
                  </div>
                </div>
              </a>
              <?php endwhile; ?>
            </div>
          </div>
          <button class="carousel-btn next" onclick="scrollCarousel('carousel-new', 1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- MEUS CURSOS -->
    <section id="cursos" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Meus Cursos</h2>
        </div>
        <div class="carousel-wrapper" id="carousel-pop">
          <button class="carousel-btn prev" onclick="scrollCarousel('carousel-pop', -1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <div class="carousel-track-outer">
            <div class="carousel-track">
            <?php
              $numrows = mysqli_num_rows($resultmycourse);
              if($numrows == 0){
                echo('<span class="empty-msg">Você não tem nenhum curso</span>');
              }
              while($dadosmycourse = mysqli_fetch_assoc($resultmycourse)):
                $idcurso = $dadosmycourse['idcurso'];
                $sqlmycourse2 = "SELECT * FROM curso WHERE id = '$idcurso'";
                $resultmycourse2 = mysqli_query($conexao, $sqlmycourse2);

                while($dadosmycourse2 = mysqli_fetch_assoc($resultmycourse2)):
            ?>
              <a class="card-link" href="infos.php?trackid=<?php echo($dadosmycourse2['id']); ?>">
                <div class="card">
                  <div class="card-poster">
                    <img src="<?php echo("creates/".$dadosmycourse2['ftcurso']); ?>" alt="imagem do curso" loading="lazy"/>
                    <div class="card-title-overlay"><span><?php echo($dadosmycourse2['nome']); ?></span></div>
                  </div>
                </div>
              </a>
            <?php
                endwhile;
              endwhile;
            ?>
            </div>
          </div>
          <button class="carousel-btn next" onclick="scrollCarousel('carousel-pop', 1)">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </section>

  </main>

  <footer>
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <div class="logo"><span class="go">Go</span><span class="stay">Stay</span></div>
          <p>Seu universo de entretenimento e aprendizado. Conteúdo de qualidade, disponível a qualquer hora, em qualquer lugar.</p>
          <div class="footer-social">
            <button class="social-btn" title="Twitter">
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
            </button>
            <button class="social-btn" title="Instagram">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01"/></svg>
            </button>
            <button class="social-btn" title="YouTube">
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg>
            </button>
          </div>
        </div>
        <div class="footer-col">
          <h4>Empresa</h4>
          <ul>
            <li><a href="#">Sobre nós</a></li>
            <li><a href="#">Carreiras</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Imprensa</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Suporte</h4>
          <ul>
            <li><a href="#">Central de ajuda</a></li>
            <li><a href="#">Contato</a></li>
            <li><a href="#">Status</a></li>
            <li><a href="#">Comunidade</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Legal</h4>
          <ul>
            <li><a href="#">Termos de uso</a></li>
            <li><a href="#">Privacidade</a></li>
            <li><a href="#">Cookies</a></li>
            <li><a href="#">Acessibilidade</a></li>
          </ul>
        </div>
      </div>
      <hr class="footer-divider"/>
      <div class="footer-bottom">
        <span class="footer-copy">© <span class="go" style="color:var(--blue-accent)">Go</span>Stay 2026. Todos os direitos reservados.</span>
        <div class="footer-badge">
          <span>developed by Lucas</span>
        </div>
      </div>
    </div>
  </footer>

  <script>
    /* --- Mobile nav toggle (igual ao index.php) --- */
    const hamburger = document.getElementById('hamburger');
    const navMenu   = document.getElementById('nav-menu');

    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('open');
    });

    /* --- Carousel arrow scroll --- */
    function scrollCarousel(wrapperId, dir) {
      const wrapper = document.getElementById(wrapperId);
      const outer = wrapper.querySelector('.carousel-track-outer');
      outer.scrollBy({ left: dir * outer.clientWidth * 0.75, behavior: 'smooth' });
    }

    /* --- Drag-to-scroll --- */
    document.querySelectorAll('.carousel-track-outer').forEach(el => {
      let isDown = false, startX, scrollLeft;
      el.addEventListener('mousedown', e => {
        isDown = true;
        startX = e.pageX - el.offsetLeft;
        scrollLeft = el.scrollLeft;
      });
      el.addEventListener('mouseleave', () => { isDown = false; });
      el.addEventListener('mouseup',    () => { isDown = false; });
      el.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        el.scrollLeft = scrollLeft - (e.pageX - el.offsetLeft - startX);
      });
    });
  </script>
</body>
</html>