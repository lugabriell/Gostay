<?php
  session_start();
  include_once("connection.php");
  $idaluno = $_SESSION['id'];
  if(!isset($_SESSION['email'])|| !isset($_SESSION['nome'])){
    header("Location:login.php");
  }
  $sqlmycourse = "SELECT * FROM cursoaluno WHERE idaluno = '$idaluno'";
  $sqlfreecourse = "SELECT * FROM curso WHERE tipo = 'gratis'";
  $resultmycourse = mysqli_query($conexao, $sqlmycourse);
  $resultfreecourse = mysqli_query($conexao, $sqlfreecourse);
  $resultfreecourse2 = mysqli_query($conexao, $sqlfreecourse);
  $dadosfreecourse = mysqli_fetch_assoc($resultfreecourse2);
  $idcategoria = $dadosfreecourse['idcategoria'];
  $sqlcategoria = "SELECT nome FROM categoria WHERE id ='$idcategoria'";
  $resultcategoria = mysqli_query($conexao, $sqlcategoria);
  $dadoscategoria = mysqli_fetch_assoc($resultcategoria);
  $resultfreecourse3 = mysqli_query($conexao, $sqlfreecourse);
  $sqlnovidades = "SELECT * FROM curso WHERE tipo ='gratis' ORDER BY datacadastro DESC";
  $resultnovidades = mysqli_query($conexao, $sqlnovidades);
 

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GoStay</title>
      <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Lora:ital,wght@0,400;1,400&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="stylehomepage.css">
  <style>
  
    :root {
      --nav-h: 72px;

  /* Palette */
  --bg:           #eef2f8;
  --bg2:          #e4eaf5;
  --surface:      rgba(255,255,255,0.62);
  --surface-2:    rgba(255,255,255,0.42);
  --border:       rgba(255,255,255,0.75);
  --border-dim:   rgba(180,200,230,0.35);

  --text:         #1a2540;
  --text-2:       #4a5a7a;
  --text-3:       #8a9ab8;

  --accent:       #f0b429;          /* gold */
  --accent-2:     #e8a500;
  --blue:         #2563eb;
  --blue-soft:    rgba(37,99,235,0.12);
  
  /* Glass */
  --glass-blur:   18px;
  --glass-bg:     rgba(255,255,255,0.55);
  --glass-bg-2:   rgba(255,255,255,0.35);
  --glass-shadow: 0 8px 32px rgba(60,100,200,0.10), 0 1.5px 0 rgba(255,255,255,0.8) inset;
  
  /* Type */
  --font-body:    'DM Sans', sans-serif;
  --font-display: 'Playfair Display', Georgia, serif;

  /* Radius */
  --r-sm: 12px;
  --r-md: 18px;
  --r-lg: 24px;
  --r-xl: 32px;
}

/* ── RESET ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
  font-family: var(--font-body);
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
  /* Subtle noise texture for depth */
  background-image:
    radial-gradient(ellipse 80% 60% at 20% 10%, rgba(147,197,253,0.28) 0%, transparent 60%),
    radial-gradient(ellipse 60% 50% at 80% 80%, rgba(196,181,253,0.14) 0%, transparent 55%),
    radial-gradient(ellipse 50% 40% at 50% 40%, rgba(240,180,41,0.06) 0%, transparent 60%);
  background-attachment: fixed;
}

/* ── NAVBAR ────────────────────────────────────────── */
.navbar {
  position: fixed;
  top: 12px;
  left: 50%;
  transform: translateX(-50%);
  width: calc(100% - 40px);
  max-width: 1200px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
  z-index: 1000;

  background: var(--glass-bg);
  backdrop-filter: blur(var(--glass-blur)) saturate(180%);
  -webkit-backdrop-filter: blur(var(--glass-blur)) saturate(180%);
  border: 1px solid var(--border);
  border-radius: 100px;
  box-shadow: 0 4px 24px rgba(37,99,235,0.08), 0 1px 0 rgba(255,255,255,0.9) inset;
}

.nav-logo {
  font-family: var(--font-display);
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 2px;
  letter-spacing: -0.02em;
}
.logo-dot { width: 6px; height: 6px; background: var(--accent); border-radius: 50%; margin-left: 2px; }

.nav-links {
  display: flex;
  list-style: none;
  gap: 4px;
}
.nav-links a {
  text-decoration: none;
  color: var(--text-2);
  font-size: 0.875rem;
  font-weight: 500;
  padding: 7px 16px;
  border-radius: 100px;
  transition: all 0.22s ease;
}
.nav-links a:hover {
  color: var(--text);
  background: rgba(255,255,255,0.7);
}

.nav-right { display: flex; align-items: center; gap: 10px; }

/* ── HERO ──────────────────────────────────────────── */
.hero {
  position: relative;
  width: 100%;
  height: clamp(560px, 85vh, 820px);
  overflow: hidden;
  margin-top: 0;
}

.hero-bg {
  position: absolute;
  inset: 0;
  transform: scale(1.06);
  animation: hero-zoom 22s ease-in-out infinite alternate;
  filter: brightness(0.72) saturate(1.1);
}

@keyframes hero-zoom {
  from { transform: scale(1.06); }
  to   { transform: scale(1.00); }
}

/* Gradient overlays — iOS-style cool tone */
.hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background:
    linear-gradient(180deg,
      rgba(10,20,50,0.15) 0%,
      rgba(10,20,50,0.0) 35%,
      rgba(10,20,50,0.75) 100%),
    linear-gradient(105deg,
      rgba(10,30,80,0.60) 0%,
      transparent 55%);
}

.hero-gradient        { display: none; }
.hero-gradient-bottom { display: none; }

.hero-content {
  position: absolute;
  bottom: 0; left: 0;
  width: 100%;
  padding: 0 6vw 64px;
  z-index: 2;
  max-width: 780px;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(255,255,255,0.14);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.28);
  color: rgba(255,255,255,0.92);
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 100px;
  margin-bottom: 18px;
}
.hero-badge::before {
  content: '';
  width: 6px; height: 6px;
  background: var(--accent);
  border-radius: 50%;
}

.hero-title {
  font-family: var(--font-display);
  font-size: clamp(2.2rem, 5vw, 3.6rem);
  font-weight: 700;
  line-height: 1.12;
  color: #fff;
  margin-bottom: 14px;
  letter-spacing: -0.02em;
}

.hero-meta {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 14px;
}
.hero-genre {
  background: rgba(240,180,41,0.22);
  border: 1px solid rgba(240,180,41,0.4);
  color: var(--accent);
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.05em;
  padding: 4px 12px;
  border-radius: 100px;
}
.hero-sep { color: rgba(255,255,255,0.35); }
.hero-duration { color: rgba(255,255,255,0.65); font-size: 0.82rem; font-weight: 500; }

.hero-desc {
  color: rgba(255,255,255,0.72);
  font-size: 0.95rem;
  line-height: 1.65;
  max-width: 520px;
  margin-bottom: 28px;
  font-weight: 300;
}

.hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

.btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 13px 26px;
  border-radius: 100px;
  font-size: 0.875rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.22s ease;
  cursor: pointer;
  border: none;
}

.btn-primary {
  background: var(--accent);
  color: #1a2540;
  box-shadow: 0 4px 20px rgba(240,180,41,0.40);
}
.btn-primary:hover {
  background: var(--accent-2);
  transform: translateY(-2px);
  box-shadow: 0 8px 28px rgba(240,180,41,0.50);
}

.btn-ghost {
  background: rgba(255,255,255,0.14);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.30);
  color: #fff;
}
.btn-ghost:hover {
  background: rgba(255,255,255,0.22);
  transform: translateY(-2px);
}

/* ── MAIN CONTENT AREA ─────────────────────────────── */
.main {
  padding: 56px 5vw 80px;
  max-width: 1340px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 64px;
}

/* ── SECTION HEADERS ───────────────────────────────── */
.section-header {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  margin-bottom: 24px;
}

.section-title {
  font-family: var(--font-display);
  font-size: 1.6rem;
  font-weight: 700;
  color: var(--text);
  letter-spacing: -0.02em;
  position: relative;
}
.section-title::after {
  content: '';
  display: block;
  width: 32px;
  height: 3px;
  background: var(--accent);
  border-radius: 2px;
  margin-top: 6px;
}

/* ── CAROUSEL ──────────────────────────────────────── */
.carousel-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  gap: 0;
}

.carousel-track-outer {
  overflow: hidden;            /* hide scrollbar, auto-scroll instead */
  flex: 1;
  border-radius: var(--r-lg);
  cursor: grab;
}
.carousel-track-outer:active { cursor: grabbing; }

.carousel-track {
  display: flex;
  gap: 16px;
  padding: 8px 4px 16px;
  /* auto-scroll animation applied via JS */
  will-change: transform;
}

/* Carousel Buttons */
.carousel-btn {
  flex-shrink: 0;
  width: 42px;
  height: 42px;
  border-radius: 50%;
  border: 1px solid var(--border-dim);
  background: var(--glass-bg);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  color: var(--text-2);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.22s ease;
  box-shadow: var(--glass-shadow);
  z-index: 2;
}
.carousel-btn:hover {
  background: rgba(255,255,255,0.85);
  color: var(--text);
  transform: scale(1.08);
}
.carousel-btn.prev { margin-right: 12px; }
.carousel-btn.next { margin-left: 12px; }

/* ── CARDS ─────────────────────────────────────────── */
.card-link { text-decoration: none; flex-shrink: 0; }

.card {
  width: 200px;
  border-radius: var(--r-md);
  overflow: hidden;
  background: var(--glass-bg);
  border: 1px solid var(--border);
  box-shadow: var(--glass-shadow);
  transition: transform 0.28s ease, box-shadow 0.28s ease;
  cursor: pointer;
  flex-shrink: 0;
}
.card:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 0 20px 48px rgba(37,99,235,0.14), 0 1px 0 rgba(255,255,255,0.9) inset;
}

.card-poster {
  position: relative;
  aspect-ratio: 2/3;
  overflow: hidden;
}
.card-poster img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.card:hover .card-poster img { transform: scale(1.06); }

.card-title-overlay {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  padding: 28px 12px 12px;
  background: linear-gradient(0deg, rgba(10,20,50,0.82) 0%, transparent 100%);
  font-size: 0.78rem;
  font-weight: 600;
  color: #fff;
  line-height: 1.3;
}

/* Badges */
.card-badge {
  position: absolute;
  top: 10px; left: 10px;
  z-index: 2;
  font-size: 0.65rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 100px;
}
.card-badge.hot  { background: rgba(239,68,68,0.9);  color: #fff; }
.card-badge.new  { background: rgba(240,180,41,0.92); color: #1a2540; }
.card-badge.free { background: rgba(34,197,94,0.88);  color: #fff; }

/* ── WIDE CARDS (Novidades) ────────────────────────── */
.card-wide {
  width: 260px;
  border-radius: var(--r-md);
  overflow: hidden;
  background: var(--glass-bg);
  border: 1px solid var(--border);
  box-shadow: var(--glass-shadow);
  transition: transform 0.28s ease, box-shadow 0.28s ease;
  cursor: pointer;
  flex-shrink: 0;
}
.card-wide:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 0 20px 48px rgba(37,99,235,0.14), 0 1px 0 rgba(255,255,255,0.9) inset;
}

.card-wide-img {
  width: 100%;
  height: 160px;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.card-wide:hover .card-wide-img { transform: scale(1.06); }

.card-wide-title-overlay {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  padding: 36px 12px 10px;
  background: linear-gradient(0deg, rgba(10,20,50,0.80) 0%, transparent 100%);
  font-size: 0.82rem;
  font-weight: 600;
  color: #fff;
  line-height: 1.3;
}

.card-wide-body {
  padding: 10px 14px 14px;
}
.card-wide-meta {
  font-size: 0.75rem;
  color: var(--text-3);
  font-weight: 500;
  letter-spacing: 0.02em;
}

/* ── FOOTER ────────────────────────────────────────── */
footer {
  background: var(--glass-bg);
  backdrop-filter: blur(var(--glass-blur));
  -webkit-backdrop-filter: blur(var(--glass-blur));
  border-top: 1px solid var(--border-dim);
  padding: 56px 6vw 28px;
  margin-top: 0;
}

.footer-top {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 48px;
  margin-bottom: 40px;
}

.footer-brand .logo {
  font-family: var(--font-display);
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--text);
  letter-spacing: -0.02em;
}

.footer-brand p {
  margin-top: 14px;
  font-size: 0.85rem;
  color: var(--text-3);
  line-height: 1.7;
  max-width: 300px;
}

.footer-social {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}

.social-btn {
  width: 36px; height: 36px;
  border-radius: 50%;
  border: 1px solid var(--border-dim);
  background: rgba(255,255,255,0.6);
  color: var(--text-2);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.22s ease;
}
.social-btn:hover {
  background: var(--accent);
  color: #1a2540;
  border-color: transparent;
  transform: translateY(-2px);
}

.footer-col h4 {
  font-size: 0.8rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--text);
  margin-bottom: 18px;
}
.footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.footer-col a {
  font-size: 0.85rem;
  color: var(--text-3);
  text-decoration: none;
  transition: color 0.18s ease;
}
.footer-col a:hover { color: var(--text); }

.footer-divider {
  border: none;
  border-top: 1px solid var(--border-dim);
  margin-bottom: 20px;
}

.footer-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.footer-copy { font-size: 0.78rem; color: var(--text-3); }
.footer-badge {
  font-size: 0.72rem;
  color: var(--text-3);
  background: rgba(255,255,255,0.5);
  border: 1px solid var(--border-dim);
  padding: 5px 14px;
  border-radius: 100px;
}

/* ── MOBILE NAV ────────────────────────────────────── */
.mobile-nav { display: none; }

/* ── SCROLLBAR ─────────────────────────────────────── */
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: rgba(37,99,235,0.2); border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: rgba(37,99,235,0.4); }

/* ── RESPONSIVE ────────────────────────────────────── */
@media (max-width: 900px) {
  .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
  .nav-links { display: none; }
}

@media (max-width: 600px) {
  .footer-top { grid-template-columns: 1fr; }
  .hero-content { padding: 0 5vw 48px; }
  .main { padding: 40px 4vw 60px; gap: 48px; }
  .navbar { width: calc(100% - 24px); top: 8px; }
  .card { width: 160px; }
  .card-wide { width: 220px; }
}

@keyframes carousel-slide {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

/* Section destaques uses same pattern as section */
.section-destaques { /* same as .section */ }
</style>
</head>
<body>

  <input type="checkbox" id="mobile-nav-toggle" style="display:none"/>

  <nav class="navbar">
    <a href="#" class="nav-logo">
      Go<span style="color:var(--accent)">Stay</span>
      <span class="logo-dot"></span>
    </a>

    <ul class="nav-links">

      <li><a href="#destaques">Destaques</a></li>
      <li><a href="#gratuitos">Gratuitos</a></li>
      <li><a href="#cursos">Meus Cursos</a></li>
    </ul>

    <div class="nav-right">

      
  </nav>

  <!-- Mobile Nav (CSS-only toggle) -->
  <div class="mobile-nav">
    <label for="mobile-nav-toggle" class="mobile-nav-close-label"></label>
    <div class="mobile-nav-panel">
      <a href="#destaques">Destaques</a>
      <a href="#gratuitos">Gratuitos</a>
      <a href="#cursos">Meus Cursos</a>
    </div>
  </div>

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
        <a href="infos.php?trackid=<?php echo($dadosfreecourse['id']); ?>" class="btn btn-primary">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Assistir
        </a>
        <a href="infos.php?trackid=<?php echo($dadosfreecourse['id']); ?>" class="btn btn-ghost">
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
          <?php 
            while($dadosfreecourse2 = mysqli_fetch_assoc($resultfreecourse)):
          ?>
            <!-- Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosfreecourse2['id']); ?>">
            <div class="card">
              <div class="card-poster">
                <!-- <span class="card-badge hot">Hot</span> -->
                <img src="<?php echo("creates/". $dadosfreecourse2['ftcurso']); ?>"   loading="lazy"/>
                <div class="card-title-overlay"><span><?php echo($dadosfreecourse2['nome']); ?></span></div> 
              </div>
                </div>
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
    </section>

    <!-- GRATUITOS -->
    <section id="gratuitos" class="section">
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
            <!-- Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosfreecourse3['id']); ?>">
            <div class="card">
              <div class="card-poster">
                <!-- <span class="card-badge hot">Hot</span> -->
                <img src="<?php echo("creates/". $dadosfreecourse3['ftcurso']); ?>"  loading="lazy"/>
                <div class="card-title-overlay"><span><?php echo($dadosfreecourse3['nome']); ?></span></div> 
              </div>
                </div>
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
            <?php while($dadosnovidades = mysqli_fetch_assoc($resultnovidades)): 
                      $idcategoria2 = $dadosnovidades['idcategoria'];
                      $sqlcategoria2 = "SELECT nome FROM categoria WHERE id ='$idcategoria2'";
                      $resultcategoria2 = mysqli_query($conexao, $sqlcategoria2);
                      $dadoscategoria2 = mysqli_fetch_assoc($resultcategoria2);
            ?>
              
            <!-- Wide Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosnovidades['id']); ?>">
            <div class="card-wide">
              <div style="position:relative;overflow:hidden;border-radius:14px 14px 0 0">
                <span class="card-badge new" style="position:absolute;top:8px;left:8px;z-index:2">Novo</span>
                <img class="card-wide-img" src="<?php echo("creates/". $dadosnovidades['posterft']) ?>"  loading="lazy"/>
                <div class="card-wide-title-overlay"><span><?php echo($dadosnovidades['nome']); ?></span></div>
              </div>
              <div class="card-wide-body">
                <div class="card-wide-meta"><?php echo($dadosnovidades['cargahoraria']) ?>H - <?php echo($dadoscategoria2['nome']); ?></div>
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
    </section>

    <!-- MEUS CURSOS -->
    <section id="cursos" class="section">
      <div class="section-header">
        <h2 class="section-title"> Meus Cursos</h2>
      
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
              echo('<div ><span>Você não tem nenhum curso</span></div>');
            }
            while($dadosmycourse = mysqli_fetch_assoc($resultmycourse)):
              $idcurso = $dadosmycourse['idcurso'];
              $sqlmycourse2 = "SELECT * FROM curso WHERE id = '$idcurso'";
              $resultmycourse2 = mysqli_query($conexao, $sqlmycourse2);

              while($dadosmycourse2 = mysqli_fetch_assoc($resultmycourse2)):

          ?>
            <!-- Card 1 -->
            <a class="card-link" href="infos.php?trackid=<?php echo($dadosmycourse2['id']); ?>">
            <div class="card">
              <div class="card-poster">

                <img src="<?php echo("creates/".$dadosmycourse2['ftcurso']); ?>"  loading="lazy"/>
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
    </section>

  </main>

  <!-- =============================================
       FOOTER
  ============================================= -->
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