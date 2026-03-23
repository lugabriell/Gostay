<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>StreamVibe — Seu universo de conteúdo</title>
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
    }

    /* =============================================
       SCROLLBAR
    ============================================= */
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
    .nav-links a.active::after {
      content: ''; position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%);
      width: 16px; height: 2px; background: var(--blue-400); border-radius: 99px;
    }

    .nav-right { margin-left: auto; display: flex; align-items: center; gap: 12px; }

    .nav-search-btn {
      width: 38px; height: 38px; border-radius: 50%;
      border: none; background: var(--blue-50); cursor: pointer;
      display: grid; place-items: center; color: var(--blue-400);
      transition: var(--transition);
    }
    .nav-search-btn:hover { background: var(--blue-100); transform: scale(1.05); }

    .nav-avatar {
      width: 38px; height: 38px; border-radius: 50%;
      background: linear-gradient(135deg, var(--blue-400), var(--accent));
      display: grid; place-items: center; cursor: pointer;
      font-weight: 700; color: white; font-size: .85rem;
      box-shadow: 0 2px 10px rgba(37,99,235,.35);
      transition: var(--transition);
    }
    .nav-avatar:hover { transform: scale(1.08); box-shadow: 0 4px 18px rgba(37,99,235,.45); }

    /* Hamburger */
    .nav-hamburger {
      display: none; flex-direction: column; gap: 5px;
      cursor: pointer; padding: 6px; border: none; background: none;
    }
    .nav-hamburger span {
      display: block; width: 22px; height: 2px;
      background: var(--blue-500); border-radius: 99px;
      transition: var(--transition);
    }

    /* Mobile nav toggle via checkbox hack */
    #mobile-nav-toggle { display: none; }
    #mobile-nav-toggle:checked ~ .mobile-nav { display: block; }

    @media (max-width: 768px) {
      .nav-links { display: none; }
      .nav-hamburger { display: flex; }
    }

    /* =============================================
       HERO / BANNER
    ============================================= */
    .hero {
      position: relative; width: 100%;
      height: clamp(520px, 80vh, 780px);
      overflow: hidden; margin-top: var(--nav-h);
    }

    .hero-bg {
      position: absolute; inset: 0;
      background:
        linear-gradient(160deg,
          rgba(10,22,40,.85) 0%,
          rgba(30,77,155,.6) 40%,
          rgba(56,189,248,.25) 100%),
        url('assets/thumb-1920-966117.jpg') center/cover no-repeat;
      transform: scale(1.04);
      animation: hero-zoom 18s ease-in-out infinite alternate;
    }
    @keyframes hero-zoom {
      from { transform: scale(1.04); }
      to   { transform: scale(1.10); }
    }

    /* grid overlay */
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
      background: linear-gradient(
        to right,
        rgba(10,22,40,.92) 0%,
        rgba(10,22,40,.7) 45%,
        rgba(10,22,40,.15) 100%
      );
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
      margin-bottom: 20px; width: fit-content;
      backdrop-filter: blur(8px);
    }
    .hero-badge::before {
      content: ''; width: 6px; height: 6px; border-radius: 50%;
      background: var(--accent); animation: pulse-dot 1.5s infinite;
    }

    .hero-title {
      font-size: clamp(2.2rem, 5vw, 4.2rem);
      font-weight: 900; line-height: 1.05;
      letter-spacing: -0.03em; color: var(--white);
      margin-bottom: 16px;
      text-shadow: 0 2px 24px rgba(0,0,0,.4);
    }
    .hero-title span { color: var(--accent); }

    .hero-meta {
      display: flex; align-items: center; gap: 12px;
      margin-bottom: 14px;
    }
    .hero-rating {
      background: var(--gold); color: var(--gray-800);
      font-size: .75rem; font-weight: 700; padding: 3px 8px;
      border-radius: 4px;
    }
    .hero-year, .hero-genre, .hero-duration {
      color: rgba(255,255,255,.65); font-size: .82rem; font-weight: 400;
    }
    .hero-sep { color: rgba(255,255,255,.3); }

    .hero-desc {
      font-size: clamp(.88rem, 1.4vw, 1rem);
      color: rgba(255,255,255,.75);
      line-height: 1.65; margin-bottom: 32px;
      font-family: 'Lora', serif; font-style: italic;
    }

    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 28px; border-radius: var(--radius-sm);
      font-family: 'Outfit', sans-serif;
      font-size: .92rem; font-weight: 600;
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

    /* =============================================
       MAIN CONTENT
    ============================================= */
    .main { padding: 0 0 64px; }

    /* =============================================
       SECTION
    ============================================= */
    .section {
      margin-top: 48px;
      opacity: 1;
      transform: translateY(0);
      animation: fadeUp .6s ease both;
    }
    .section:nth-child(1) { animation-delay: .1s; }
    .section:nth-child(2) { animation-delay: .2s; }
    .section:nth-child(3) { animation-delay: .3s; }
    .section:nth-child(4) { animation-delay: .4s; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .section-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 clamp(16px, 4vw, 48px);
      margin-bottom: 18px;
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

    .section-see-all {
      font-size: .82rem; font-weight: 600; color: var(--blue-400);
      text-decoration: none; display: flex; align-items: center; gap: 4px;
      transition: var(--transition);
    }
    .section-see-all:hover { color: var(--blue-300); gap: 8px; }

    /* =============================================
       CAROUSEL
    ============================================= */
    .carousel-wrapper { position: relative; }

    .carousel-track-outer {
      overflow-x: auto; overflow-y: visible;
      padding: 8px clamp(16px, 4vw, 48px) 24px;
      scrollbar-width: none;
      scroll-behavior: smooth;
      /* drag-to-scroll */
      cursor: grab;
    }
    .carousel-track-outer:active { cursor: grabbing; }
    .carousel-track-outer::-webkit-scrollbar { display: none; }

    .carousel-track {
      display: flex; gap: 16px;
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
      text-decoration: none;
    }
    .carousel-wrapper:hover .carousel-btn { opacity: 1; pointer-events: auto; }
    .carousel-btn:hover { background: var(--blue-400); color: white; transform: translateY(-60%) scale(1.08); }
    .carousel-btn.prev { left: 8px; }
    .carousel-btn.next { right: 8px; }

    /* card-link wrapper */
    a.card-link {
      text-decoration: none;
      color: inherit;
      display: block;
    }

    /* =============================================
       CARD
    ============================================= */
    .card {
      position: relative; flex-shrink: 0;
      width: clamp(140px, 18vw, 200px);
      border-radius: var(--radius-md);
      overflow: visible;
      cursor: pointer;
      transition: transform var(--transition), z-index 0s .3s;
    }
    .card:hover,
    a.card-link:hover .card {
      transform: scale(1.1) translateY(-8px);
      z-index: 20;
      transition: transform var(--transition), z-index 0s 0s;
    }

    a.card-link:hover .card-poster { box-shadow: var(--shadow-lg); }
    a.card-link:hover .card-poster img { transform: scale(1.05); }
    a.card-link:hover .card-tooltip {
      opacity: 1; transform: translateX(-50%) translateY(0) scale(1);
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
    .card:hover .card-poster { box-shadow: var(--shadow-lg); }

    .card-poster img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform var(--transition);
      display: block;
    }
    .card:hover .card-poster img { transform: scale(1.05); }

    /* HOVER TOOLTIP */
    .card-tooltip {
      position: absolute; bottom: calc(100% + 10px); left: 50%;
      transform: translateX(-50%) translateY(8px) scale(.95);
      width: clamp(180px, 24vw, 240px);
      background: white;
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-lg);
      padding: 14px;
      opacity: 0; pointer-events: none;
      transition: opacity var(--transition), transform var(--transition);
      z-index: 100;
      border: 1px solid var(--gray-200);
    }
    .card:hover .card-tooltip {
      opacity: 1; transform: translateX(-50%) translateY(0) scale(1);
    }
    .card-tooltip-title {
      font-size: .88rem; font-weight: 700; color: var(--gray-800);
      margin-bottom: 4px;
    }
    .card-tooltip-meta {
      display: flex; gap: 6px; align-items: center;
      font-size: .72rem; color: var(--gray-400); margin-bottom: 6px;
    }
    .card-tooltip-rating {
      color: var(--gold); font-size: .72rem; font-weight: 700;
    }
    .card-tooltip-desc {
      font-size: .75rem; color: var(--gray-600); line-height: 1.5;
      display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .card-tooltip-actions {
      display: flex; gap: 8px; margin-top: 10px;
    }
    .card-tooltip-btn {
      flex: 1; padding: 7px; border-radius: 6px; border: none;
      font-family: 'Outfit', sans-serif; font-size: .75rem; font-weight: 600;
      cursor: pointer; transition: var(--transition);
    }
    .card-tooltip-btn.play {
      background: var(--blue-400); color: white;
    }
    .card-tooltip-btn.play:hover { background: var(--blue-300); }
    .card-tooltip-btn.info {
      background: var(--gray-100); color: var(--gray-700);
    }
    .card-tooltip-btn.info:hover { background: var(--gray-200); }

    /* TITLE OVERLAY on poster */
    .card-title-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, rgba(10,22,40,.92) 0%, rgba(10,22,40,.5) 60%, transparent 100%);
      padding: 28px 10px 10px;
      border-radius: 0 0 var(--radius-md) var(--radius-md);
      z-index: 2;
    }
    .card-title-overlay span {
      display: block;
      font-size: .75rem; font-weight: 700;
      color: white; line-height: 1.3;
      text-shadow: 0 1px 4px rgba(0,0,0,.6);
      overflow: hidden; display: -webkit-box;
      -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    }

    /* TITLE OVERLAY on wide card */
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

    /* FREE badge */
    .card-badge {
      position: absolute; top: 8px; left: 8px; z-index: 2;
      font-size: .65rem; font-weight: 700; letter-spacing: .06em;
      text-transform: uppercase; padding: 3px 8px; border-radius: 4px;
    }
    .card-badge.free { background: #10b981; color: white; }
    .card-badge.new  { background: var(--blue-400); color: white; }
    .card-badge.hot  { background: #ef4444; color: white; }

    /* =============================================
       FEATURED ROW (wide cards)
    ============================================= */
    .card-wide {
      flex-shrink: 0;
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
    .card-wide-title { font-size: .9rem; font-weight: 700; color: var(--gray-800); margin-bottom: 4px; }
    .card-wide-meta { font-size: .75rem; color: var(--gray-400); }

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
    @media (max-width: 768px) {
      .footer-top { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 480px) {
      .footer-top { grid-template-columns: 1fr; }
    }

    .footer-brand .logo {
      font-size: 1.6rem; font-weight: 900; color: white;
      letter-spacing: -.04em; margin-bottom: 12px; display: block;
    }
    .footer-brand p {
      font-size: .85rem; line-height: 1.65;
      color: rgba(255,255,255,.5); max-width: 240px;
    }
    .footer-social {
      display: flex; gap: 10px; margin-top: 20px;
    }
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
    .footer-badge {
      display: flex; gap: 8px;
    }
    .footer-badge span {
      font-size: .7rem; padding: 3px 10px; border-radius: 4px;
      background: rgba(255,255,255,.07); color: rgba(255,255,255,.35);
    }

    /* =============================================
       PAGE LOAD ANIMATION
    ============================================= */
    .hero-badge  { animation: fadeUp .6s ease both; animation-delay: .1s; }
    .hero-title  { animation: fadeUp .6s ease both; animation-delay: .2s; }
    .hero-meta   { animation: fadeUp .6s ease both; animation-delay: .3s; }
    .hero-desc   { animation: fadeUp .6s ease both; animation-delay: .4s; }
    .hero-actions { animation: fadeUp .6s ease both; animation-delay: .5s; }

    /* =============================================
       MOBILE NAV DRAWER (CSS-only)
    ============================================= */
    .mobile-nav {
      display: none; position: fixed; inset: 0; z-index: 999;
      background: rgba(10,22,40,.7); backdrop-filter: blur(4px);
    }
    #mobile-nav-toggle:checked ~ .mobile-nav { display: block; }

    .mobile-nav-panel {
      position: absolute; top: 0; right: 0; bottom: 0; width: 260px;
      background: white;
      box-shadow: -10px 0 40px rgba(10,22,40,.3);
      padding: 80px 24px 32px;
      display: flex; flex-direction: column; gap: 8px;
    }
    .mobile-nav-panel a {
      text-decoration: none; color: var(--gray-700);
      font-size: 1rem; font-weight: 500; padding: 12px 16px;
      border-radius: var(--radius-sm); transition: var(--transition);
    }
    .mobile-nav-panel a:hover { background: var(--blue-50); color: var(--blue-400); }

    /* Close overlay click area */
    .mobile-nav-overlay {
      position: absolute; inset: 0;
    }
    .mobile-nav-close-label {
      position: absolute; inset: 0;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Mobile nav toggle (CSS-only) -->
  <input type="checkbox" id="mobile-nav-toggle" style="display:none"/>

  <!-- =============================================
       NAVBAR
  ============================================= -->
  <nav class="navbar">
    <a href="#" class="nav-logo">
      Stream<span style="color:var(--accent)">Vibe</span>
      <span class="logo-dot"></span>
    </a>

    <ul class="nav-links">
      <li><a href="#" class="active">Início</a></li>
      <li><a href="#">Destaques</a></li>
      <li><a href="#">Gratuitos</a></li>
      <li><a href="#">Meus Cursos</a></li>
    </ul>

    <div class="nav-right">
      <button class="nav-search-btn" aria-label="Buscar">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
      </button>
      <div class="nav-avatar" title="Meu Perfil">VR</div>
      <label for="mobile-nav-toggle" class="nav-hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </label>
    </div>
  </nav>

  <!-- Mobile Nav (CSS-only toggle) -->
  <div class="mobile-nav">
    <label for="mobile-nav-toggle" class="mobile-nav-close-label"></label>
    <div class="mobile-nav-panel">
      <a href="#">Início</a>
      <a href="#">Destaques</a>
      <a href="#">Gratuitos</a>
      <a href="#">Meus Cursos</a>
    </div>
  </div>

  <!-- =============================================
       HERO
  ============================================= -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-gradient"></div>
    <div class="hero-gradient-bottom"></div>
    <div class="hero-content">
      <div class="hero-badge">Em destaque agora</div>
      <h1 class="hero-title">Além do <span>Horizonte</span><br>Azul</h1>
      <div class="hero-meta">
        <span class="hero-rating">★ 9.2</span>
        <span class="hero-year">2024</span>
        <span class="hero-sep">·</span>
        <span class="hero-genre">Ficção Científica</span>
        <span class="hero-sep">·</span>
        <span class="hero-duration">2h 18min</span>
      </div>
      <p class="hero-desc">
        Uma jornada épica por mundos desconhecidos, onde a linha entre a realidade 
        e o sonho se desfaz. Uma tripulação corajosa enfrenta os maiores mistérios 
        do universo — e de si mesmos.
      </p>
      <div class="hero-actions">
        <button class="btn btn-primary">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Assistir
        </button>
        <button class="btn btn-ghost">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          Mais Informações
        </button>
      </div>
    </div>
  </section>

  <!-- =============================================
       MAIN CONTENT
  ============================================= -->
  <main class="main">

    <!-- DESTAQUES -->
    <section class="section">
      <div class="section-header">
        <h2 class="section-title">⭐ Destaques</h2>
        <a href="#" class="section-see-all">Ver tudo →</a>
      </div>
      <div class="carousel-wrapper" id="carousel-hot">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-hot', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <!-- Card 1 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge hot">Hot</span>
                <img src="https://picsum.photos/seed/101/300/450" alt="Luz Perdida" loading="lazy"/>
                <div class="card-title-overlay"><span>Luz Perdida</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Luz Perdida</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.4</span>
                  <span>2023</span><span>·</span><span>Drama</span>
                </div>
                <div class="card-tooltip-desc">Uma história emocionante sobre coragem, amizade e autodescoberta em tempos difíceis.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 2 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge new">Novo</span>
                <img src="https://picsum.photos/seed/202/300/450" alt="Sombras do Amanhã" loading="lazy"/>
                <div class="card-title-overlay"><span>Sombras do Amanhã</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Sombras do Amanhã</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 7.9</span>
                  <span>2024</span><span>·</span><span>Thriller</span>
                </div>
                <div class="card-tooltip-desc">Mundos paralelos colidem nesta aventura épica que desafia os limites da realidade.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 3 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <img src="https://picsum.photos/seed/303/300/450" alt="Eco do Silêncio" loading="lazy"/>
                <div class="card-title-overlay"><span>Eco do Silêncio</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Eco do Silêncio</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.1</span>
                  <span>2022</span><span>·</span><span>Ação</span>
                </div>
                <div class="card-tooltip-desc">Suspense intenso: cada decisão conta quando o relógio está sempre correndo.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 4 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge hot">Hot</span>
                <img src="https://picsum.photos/seed/404/300/450" alt="Horizonte Partido" loading="lazy"/>
                <div class="card-title-overlay"><span>Horizonte Partido</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Horizonte Partido</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 9.0</span>
                  <span>2024</span><span>·</span><span>Ficção Científica</span>
                </div>
                <div class="card-tooltip-desc">Uma jornada emocionante de redenção, amor e sacrifício em um mundo à beira do colapso.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 5 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <img src="https://picsum.photos/seed/505/300/450" alt="A Última Fronteira" loading="lazy"/>
                <div class="card-title-overlay"><span>A Última Fronteira</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">A Última Fronteira</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.7</span>
                  <span>2023</span><span>·</span><span>Animação</span>
                </div>
                <div class="card-tooltip-desc">Animação premiada que encanta crianças e adultos com sua beleza visual única.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
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

    <!-- GRATUITOS -->
    <section class="section">
      <div class="section-header">
        <h2 class="section-title">🎁 Gratuitos</h2>
        <a href="#" class="section-see-all">Ver tudo →</a>
      </div>
      <div class="carousel-wrapper" id="carousel-rec">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-rec', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <!-- Card 1 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge free">Grátis</span>
                <img src="https://picsum.photos/seed/601/300/450" alt="Névoa Azul" loading="lazy"/>
                <div class="card-title-overlay"><span>Névoa Azul</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Névoa Azul</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 7.5</span>
                  <span>2021</span><span>·</span><span>Comédia</span>
                </div>
                <div class="card-tooltip-desc">Uma comédia vibrante cheia de reviravoltas inesperadas e personagens memoráveis.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 2 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge free">Grátis</span>
                <img src="https://picsum.photos/seed/702/300/450" alt="Vento Norte" loading="lazy"/>
                <div class="card-title-overlay"><span>Vento Norte</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Vento Norte</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.2</span>
                  <span>2022</span><span>·</span><span>Documentário</span>
                </div>
                <div class="card-tooltip-desc">Documentário revelador que expõe os bastidores de um dos eventos mais marcantes do século.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 3 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge free">Grátis</span>
                <img src="https://picsum.photos/seed/803/300/450" alt="Código Vermelho" loading="lazy"/>
                <div class="card-title-overlay"><span>Código Vermelho</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Código Vermelho</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 7.8</span>
                  <span>2023</span><span>·</span><span>Terror</span>
                </div>
                <div class="card-tooltip-desc">Thriller psicológico onde nada é o que parece e cada resposta gera novas perguntas.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 4 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge free">Grátis</span>
                <img src="https://picsum.photos/seed/904/300/450" alt="Espelho Infinito" loading="lazy"/>
                <div class="card-title-overlay"><span>Espelho Infinito</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Espelho Infinito</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.6</span>
                  <span>2024</span><span>·</span><span>Drama</span>
                </div>
                <div class="card-tooltip-desc">Uma história emocionante sobre coragem, amizade e autodescoberta em tempos difíceis.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 5 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge free">Grátis</span>
                <img src="https://picsum.photos/seed/1005/300/450" alt="Terra Nova" loading="lazy"/>
                <div class="card-title-overlay"><span>Terra Nova</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Terra Nova</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 7.3</span>
                  <span>2022</span><span>·</span><span>Ação</span>
                </div>
                <div class="card-tooltip-desc">Suspense intenso: cada decisão conta quando o relógio está sempre correndo.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
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
    <section class="section">
      <div class="section-header">
        <h2 class="section-title">✨ Novidades</h2>
        <a href="#" class="section-see-all">Ver tudo →</a>
      </div>
      <div class="carousel-wrapper" id="carousel-new">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-new', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <!-- Wide Card 1 -->
            <a class="card-link" href="#">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                <img class="card-wide-img" src="https://picsum.photos/seed/111/640/360" alt="Pulsão" loading="lazy"/>
                <div class="card-wide-title-overlay"><span>Pulsão</span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta">★ 8.3 · 2024 · Ficção Científica</div>
              </div>
            </div>
            </a>

            <!-- Wide Card 2 -->
            <a class="card-link" href="#">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                <img class="card-wide-img" src="https://picsum.photos/seed/222/640/360" alt="Deriva" loading="lazy"/>
                <div class="card-wide-title-overlay"><span>Deriva</span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta">★ 7.6 · 2024 · Drama</div>
              </div>
            </div>
            </a>

            <!-- Wide Card 3 -->
            <a class="card-link" href="#">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <img class="card-wide-img" src="https://picsum.photos/seed/333/640/360" alt="Singularidade" loading="lazy"/>
                <div class="card-wide-title-overlay"><span>Singularidade</span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta">★ 9.1 · 2024 · Thriller</div>
              </div>
            </div>
            </a>

            <!-- Wide Card 4 -->
            <a class="card-link" href="#">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <span class="card-badge hot" style="position:absolute;top:8px;left:8px;z-index:2">Hot</span>
                <img class="card-wide-img" src="https://picsum.photos/seed/444/640/360" alt="Protocolo Ômega" loading="lazy"/>
                <div class="card-wide-title-overlay"><span>Protocolo Ômega</span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta">★ 8.8 · 2023 · Ação</div>
              </div>
            </div>
            </a>

            <!-- Wide Card 5 -->
            <a class="card-link" href="#">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <img class="card-wide-img" src="https://picsum.photos/seed/555/640/360" alt="Além dos Mares" loading="lazy"/>
                <div class="card-wide-title-overlay"><span>Além dos Mares</span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta">★ 7.9 · 2023 · Documentário</div>
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
    <section class="section">
      <div class="section-header">
        <h2 class="section-title">🎓 Meus Cursos</h2>
        <a href="#" class="section-see-all">Ver tudo →</a>
      </div>
      <div class="carousel-wrapper" id="carousel-pop">
        <button class="carousel-btn prev" onclick="scrollCarousel('carousel-pop', -1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div class="carousel-track-outer">
          <div class="carousel-track">

            <!-- Card 1 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <img src="https://picsum.photos/seed/1101/300/450" alt="Cicatrizes" loading="lazy"/>
                <div class="card-title-overlay"><span>Cicatrizes</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Cicatrizes</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.0</span>
                  <span>2022</span><span>·</span><span>Drama</span>
                </div>
                <div class="card-tooltip-desc">Uma história emocionante sobre coragem, amizade e autodescoberta em tempos difíceis.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 2 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge new">Novo</span>
                <img src="https://picsum.photos/seed/1202/300/450" alt="O Guardião" loading="lazy"/>
                <div class="card-title-overlay"><span>O Guardião</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">O Guardião</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.5</span>
                  <span>2024</span><span>·</span><span>Ação</span>
                </div>
                <div class="card-tooltip-desc">Mundos paralelos colidem nesta aventura épica que desafia os limites da realidade.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 3 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <img src="https://picsum.photos/seed/1303/300/450" alt="Aurora" loading="lazy"/>
                <div class="card-title-overlay"><span>Aurora</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Aurora</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 9.3</span>
                  <span>2024</span><span>·</span><span>Animação</span>
                </div>
                <div class="card-tooltip-desc">Animação premiada que encanta crianças e adultos com sua beleza visual única.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 4 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <span class="card-badge hot">Hot</span>
                <img src="https://picsum.photos/seed/1404/300/450" alt="Fragmento" loading="lazy"/>
                <div class="card-title-overlay"><span>Fragmento</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Fragmento</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 7.7</span>
                  <span>2023</span><span>·</span><span>Thriller</span>
                </div>
                <div class="card-tooltip-desc">Thriller psicológico onde nada é o que parece e cada resposta gera novas perguntas.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

            <!-- Card 5 -->
            <a class="card-link" href="#">
            <div class="card">
              <div class="card-poster">
                <img src="https://picsum.photos/seed/1505/300/450" alt="Paralelo" loading="lazy"/>
                <div class="card-title-overlay"><span>Paralelo</span></div>
              </div>
              <div class="card-tooltip">
                <div class="card-tooltip-title">Paralelo</div>
                <div class="card-tooltip-meta">
                  <span class="card-tooltip-rating">★ 8.9</span>
                  <span>2022</span><span>·</span><span>Ficção Científica</span>
                </div>
                <div class="card-tooltip-desc">Uma jornada emocionante de redenção, amor e sacrifício em um mundo à beira do colapso.</div>
                <div class="card-tooltip-actions">
                  <button class="card-tooltip-btn play">▶ Assistir</button>
                  <button class="card-tooltip-btn info">ℹ Info</button>
                </div>
              </div>
            </div>
            </a>

          </div>
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('carousel-pop', 1)">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </section>

  </main>

  <!-- =============================================
       FOOTER
  ============================================= -->
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <span class="logo">StreamVibe<span style="color:var(--accent)">.</span></span>
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
      <span class="footer-copy">© 2024 StreamVibe. Todos os direitos reservados.</span>
      <div class="footer-badge">
        <span>HD</span><span>4K</span><span>Dolby</span>
      </div>
    </div>
  </footer>

  <script>
    /* Carousel arrow scroll */
    function scrollCarousel(wrapperId, dir) {
      const wrapper = document.getElementById(wrapperId);
      const outer = wrapper.querySelector('.carousel-track-outer');
      outer.scrollBy({ left: dir * outer.clientWidth * 0.75, behavior: 'smooth' });
    }

    /* Drag-to-scroll */
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