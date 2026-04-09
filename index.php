<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GoStay - Transforme Sua Carreira com Educação de Qualidade</title>
  <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <style>
    /* ─── Reset ──────────────────────────────────────────────────────── */
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    /* ══════════════════════════════════════════════════════════════════
       INTRO ANIMATION STYLES
    ══════════════════════════════════════════════════════════════════ */

    /* While intro is active, block scroll */
    body.intro-active { overflow: hidden; }

    #intro {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: #0f1c3f;   /* matches IdsEad's dark navy */
      overflow: hidden;

      /*intro começa escondida e só ativa quando precisa ( na primeira sessão )*/
      display: none; /* Começa escondido */
      position: fixed;
    }

    /* Logo central que aparece após o expand */
    #logo-splash {
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%) scale(0.3);
      z-index: 15;
      width: 550px;
      height: 550px;
      object-fit: contain;
      border-radius: 20px;
      opacity: 0;
      pointer-events: none;
    }

    /* Curtain halves */
    #curtain-top, #curtain-bottom {
      position: absolute;
      left: 0; right: 0;
      height: 50%;
      background: #0f1c3f;
      z-index: 10;
      transform: scaleY(0);
    }
    #curtain-top    { top: 0;    transform-origin: bottom center; }
    #curtain-bottom { bottom: 0; transform-origin: top center; }

    /* Canvas for the trail */
    #trail-canvas {
      position: absolute;
      inset: 0;
      width: 100%; height: 100%;
      z-index: 5;
    }

    /* Plane SVG */
    #plane {
      position: absolute;
      top: 50%;
      left: -80px;
      transform: translateY(-50%) rotate(-4deg);
      z-index: 20;
      width: 64px;
      height: 64px;
    }

    /* ══════════════════════════════════════════════════════════════════
       IDSEAD PAGE STYLES
    ══════════════════════════════════════════════════════════════════ */

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: #1a1a2e;
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* Header */
    header {
      background: linear-gradient(135deg, #0f1c3f 0%, #1a2a52 100%);
      padding: 1.2rem 0;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }

    nav { display: flex; justify-content: space-between; align-items: center; }

    .logo { font-size: 2rem; font-weight: 900; color: #fff; letter-spacing: -1px; }
    .logo span { color: #ffd31d; }

    .nav-links { display: flex; gap: 2.5rem; list-style: none; }
    .nav-links a {
      color: #fff; text-decoration: none; font-weight: 600; font-size: 0.95rem;
      transition: color 0.3s ease; position: relative;
    }
    .nav-links a:hover { color: #ffd31d; }
    .nav-links a::after {
      content: ''; position: absolute; bottom: -5px; left: 0;
      width: 0; height: 2px; background: #ffd31d; transition: width 0.3s ease;
    }
    .nav-links a:hover::after { width: 100%; }

    /* Hero */
    .hero {
      background: linear-gradient(135deg, #0f1c3f 0%, #1e3a6b 100%);
      padding: 10rem 0 6rem;
      margin-top: 72px;
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: ''; position: absolute; top: 0; right: -10%;
      width: 60%; height: 100%;
      background: radial-gradient(circle, rgba(255,211,29,0.1) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-content { position: relative; z-index: 2; max-width: 700px; }
    .hero h1 {
      font-size: 3.5rem; font-weight: 900; color: #fff;
      line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -2px;
    }
    .hero h1 span { color: #ffd31d; display: block; }
    .hero p { font-size: 1.25rem; color: rgba(255,255,255,0.9); margin-bottom: 2.5rem; }

    .cta-button {
      display: inline-block; background: #ffd31d; color: #0f1c3f;
      padding: 1.2rem 3rem; font-size: 1.1rem; font-weight: 800;
      text-decoration: none; border-radius: 50px;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(255,211,29,0.3);
      text-transform: uppercase; letter-spacing: 0.5px;
    }
    .cta-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(255,211,29,0.4);
      background: #ffdc40;
    }

    /* Features */
    .features { padding: 6rem 0; background: #fff; }

    .section-title { text-align: center; margin-bottom: 4rem; }
    .section-title h2 {
      font-size: 2.8rem; font-weight: 900; color: #0f1c3f;
      margin-bottom: 1rem; letter-spacing: -1px;
    }
    .section-title p { font-size: 1.2rem; color: #666; font-weight: 500; }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2.5rem;
    }
    .feature-card {
      background: #f8f9fa; padding: 2.5rem; border-radius: 20px;
      transition: all 0.3s ease; border: 2px solid transparent;
    }
    .feature-card:hover {
      transform: translateY(-10px); border-color: #ffd31d;
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .feature-icon {
      width: 70px; height: 70px;
      background: linear-gradient(135deg, #0f1c3f 0%, #1e3a6b 100%);
      border-radius: 15px; display: flex; align-items: center;
      justify-content: center; font-size: 2rem; margin-bottom: 1.5rem; color: #ffd31d;
    }
    .feature-card h3 { font-size: 1.5rem; font-weight: 800; color: #0f1c3f; margin-bottom: 1rem; }
    .feature-card p { color: #555; font-size: 1rem; line-height: 1.7; }

    /* Courses */
    .courses { padding: 6rem 0; background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%); }
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 2.5rem;
    }
    .course-card {
      background: #fff; border-radius: 20px; overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease;
    }
    .course-card:hover { transform: translateY(-10px); box-shadow: 0 20px 50px rgba(0,0,0,0.15); }
    .course-header {
      background: linear-gradient(135deg, #0f1c3f 0%, #1e3a6b 100%);
      padding: 2rem; text-align: center;
    }
    .course-header h3 { font-size: 1.6rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem; }
    .course-tag {
      display: inline-block; background: #ffd31d; color: #0f1c3f;
      padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.85rem;
      font-weight: 700; text-transform: uppercase;
    }
    .course-body { padding: 2rem; }
    .course-body ul { list-style: none; margin-bottom: 1.5rem; }
    .course-body li {
      padding: 0.6rem 0; color: #555; font-weight: 500;
      position: relative; padding-left: 1.5rem;
    }
    .course-body li::before { content: '✓'; position: absolute; left: 0; color: #ffd31d; font-weight: 900; }
    .course-button {
      display: block; width: 100%; background: #0f1c3f; color: #fff;
      padding: 1rem; text-align: center; text-decoration: none;
      border-radius: 10px; font-weight: 700; font-size: 1rem;
      transition: all 0.3s ease; text-transform: uppercase;
    }
    .course-button:hover { background: #1e3a6b; transform: scale(1.02); }

    /* CTA Section */
    .cta-section {
      background: linear-gradient(135deg, #0f1c3f 0%, #1e3a6b 100%);
      padding: 5rem 0; text-align: center; position: relative; overflow: hidden;
    }
    .cta-section::before {
      content: ''; position: absolute; top: -50%; left: -10%;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(255,211,29,0.1) 0%, transparent 70%);
    }
    .cta-section h2 {
      font-size: 3rem; font-weight: 900; color: #fff;
      margin-bottom: 1rem; position: relative; z-index: 2; letter-spacing: -1px;
    }
    .cta-section p {
      font-size: 1.3rem; color: rgba(255,255,255,0.9);
      margin-bottom: 2.5rem; position: relative; z-index: 2;
    }

    /* Footer */
    footer { background: #0a0f1f; padding: 3rem 0 1.5rem; color: #fff; }
    .footer-content {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 3rem; margin-bottom: 2rem;
    }
    .footer-section h4 { font-size: 1.2rem; font-weight: 800; margin-bottom: 1rem; color: #ffd31d; }
    .footer-section ul { list-style: none; }
    .footer-section ul li { margin-bottom: 0.7rem; }
    .footer-section a { color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s ease; font-weight: 500; }
    .footer-section a:hover { color: #ffd31d; }
    .footer-bottom {
      text-align: center; padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,0.1);
      color: rgba(255,255,255,0.6); font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .nav-links { display: none; }
      .hero h1 { font-size: 2.5rem; }
      .hero p { font-size: 1.1rem; }
      .section-title h2 { font-size: 2rem; }
      .cta-section h2 { font-size: 2rem; }
      .courses-grid, .features-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- ══════════════════════════════════════════════════════════════════
       INTRO OVERLAY — avião voa, rastro se expande, cortina abre
  ══════════════════════════════════════════════════════════════════ -->
  <div id="intro">
    <canvas id="trail-canvas"></canvas>

    <!-- Avião amarelo minimalista (SVG inline) -->
    <svg id="plane" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <!-- Fuselagem -->
      <path d="M4 34 L52 30 L60 32 L52 36 Z" fill="#FFD94A"/>
      <!-- Asa principal -->
      <path d="M22 30 L36 16 L40 18 L30 32 Z" fill="#FFE870"/>
      <!-- Leme vertical -->
      <path d="M6 34 L14 28 L16 30 L10 36 Z" fill="#FFE870"/>
      <!-- Leme horizontal -->
      <path d="M6 34 L14 38 L13 40 L6 36 Z" fill="#FFD94A" opacity="0.8"/>
      <!-- Motor -->
      <circle cx="53" cy="32" r="3" fill="#FFF5C0"/>
    </svg>

    <!-- Logo que aparece com zoom após o expand, antes da abertura -->
    <img id="logo-splash"
         src="assets/ACELERADOR DO POTENCIAL HUMANO (1).png"
         alt="IDS Educacional" />

    <!-- Cortinas (invisíveis até a fase de abertura) -->
    <div id="curtain-top"></div>
    <div id="curtain-bottom"></div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════
       CONTEÚDO DA PÁGINA IDSEAD
  ══════════════════════════════════════════════════════════════════ -->
  <header>
    <div class="container">
      <nav>
        <div class="logo">Go<span>Stay</span></div>
        <ul class="nav-links">
          <li><a href="login.php">Cursos</a></li>
          <li><a href="login.php">Metodologia</a></li>
          <li><a href="login.php">Certificados</a></li>
          <li><a href="login.php">Acessar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <h1>Educação Online <span>Que Transforma Carreiras</span></h1>
        <p>Aprenda com especialistas do mercado, conquiste certificações reconhecidas e impulsione sua trajetória profissional com flexibilidade total.</p>
        <a href="login.php" class="cta-button">Começar Agora</a>
      </div>
    </div>
  </section>

  <section class="features">
    <div class="container">
      <div class="section-title">
        <h2>Por Que Escolher o GoStay?</h2>
        <p>Tecnologia, metodologia e suporte dedicado ao seu aprendizado</p>
      </div>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">🎓</div>
          <h3>Certificação Reconhecida</h3>
          <p>Certificados digitais válidos em todo território nacional, emitidos conforme legislação vigente e aceitos por empresas líderes de mercado.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">⚡</div>
          <h3>Aprenda no Seu Ritmo</h3>
          <p>Acesso ilimitado 24/7 aos conteúdos. Estude quando e onde quiser, no computador, tablet ou smartphone, com total autonomia.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">👨‍🏫</div>
          <h3>Instrutores Especialistas</h3>
          <p>Aprenda com profissionais atuantes no mercado, que trazem experiência prática e cases reais para sua formação.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">💡</div>
          <h3>Conteúdo Atualizado</h3>
          <p>Material didático constantemente revisado e atualizado conforme as tendências e exigências do mercado de trabalho.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎯</div>
          <h3>Trilhas Personalizadas</h3>
          <p>Metodologia focada em resultados práticos, com projetos reais e exercícios que desenvolvem habilidades aplicáveis imediatamente.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🤝</div>
          <h3>Suporte Dedicado</h3>
          <p>Equipe especializada pronta para auxiliar em dúvidas técnicas, metodológicas e administrativas durante toda sua jornada.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="courses">
    <div class="container">
      <div class="section-title">
        <h2>Cursos em Destaque</h2>
        <p>Programas completos para alavancar sua carreira profissional</p>
      </div>
      <div class="courses-grid">
        <div class="course-card">
          <div class="course-header">
            <h3>Limpeza de Pele</h3>
            <span class="course-tag">Mais Procurado</span>
          </div>
          <div class="course-body">
            <ul>
              <li>Anamnese dos Pacientes</li>
              <li>Tipos de peles</li>
              <li>Tratamento para cada tipo</li>
              <li>Demonstração prática</li>
              <li>Certificado de conclusão</li>
            </ul>
            <a href="login.php" class="course-button">Acessar Curso</a>
          </div>
        </div>
        <div class="course-card">
          <div class="course-header">
            <h3>Toxina Botulínica</h3>
            <span class="course-tag">Alta Demanda</span>
          </div>
          <div class="course-body">
            <ul>
              <li>Anamnese dos Pacientes</li>
              <li>Fundamentação Teórica</li>
              <li>Marcação dos pontos</li>
              <li>Demonstração Prática</li>
              <li>Certificado de conclusão</li>
            </ul>
            <a href="login.php" class="course-button">Acessar Curso</a>
          </div>
        </div>
        <div class="course-card">
          <div class="course-header">
            <h3>Intradermoterapia</h3>
            <span class="course-tag">Área em Expansão</span>
          </div>
          <div class="course-body">
            <ul>
              <li>Anamnese dos Pacientes</li>
              <li>Criação de protócolos</li>
              <li>Teoria da aplicação</li>
              <li>Demonstração Prática</li>
              <li>Certificado de conclusão</li>
            </ul>
            <a href="login.php" class="course-button">Acessar Curso</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-section">
    <div class="container">
      <h2>Pronto Para Transformar Sua Carreira?</h2>
      <p>Junte-se a milhares de profissionais que já conquistaram seus objetivos com a GoStay</p>
      <a href="login.php" class="cta-button">Criar Minha Conta Grátis</a>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h4>GoStay</h4>
          <p>Plataforma líder em educação online, comprometida com a excelência no ensino e desenvolvimento profissional.</p>
        </div>
        <div class="footer-section">
          <h4>Navegação</h4>
          <ul>
            <li><a href="login.php">Todos os Cursos</a></li>
            <li><a href="login.php">Planos e Preços</a></li>
            <li><a href="login.php">Sobre Nós</a></li>
            <li><a href="login.php">Blog</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4>Suporte</h4>
          <ul>
            <li><a href="login.php">Central de Ajuda</a></li>
            <li><a href="login.php">Fale Conosco</a></li>
            <li><a href="login.php">Termos de Uso</a></li>
            <li><a href="login.php">Política de Privacidade</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4>Conta</h4>
          <ul>
            <li><a href="login.php">Fazer Login</a></li>
            <li><a href="login.php">Criar Conta</a></li>
            <li><a href="login.php">Recuperar Senha</a></li>
            <li><a href="login.php">Meus Cursos</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2026 GoStay. Todos os direitos reservados.<br>Developed by Lucas</p>
      </div>
    </div>
  </footer>

  <!-- ══════════════════════════════════════════════════════════════════
       SCRIPT DA ANIMAÇÃO INTRO
  ══════════════════════════════════════════════════════════════════ -->
  <script>
    /* ═══════════════════════════════════════════════════════════════
       Fases:
         1. FLIGHT  (~2.6s) — avião voa da esquerda para a direita
         2. EXPAND  (~0.7s) — rastro se expande verticalmente
         3. LOGO    (~1.4s) — logo aparece com zoom e some sozinha
         4. REVEAL  (~0.85s)— cortinas abrem, página aparece
    ═══════════════════════════════════════════════════════════════ */

    const intro      = document.getElementById('intro');
    const plane      = document.getElementById('plane');
    const canvas     = document.getElementById('trail-canvas');
    const ctx        = canvas.getContext('2d');
    const curtainTop = document.getElementById('curtain-top');
    const curtainBot = document.getElementById('curtain-bottom');
    const logoSplash = document.getElementById('logo-splash');

    /* ── Ajusta canvas ao tamanho da viewport ─────────────────── */
    function resizeCanvas() {
      canvas.width  = window.innerWidth;
      canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    const W  = () => window.innerWidth;
    const H  = () => window.innerHeight;
    const CY = () => H() / 2;

    let startTime   = null;
    let phase       = 'flight';
    let trailEndX   = -80;
    let expandStart = null;
    let logoStart   = null;
    let revealStart = null;

    const TRAIL_Y_OFFSET = 2;
    const TRAIL_WIDTH    = 4;

    /* ── Curvas de easing ─────────────────────────────────────── */
    function easeInOutCubic(t) { return t < 0.5 ? 4*t*t*t : 1 - Math.pow(-2*t+2,3)/2; }
    function easeOutCubic(t)   { return 1 - Math.pow(1-t, 3); }

    /* ── Fase 1: desenha rastro incremental ───────────────────── */
    function drawTrail(planeX) {
      if (trailEndX >= planeX) return;
      const y = CY() + TRAIL_Y_OFFSET;
      ctx.beginPath();
      ctx.moveTo(trailEndX, y);
      ctx.lineTo(planeX, y);
      ctx.strokeStyle = '#FFD94A';
      ctx.lineWidth   = TRAIL_WIDTH;
      ctx.lineCap     = 'butt';
      ctx.lineJoin    = 'miter';
      ctx.stroke();
      trailEndX = planeX;
    }

    /* ── Fase 2: expande linha em barra vertical ──────────────── */
    function runExpand(now) {
      if (!expandStart) expandStart = now;
      const t     = Math.min((now - expandStart) / 700, 1);
      const eased = easeInOutCubic(t);
      const y     = CY() + TRAIL_Y_OFFSET;
      const halfH = eased * (H() / 2 + 4);

      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.fillStyle = '#FFD94A';
      ctx.fillRect(0, y - halfH, W(), halfH * 2);

      if (t >= 1) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        phase = 'logo';
        runLogo(now);
      }
    }

    /* ── Fase 3: logo aparece com zoom e some sozinha ─────────── */
    function runLogo(now) {
      if (!logoStart) {
        logoStart = now;
        /* Mostra a logo assim que a fase começa */
        logoSplash.style.opacity = '1';
      }

      const LOGO_DUR = 1400; // ms total da fase logo
      const t = Math.min((now - logoStart) / LOGO_DUR, 1);

      let scale, opacity;

      if (t < 0.35) {
        /* Zoom in: 0.3 → 1.0 */
        const p = t / 0.35;
        const e = 1 - Math.pow(1 - p, 3); // easeOutCubic
        scale   = 0.3 + e * 0.7;
        opacity = p;
      } else if (t < 0.65) {
        /* Sustentado no centro */
        scale   = 1.0;
        opacity = 1.0;
      } else {
        /* Zoom out + fade: escala 1.0 → 1.25, opacidade 1 → 0 */
        const p = (t - 0.65) / 0.35;
        const e = p * p * p; // easeInCubic
        scale   = 1.0 + e * 0.25;
        opacity = 1 - p;
      }

      logoSplash.style.transform = `translate(-50%, -50%) scale(${scale})`;
      logoSplash.style.opacity   = opacity;

      if (t >= 1) {
        logoSplash.style.display = 'none';
        phase = 'reveal';
        runReveal(now);
      }
    }

    /* ── Fase 4: cortinas se afastam, página revelada ─────────── */
    function runReveal(now) {
      if (!revealStart) revealStart = now;
      const t     = Math.min((now - revealStart) / 850, 1);
      const scale = 1 - easeOutCubic(t);

      /* Primeiro frame: coloca cortinas em posição fechada */
      if (t === 0) {
        curtainTop.style.transition = 'none';
        curtainBot.style.transition = 'none';
        curtainTop.style.transform  = 'scaleY(1)';
        curtainBot.style.transform  = 'scaleY(1)';
      }

      curtainTop.style.transform = `scaleY(${scale})`;
      curtainBot.style.transform = `scaleY(${scale})`;

      if (t >= 1) {
        phase = 'done';
        /* Remove overlay e libera scroll */
        intro.style.display = 'none';
        document.body.classList.remove('intro-active');
      }
    }

    /* ── Loop principal rAF ───────────────────────────────────── */
    function loop(now) {
      if (!startTime) startTime = now;

      if (phase === 'flight') {
        const FLIGHT_DUR = 2600;
        const t    = Math.min((now - startTime) / FLIGHT_DUR, 1);
        const eased = easeInOutCubic(t);

        const planeX = -80 + eased * (W() + 120);
        const bobY   = Math.sin(eased * Math.PI * 3) * 4;

        plane.style.left = planeX + 'px';
        plane.style.top  = `calc(50% + ${bobY}px)`;

        drawTrail(planeX + 8);

        if (t >= 1) {
          plane.style.display = 'none';
          phase = 'expand';
        }

      } else if (phase === 'expand') {
        runExpand(now);

      } else if (phase === 'logo') {
        runLogo(now);

      } else if (phase === 'reveal') {
        runReveal(now);

      } else {
        return; /* animação concluída */
      }

      requestAnimationFrame(loop);
    }

    /* ── Inicia ───────────────────────────────────────────────── */
    requestAnimationFrame(() => {
      curtainTop.style.transform = 'scaleY(0)';
      curtainBot.style.transform = 'scaleY(0)';
      requestAnimationFrame(loop);
    });

    /* renderizar a animação apenas uma vez (na primeira entrada do usuário)*/

    /* ── Controle de Exibição (Apenas 1 vez por sessão) ─────────── */
    const introKey = 'gostay_intro_done';

    if (!sessionStorage.getItem(introKey)) {
      // Se NÃO existe a chave no storage, executa a animação
      intro.style.display = 'block'; // Mostra o container da intro
  
    requestAnimationFrame(() => {
      curtainTop.style.transform = 'scaleY(0)';
      curtainBot.style.transform = 'scaleY(0)';
      requestAnimationFrame(loop);
    });

  // Marca que a animação já rodou
  sessionStorage.setItem(introKey, 'true');
} else {
  // Se JÁ rodou, remove a classe de trava de scroll e garante que a intro suma
  document.body.classList.remove('intro-active');
  intro.style.display = 'none';
}
  </script>
</body>
</html>