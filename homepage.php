<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover"/>
  <title>GoStay</title>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Lora:ital,wght@0,400;1,400&display=swap" rel="stylesheet"/>
  <style>
    /* =============================================
       RESET & CSS VARIABLES
    ============================================= */
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --blue-900: #0a1628;
      --blue-800: #0d1f3c;
      --blue-700: #102a52;
      --blue-600: #1a3a6e;
      --blue-500: #1e4d9b;
      --blue-400: #2563eb;
      --blue-300: #3b82f6;
      --blue-200: #93c5fd;
      --blue-100: #dbeafe;
      --blue-50:  #eff6ff;
      --white:    #ffffff;
      --gray-50:  #f8fafc;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-400: #94a3b8;
      --gray-600: #475569;
      --gray-800: #1e293b;
      --accent:   #38bdf8;
      --gold:     #fbbf24;

      --nav-h: 68px;
      --radius-sm: 8px;
      --radius-md: 14px;
      --radius-lg: 20px;
      --shadow-sm: 0 2px 8px rgba(30,77,155,.12);
      --shadow-md: 0 8px 32px rgba(30,77,155,.18);
      --shadow-lg: 0 20px 60px rgba(30,77,155,.25);
      --transition: .3s cubic-bezier(.4,0,.2,1);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Outfit', sans-serif;
      background: var(--white);
      color: var(--gray-800);
      overflow-x: hidden;
      -webkit-tap-highlight-color: transparent;
    }

    /* SCROLLBAR */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: var(--gray-100); }
    ::-webkit-scrollbar-thumb { background: var(--blue-300); border-radius: 99px; }

    /* =============================================
       NAVBAR
    ============================================= */
    .navbar {
      position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
      height: var(--nav-h);
      background: rgba(255,255,255,.92);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(37,99,235,.08);
      box-shadow: 0 1px 24px rgba(30,77,155,.08);
      display: flex; align-items: center;
      padding: 0 clamp(16px, 4vw, 48px);
      gap: 32px;
    }

    .nav-logo {
      font-size: 1.5rem; font-weight: 900; letter-spacing: -0.04em;
      color: var(--blue-500); text-decoration: none;
      white-space: nowrap; display: flex; align-items: center; gap: 6px;
      z-index: 1001;
    }
    .nav-logo .logo-dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: var(--accent); display: inline-block;
      box-shadow: 0 0 8px var(--accent);
      animation: pulse-dot 2s infinite;
    }
    @keyframes pulse-dot {
      0%,100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.4); opacity: .7; }
    }

    .nav-links {
      display: flex; align-items: center; gap: 4px;
      list-style: none; flex: 1;
    }
    .nav-links a {
      text-decoration: none; color: var(--gray-600);
      font-size: .9rem; font-weight: 500;
      padding: 6px 14px; border-radius: var(--radius-sm);
      transition: var(--transition);
      position: relative;
    }
    .nav-links a:hover, .nav-links a.active {
      color: var(--blue-400); background: var(--blue-50);
    }

    .nav-right { margin-left: auto; display: flex; align-items: center; gap: 12px; }

    /* Botão hambúrguer */
    .hamburger {
      display: none;
      flex-direction: column; justify-content: center; align-items: center;
      width: 40px; height: 40px; border: none; background: transparent;
      cursor: pointer; z-index: 1002; position: relative;
    }
    .hamburger span {
      display: block; width: 22px; height: 2px;
      background: var(--blue-500); border-radius: 2px;
      transition: var(--transition); margin: 3px 0;
    }
    .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
    .hamburger.active span:nth-child(2) { opacity: 0; }
    .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

    @media (max-width: 768px) {
      .hamburger { display: flex; }
      .nav-links {
        position: fixed; top: 0; right: 0; bottom: 0;
        width: 280px; max-width: 80vw;
        background: rgba(255,255,255,.96);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        flex-direction: column; align-items: flex-start;
        padding: 90px 24px 32px;
        gap: 8px;
        box-shadow: -10px 0 40px rgba(0,0,0,.12);
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(.4,0,.2,1);
        z-index: 1000;
        border-left: 1px solid rgba(37,99,235,.08);
      }
      .nav-links.open { transform: translateX(0); }
      .nav-links a { font-size: 1.1rem; padding: 12px 8px; width: 100%; }
    }

    /* =============================================
       HERO
    ============================================= */
    .hero {
      position: relative; width: 100%;
      height: clamp(400px, 60vh, 720px); /* reduzida em mobile */
      overflow: hidden; margin-top: var(--nav-h);
    }

    @media (min-width: 768px) {
      .hero { height: clamp(520px, 80vh, 780px); }
    }

    .hero-bg {
      position: absolute; inset: 0;
      background:
        linear-gradient(160deg,
          rgba(10,22,40,.85) 0%,
          rgba(30,77,155,.6) 40%,
          rgba(56,189,248,.25) 100%),
        url('creates/assets/69b01eb92964c.png') center/cover no-repeat;
      transform: scale(1.04);
      animation: hero-zoom 18s ease-in-out infinite alternate;
    }

    @keyframes hero-zoom {
      from { transform: scale(1.04); }
      to   { transform: scale(1.10); }
    }

    .hero-bg::after {
      content: '';
      position: absolute; inset: 0;
      background-image:
        linear-gradient(rgba(37,99,235,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37,99,235,.06) 1px, transparent 1px);
      background-size: 60px 60px;
    }

    .hero-gradient {
      position: absolute; inset: 0;
      background: linear-gradient(to right, rgba(10,22,40,.92) 0%, rgba(10,22,40,.7) 45%, rgba(10,22,40,.15) 100%);
    }
    .hero-gradient-bottom {
      position: absolute; bottom: 0; left: 0; right: 0; height: 200px;
      background: linear-gradient(to top, var(--white), transparent);
    }

    .hero-content {
      position: relative; z-index: 2;
      height: 100%; display: flex; flex-direction: column;
      justify-content: center; padding: 0 clamp(20px, 6vw, 80px);
      max-width: 680px;
    }

    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(56,189,248,.15); border: 1px solid rgba(56,189,248,.3);
      border-radius: 99px; padding: 5px 14px;
      color: var(--accent); font-size: .78rem; font-weight: 600;
      letter-spacing: .08em; text-transform: uppercase;
      margin-bottom: 16px; width: fit-content;
      backdrop-filter: blur(8px);
      animation: fadeUp .6s ease both; animation-delay: .1s;
    }
    .hero-badge::before {
      content: ''; width: 6px; height: 6px; border-radius: 50%;
      background: var(--accent); animation: pulse-dot 1.5s infinite;
    }

    .hero-title {
      font-size: clamp(2rem, 5vw, 4.2rem);
      font-weight: 900; line-height: 1.05;
      letter-spacing: -0.03em; color: var(--white);
      margin-bottom: 12px;
      text-shadow: 0 2px 24px rgba(0,0,0,.4);
      animation: fadeUp .6s ease both; animation-delay: .2s;
    }
    .hero-title span { color: var(--accent); }

    .hero-meta {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 12px;
      animation: fadeUp .6s ease both; animation-delay: .3s;
    }
    .hero-year, .hero-genre, .hero-duration {
      color: rgba(255,255,255,.65); font-size: .82rem; font-weight: 400;
    }
    .hero-sep { color: rgba(255,255,255,.3); }

    .hero-desc {
      font-size: clamp(.85rem, 1.4vw, 1rem);
      color: rgba(255,255,255,.75);
      line-height: 1.6; margin-bottom: 28px;
      font-family: 'Lora', serif; font-style: italic;
      animation: fadeUp .6s ease both; animation-delay: .4s;
    }

    .hero-actions {
      display: flex; gap: 12px; flex-wrap: wrap;
      animation: fadeUp .6s ease both; animation-delay: .5s;
    }

    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 26px; border-radius: var(--radius-sm);
      font-family: 'Outfit', sans-serif;
      font-size: .9rem; font-weight: 600;
      cursor: pointer; border: none; text-decoration: none;
      transition: var(--transition); white-space: nowrap;
    }
    .btn-primary {
      background: var(--blue-400); color: white;
      box-shadow: 0 4px 20px rgba(37,99,235,.45);
    }
    .btn-primary:hover {
      background: var(--blue-300); transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(37,99,235,.55);
    }
    .btn-ghost {
      background: rgba(255,255,255,.12); color: white;
      border: 1px solid rgba(255,255,255,.25);
      backdrop-filter: blur(8px);
    }
    .btn-ghost:hover {
      background: rgba(255,255,255,.22); transform: translateY(-2px);
    }

    @media (max-width: 480px) {
      .hero-actions { flex-direction: column; align-items: flex-start; }
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* =============================================
       MAIN & SECTIONS
    ============================================= */
    .main { padding: 0 0 64px; }

    .section {
      margin-top: 48px;
      animation: fadeUp .6s ease both;
    }

    .section-destaques { margin-top: 40px; }

    .section-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 clamp(16px, 4vw, 48px);
      margin-bottom: 16px;
    }

    .section-title {
      font-size: clamp(1.1rem, 2vw, 1.3rem);
      font-weight: 700; color: var(--gray-800);
      display: flex; align-items: center; gap: 10px;
    }
    .section-title::before {
      content: ''; display: block;
      width: 4px; height: 20px; border-radius: 99px;
      background: linear-gradient(to bottom, var(--blue-400), var(--accent));
    }

    /* =============================================
       CAROUSEL — CORRECTED
    ============================================= */
    .carousel-wrapper { position: relative; }

    .carousel-track-outer {
      overflow-x: auto;
      overflow-y: visible;
      padding: 8px clamp(16px, 4vw, 48px) 24px;
      scrollbar-width: none;
      scroll-behavior: smooth;
      cursor: grab;
      -webkit-overflow-scrolling: touch;
      scroll-snap-type: x proximity;
    }
    .carousel-track-outer:active { cursor: grabbing; }
    .carousel-track-outer::-webkit-scrollbar { display: none; }

    /* ✅ CORREÇÃO PRINCIPAL: flex + nowrap + width: max-content */
    .carousel-track {
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
      gap: 16px;
      width: max-content;
    }

    /* Arrow buttons */
    .carousel-btn {
      position: absolute; top: 50%; transform: translateY(-60%);
      z-index: 10; width: 44px; height: 44px; border-radius: 50%;
      border: none; cursor: pointer;
      background: white; color: var(--blue-500);
      box-shadow: var(--shadow-md);
      display: grid; place-items: center;
      transition: var(--transition);
      opacity: 0; pointer-events: none;
    }
    .carousel-wrapper:hover .carousel-btn { opacity: 1; pointer-events: auto; }
    .carousel-btn:hover { background: var(--blue-400); color: white; transform: translateY(-60%) scale(1.08); }
    .carousel-btn.prev { left: 8px; }
    .carousel-btn.next { right: 8px; }

    @media (max-width: 768px) {
      .carousel-btn { display: none; } /* em mobile usamos apenas deslize */
    }

    /* =============================================
       CARD (poster 2:3)
    ============================================= */
    a.card-link {
      text-decoration: none;
      color: inherit;
      display: block;
      flex-shrink: 0;
      scroll-snap-align: start;
    }

    .card {
      position: relative;
      width: clamp(140px, 18vw, 200px);
      border-radius: var(--radius-md);
      overflow: visible;
      cursor: pointer;
      transition: transform var(--transition);
    }

    a.card-link:hover .card {
      transform: scale(1.08) translateY(-6px);
      z-index: 20;
    }

    .card-poster {
      width: 100%;
      aspect-ratio: 2/3;
      border-radius: var(--radius-md);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      transition: box-shadow var(--transition);
      position: relative;
    }
    a.card-link:hover .card-poster { box-shadow: var(--shadow-lg); }

    .card-poster img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform var(--transition);
      display: block;
    }
    a.card-link:hover .card-poster img { transform: scale(1.05); }

    /* Title overlay */
    .card-title-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, rgba(10,22,40,.92) 0%, rgba(10,22,40,.5) 60%, transparent 100%);
      padding: 28px 10px 10px;
      border-radius: 0 0 var(--radius-md) var(--radius-md);
      z-index: 2;
    }
    .card-title-overlay span {
      display: -webkit-box;
      font-size: .75rem; font-weight: 700;
      color: white; line-height: 1.3;
      text-shadow: 0 1px 4px rgba(0,0,0,.6);
      overflow: hidden;
      -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    }

    /* Badge */
    .card-badge {
      position: absolute; top: 8px; left: 8px; z-index: 2;
      font-size: .65rem; font-weight: 700; letter-spacing: .06em;
      text-transform: uppercase; padding: 3px 8px; border-radius: 4px;
    }
    .card-badge.free { background: #10b981; color: white; }
    .card-badge.new  { background: var(--blue-400); color: white; }
    .card-badge.hot  { background: #ef4444; color: white; }

    /* =============================================
       WIDE CARD (16:9)
    ============================================= */
    a.card-link-wide {
      text-decoration: none; color: inherit;
      display: block; flex-shrink: 0;
      scroll-snap-align: start;
    }

    .card-wide {
      width: clamp(240px, 30vw, 340px);
      border-radius: var(--radius-md);
      overflow: hidden; cursor: pointer;
      box-shadow: var(--shadow-sm);
      transition: transform var(--transition), box-shadow var(--transition);
    }
    .card-wide:hover {
      transform: translateY(-6px) scale(1.03);
      box-shadow: var(--shadow-lg);
    }
    .card-wide-img {
      aspect-ratio: 16/9; width: 100%; object-fit: cover;
      display: block; transition: transform var(--transition);
    }
    .card-wide:hover .card-wide-img { transform: scale(1.06); }
    .card-wide-body {
      padding: 14px 16px;
      background: white;
      border: 1px solid var(--gray-200);
      border-top: none; border-radius: 0 0 var(--radius-md) var(--radius-md);
    }
    .card-wide-meta { font-size: .75rem; color: var(--gray-400); }

    .card-wide-title-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, rgba(10,22,40,.88) 0%, transparent 100%);
      padding: 32px 14px 12px;
      z-index: 2;
    }
    .card-wide-title-overlay span {
      font-size: .88rem; font-weight: 700; color: white;
      text-shadow: 0 1px 6px rgba(0,0,0,.5);
    }

    /* =============================================
       FOOTER
    ============================================= */
    footer {
      background: linear-gradient(135deg, var(--blue-900) 0%, var(--blue-800) 100%);
      color: rgba(255,255,255,.7);
      padding: 56px clamp(20px, 6vw, 80px) 32px;
    }

    .footer-top {
      display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 40px; margin-bottom: 48px;
    }
    @media (max-width: 768px) { .footer-top { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 480px) { .footer-top { grid-template-columns: 1fr; } }

    .footer-brand .logo {
      font-size: 1.6rem; font-weight: 900; color: white;
      letter-spacing: -.04em; margin-bottom: 12px; display: block;
    }
    .footer-brand p {
      font-size: .85rem; line-height: 1.65;
      color: rgba(255,255,255,.5); max-width: 240px;
    }
    .footer-social { display: flex; gap: 10px; margin-top: 20px; }
    .social-btn {
      width: 36px; height: 36px; border-radius: 8px;
      background: rgba(255,255,255,.08);
      display: grid; place-items: center;
      color: rgba(255,255,255,.6);
      transition: var(--transition); cursor: pointer; border: none;
    }
    .social-btn:hover { background: var(--blue-500); color: white; }

    .footer-col h4 {
      font-size: .78rem; font-weight: 700; letter-spacing: .1em;
      text-transform: uppercase; color: rgba(255,255,255,.4);
      margin-bottom: 16px;
    }
    .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .footer-col ul a {
      text-decoration: none; color: rgba(255,255,255,.6);
      font-size: .87rem; transition: var(--transition);
    }
    .footer-col ul a:hover { color: var(--accent); padding-left: 4px; }

    .footer-divider {
      border: none; border-top: 1px solid rgba(255,255,255,.08);
      margin-bottom: 24px;
    }
    .footer-bottom {
      display: flex; justify-content: space-between; align-items: center;
      flex-wrap: wrap; gap: 12px;
    }
    .footer-copy { font-size: .78rem; color: rgba(255,255,255,.3); }
    .footer-badge span {
      font-size: .7rem; padding: 3px 10px; border-radius: 4px;
      background: rgba(255,255,255,.07); color: rgba(255,255,255,.35);
    }

    /* Overlay para fechar menu mobile */
    .overlay {
      position: fixed; inset: 0; background: rgba(0,0,0,.3);
      z-index: 999; opacity: 0; pointer-events: none;
      transition: opacity .3s;
    }
    .overlay.active { opacity: 1; pointer-events: auto; }
  </style>
</head>
<body>
  <div class="overlay" id="overlay"></div>

  <nav class="navbar">
    <a href="#" class="nav-logo">
      Go<span style="color:var(--accent)">Stay</span>
      <span class="logo-dot"></span>
    </a>
    <ul class="nav-links" id="navLinks">
      <li><a href="#destaques">Destaques</a></li>
      <li><a href="#gratuitos">Autorais</a></li>
      <li><a href="#cursos">Meus Cursos</a></li>
    </ul>
    <div class="nav-right">
      <button class="hamburger" id="hamburger" aria-label="Abrir menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-gradient"></div>
    <div class="hero-gradient-bottom"></div>
    <div class="hero-content">
      <div class="hero-badge">Em destaque agora</div>
      <h1 class="hero-title"><span>Blue Hub</span></h1>
      <div class="hero-meta">
        <span class="hero-genre">Estética</span>
        <span class="hero-sep">·</span>
        <span class="hero-duration">30H</span>
      </div>
      <p class="hero-desc">O primeiro curso da plataforma Blue Hub</p>
      <div class="hero-actions">
        <a href="infos.php?trackid=1" class="btn btn-primary">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Assistir
        </a>
        <a href="infos.php?trackid=1" class="btn btn-ghost">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          Mais Informações
        </a>
      </div>
    </div>
  </section>

  <main class="main">

    <!-- DESTAQUES -->
    <section id="destaques" class="section-destaques">
      <div class="section-header">
        <h2 class="section-title">Destaques</h2>
      </div>
      <div class="carousel-wrapper" id="carousel-hot">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-hot', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <a class="card-link" href="infos.php?trackid=1">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69b01eb9286b1.png" loading="lazy" alt="Blue Hub"/>
                  <div class="card-title-overlay"><span>Blue Hub</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=5">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69f9f88e373cc.jpeg" loading="lazy" alt="Perfiloplastia 360º"/>
                  <div class="card-title-overlay"><span>Perfiloplastia 360º</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=6">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69f9f93f8aea1.jpeg" loading="lazy" alt="PROTOCOLO VITAL INJECT"/>
                  <div class="card-title-overlay"><span>PROTOCOLO VITAL INJECT</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=8">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69f9fb54559e9.png" loading="lazy" alt="Intraelite Traning"/>
                  <div class="card-title-overlay"><span>Intraelite Traning</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=9">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69fa01b3b834a.jpeg" loading="lazy" alt="INTERSAFE"/>
                  <div class="card-title-overlay"><span>INTERSAFE - INTERCORRÊNCIAS E SEGURANÇA CLÍNICA</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=10">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69fa053118a07.jpeg" loading="lazy" alt="LIPSLOGIC"/>
                  <div class="card-title-overlay"><span>LIPSLOGIC - Raciocinio Clínico em Preenchimento Labial</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=11">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69fa05c4d0712.png" loading="lazy" alt="Golden Tox"/>
                  <div class="card-title-overlay"><span>Golden Tox - O Caminho Dourado da Toxina Botulinica</span></div>
                </div>
              </div>
            </a>

          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-hot', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

    <!-- AUTORAIS -->
    <section id="gratuitos" class="section">
      <div class="section-header">
        <h2 class="section-title">Autorais</h2>
      </div>
      <div class="carousel-wrapper" id="carousel-rec">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-rec', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <a class="card-link" href="infos.php?trackid=1">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69b01eb9286b1.png" loading="lazy" alt="Blue Hub"/>
                  <div class="card-title-overlay"><span>Blue Hub</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=5">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69f9f88e373cc.jpeg" loading="lazy" alt="Perfiloplastia 360º"/>
                  <div class="card-title-overlay"><span>Perfiloplastia 360º</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=6">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69f9f93f8aea1.jpeg" loading="lazy" alt="PROTOCOLO VITAL INJECT"/>
                  <div class="card-title-overlay"><span>PROTOCOLO VITAL INJECT</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=8">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69f9fb54559e9.png" loading="lazy" alt="Intraelite Traning"/>
                  <div class="card-title-overlay"><span>Intraelite Traning</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=9">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69fa01b3b834a.jpeg" loading="lazy" alt="INTERSAFE"/>
                  <div class="card-title-overlay"><span>INTERSAFE - INTERCORRÊNCIAS E SEGURANÇA CLÍNICA</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=10">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69fa053118a07.jpeg" loading="lazy" alt="LIPSLOGIC"/>
                  <div class="card-title-overlay"><span>LIPSLOGIC - Raciocinio Clínico em Preenchimento Labial</span></div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=11">
              <div class="card">
                <div class="card-poster">
                  <img src="creates/assets/69fa05c4d0712.png" loading="lazy" alt="Golden Tox"/>
                  <div class="card-title-overlay"><span>Golden Tox - O Caminho Dourado da Toxina Botulinica</span></div>
                </div>
              </div>
            </a>

          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-rec', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

    <!-- NOVIDADES (wide cards) -->
    <section id="novidades" class="section">
      <div class="section-header">
        <h2 class="section-title">Novidades</h2>
      </div>
      <div class="carousel-wrapper" id="carousel-new">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-new', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <a class="card-link" href="infos.php?trackid=6">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69f9f93f8c2b4.jpeg" loading="lazy" alt="PROTOCOLO VITAL INJECT"/>
                  <div class="card-wide-title-overlay"><span>PROTOCOLO VITAL INJECT</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">18H - Estética</div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=8">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69f9fb54580ee.png" loading="lazy" alt="Intraelite Traning"/>
                  <div class="card-wide-title-overlay"><span>Intraelite Traning</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">12H - Estética</div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=9">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69fa01b3b9123.jpg" loading="lazy" alt="INTERSAFE"/>
                  <div class="card-wide-title-overlay"><span>INTERSAFE - INTERCORRÊNCIAS E SEGURANÇA CLÍNICA</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">12H - Estética</div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=10">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69fa053119c2b.jpeg" loading="lazy" alt="LIPSLOGIC"/>
                  <div class="card-wide-title-overlay"><span>LIPSLOGIC - Raciocinio Clínico em Preenchimento Labial</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">22H - Estética</div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=11">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69fa05c4d32bf.png" loading="lazy" alt="Golden Tox"/>
                  <div class="card-wide-title-overlay"><span>Golden Tox - O Caminho Dourado da Toxina Botulinica</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">12H - Estética</div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=5">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69f9f88e38637.jpeg" loading="lazy" alt="Perfiloplastia 360º"/>
                  <div class="card-wide-title-overlay"><span>Perfiloplastia 360º</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">20H - Estética</div>
                </div>
              </div>
            </a>

            <a class="card-link" href="infos.php?trackid=1">
              <div class="card-wide">
                <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                  <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                  <img class="card-wide-img" src="creates/assets/69b01eb92964c.png" loading="lazy" alt="Blue Hub"/>
                  <div class="card-wide-title-overlay"><span>Blue Hub</span></div>
                </div>
                <div class="card-wide-body">
                  <div class="card-wide-meta">30H - Estética</div>
                </div>
              </div>
            </a>

          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-new', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

    <!-- MEUS CURSOS -->
    <section id="cursos" class="section">
      <div class="section-header">
        <h2 class="section-title">Meus Cursos</h2>
      </div>
      <div class="carousel-wrapper" id="carousel-pop">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-pop', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">
            <!-- cursos do usuário aqui -->
          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-pop', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <span class="logo">Go Stay<span style="color:var(--accent)">.</span></span>
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
      <span class="footer-copy">© 2026 Go Stay. Todos os direitos reservados.</span>
      <div class="footer-badge">
        <span>developted by Lucas</span>
      </div>
    </div>
  </footer>

  <script>
    // Menu mobile
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const overlay = document.getElementById('overlay');

    function toggleMenu() {
      hamburger.classList.toggle('active');
      navLinks.classList.toggle('open');
      overlay.classList.toggle('active');
      document.body.style.overflow = navLinks.classList.contains('open') ? 'hidden' : '';
    }

    hamburger.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);

    // Fecha menu ao clicar em um link
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        if (navLinks.classList.contains('open')) toggleMenu();
      });
    });

    // Carousel scroll
    function scrollCarousel(wrapperId, dir) {
      const wrapper = document.getElementById(wrapperId);
      const outer = wrapper.querySelector('.carousel-track-outer');
      outer.scrollBy({ left: dir * outer.clientWidth * 0.75, behavior: 'smooth' });
    }

    // Suporte a arraste (mouse + touch)
    document.querySelectorAll('.carousel-track-outer').forEach(el => {
      let isDown = false, startX, scrollLeft;

      function start(e) {
        isDown = true;
        const pageX = e.touches ? e.touches[0].pageX : e.pageX;
        startX = pageX - el.offsetLeft;
        scrollLeft = el.scrollLeft;
        el.style.cursor = 'grabbing';
      }

      function end() {
        isDown = false;
        el.style.cursor = 'grab';
      }

      function move(e) {
        if (!isDown) return;
        e.preventDefault();
        const pageX = e.touches ? e.touches[0].pageX : e.pageX;
        const x = pageX - el.offsetLeft;
        const walk = (x - startX) * 1.5;
        el.scrollLeft = scrollLeft - walk;
      }

      el.addEventListener('mousedown', start);
      el.addEventListener('mouseleave', end);
      el.addEventListener('mouseup', end);
      el.addEventListener('mousemove', move);

      el.addEventListener('touchstart', start, { passive: false });
      el.addEventListener('touchend', end);
      el.addEventListener('touchmove', move, { passive: false });
    });
  </script>
</body>
</html>