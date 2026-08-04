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
<title>GoStay — Planos</title>
<link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
<?php require_once __DIR__ . '/functions/analytics.php'; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #0a0f1e;
    --bg-soft: #0d1428;
    --card: #121a30;
    --card-border: #223056;
    --gold: #f5a623;
    --gold-light: #ffc85c;
    --blue: #3d8bff;
    --blue-light: #7ab2ff;
    --text: #f4f6fb;
    --muted: #8b93ac;
    --success: #2fbf85;
  }

  *{ box-sizing:border-box; margin:0; padding:0; }

  html{ scroll-behavior:smooth; }

  body{
    background:
      radial-gradient(ellipse 900px 500px at 12% -5%, rgba(61,139,255,.16), transparent 60%),
      radial-gradient(ellipse 800px 500px at 90% 10%, rgba(245,166,35,.10), transparent 60%),
      var(--bg);
    color:var(--text);
    font-family:'Ubuntu', sans-serif;
    -webkit-font-smoothing:antialiased;
    overflow-x:hidden;
  }

  h1,h2,h3,.brand,.plan-name,.price{ font-family:'Sora', sans-serif; }

  a{ color:inherit; text-decoration:none; }

  /* ---------- reveal on scroll ---------- */
  .reveal{
    opacity:0;
    transform:translateY(28px);
    transition:opacity .8s cubic-bezier(.16,.8,.24,1), transform .8s cubic-bezier(.16,.8,.24,1);
  }
  .reveal.in-view{ opacity:1; transform:translateY(0); }
  .reveal.d1{ transition-delay:.08s; }
  .reveal.d2{ transition-delay:.16s; }
  .reveal.d3{ transition-delay:.24s; }

  @media (prefers-reduced-motion: reduce){
    .reveal{ transition:none; opacity:1; transform:none; }
    html{ scroll-behavior:auto; }
  }

  /* ---------- header ---------- */
  header{
    display:flex; align-items:center; justify-content:space-between;
    padding:26px 6vw;
    position:sticky; top:0; z-index:50;
    backdrop-filter:blur(14px);
    background:rgba(10,15,30,.65);
    border-bottom:1px solid rgba(255,255,255,.06);
  }
  .brand{ font-size:22px; font-weight:800; letter-spacing:.5px; }
  .brand span.go{ color:var(--blue-light); }
  .brand span.stay{ color:var(--gold); }
  nav.pill{
    font-size:13px; color:var(--muted); font-family:'Ubuntu';
    border:1px solid var(--card-border); padding:8px 16px; border-radius:999px;
    display:flex; align-items:center; gap:8px;
  }
  nav.pill .dot{ width:6px; height:6px; border-radius:50%; background:var(--success); box-shadow:0 0 8px var(--success); }

  /* ---------- hero ---------- */
  .hero{
    padding:8vw 6vw 5vw;
    text-align:center;
    max-width:900px;
    margin:0 auto;
  }
  .eyebrow{
    display:inline-flex; align-items:center; gap:8px;
    font-family:'Ubuntu'; font-size:13px; letter-spacing:.06em; text-transform:uppercase;
    color:var(--gold-light);
    border:1px solid rgba(245,166,35,.35);
    background:rgba(245,166,35,.08);
    padding:7px 16px; border-radius:999px;
    margin-bottom:26px;
  }
  .hero h1{
    font-size:clamp(34px, 5.4vw, 58px);
    line-height:1.08;
    font-weight:800;
    letter-spacing:-.01em;
  }
  .hero h1 .grad{
    background:linear-gradient(100deg, var(--blue-light), var(--gold-light));
    -webkit-background-clip:text; background-clip:text; color:transparent;
  }
  .hero p{
    margin-top:22px;
    font-size:17px; line-height:1.65;
    color:var(--muted);
    max-width:600px; margin-left:auto; margin-right:auto;
  }
  .hero-note{
    margin-top:32px; display:inline-flex; align-items:center; gap:10px;
    font-size:14px; color:var(--blue-light);
    border:1px solid rgba(61,139,255,.3); background:rgba(61,139,255,.08);
    padding:10px 18px; border-radius:12px; font-family:'Ubuntu';
  }

  /* ---------- section heading ---------- */
  .section-head{ text-align:center; max-width:640px; margin:0 auto 4vw; padding:0 6vw; }
  .section-head h2{ font-size:clamp(28px,3.6vw,40px); font-weight:700; }
  .section-head p{ color:var(--muted); margin-top:14px; font-size:16px; line-height:1.6; }

  /* ---------- carousel ---------- */
  .stage{
    position:relative;
    padding:4vw 6vw 6vw;
    display:flex; flex-direction:column; align-items:center;
  }
  .carousel{
    position:relative;
    width:100%;
    max-width:1040px;
    height:560px;
    display:flex; align-items:center; justify-content:center;
  }
  .card{
    position:absolute;
    width:320px;
    min-height:480px;
    background:linear-gradient(180deg, var(--card), #0e1526);
    border:1px solid var(--card-border);
    border-radius:22px;
    padding:38px 30px 32px;
    display:flex; flex-direction:column;
    transition:transform .6s cubic-bezier(.19,1,.22,1), opacity .6s ease, filter .6s ease, box-shadow .6s ease;
    cursor:pointer;
  }
  .card.active{ cursor:default; }
  .card .badge{
    position:absolute; top:-14px; left:50%; transform:translateX(-50%);
    font-family:'Ubuntu'; font-size:12px; font-weight:700; letter-spacing:.04em;
    padding:6px 16px; border-radius:999px; white-space:nowrap;
    background:linear-gradient(100deg, var(--gold), var(--gold-light));
    color:#1a1200;
  }
  .card .plan-name{ font-size:23px; font-weight:700; margin-bottom:10px; }
  .card .plan-desc{
    font-family:'Ubuntu'; font-size:14.5px; color:var(--muted); line-height:1.55;
    margin-bottom:26px; min-height:66px;
  }
  .card .price{ font-size:15px; color:var(--muted); font-weight:500; margin-bottom:22px; font-family:'Ubuntu'; }
  .card ul{ list-style:none; display:flex; flex-direction:column; gap:14px; margin-bottom:30px; flex:1; }
  .card li{
    display:flex; align-items:flex-start; gap:10px;
    font-family:'Ubuntu'; font-size:14.5px; color:#dbe0ee; line-height:1.4;
  }
  .card li .check{
    flex:none; width:19px; height:19px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:11px; font-weight:700; margin-top:1px;
  }
  .card .cta{
    text-align:center; padding:13px; border-radius:12px;
    font-family:'Sora'; font-weight:600; font-size:14.5px;
    border:1px solid var(--card-border); color:var(--text);
    transition:background .3s, border-color .3s, transform .2s;
  }

  /* tier accents */
  .card[data-tier="starter"] .check{ background:rgba(61,139,255,.15); color:var(--blue-light); }
  .card[data-tier="starter"] .badge{ display:none; }
  .card[data-tier="starter"].active{ box-shadow:0 30px 60px -20px rgba(61,139,255,.45); border-color:rgba(61,139,255,.5); }
  .card[data-tier="starter"].active .cta{ background:rgba(61,139,255,.12); border-color:var(--blue); }

  .card[data-tier="max"] .check{ background:rgba(245,166,35,.18); color:var(--gold-light); }
  .card[data-tier="max"].active{ box-shadow:0 30px 70px -18px rgba(245,166,35,.5); border-color:rgba(245,166,35,.55); }
  .card[data-tier="max"].active .cta{ background:linear-gradient(100deg, var(--gold), var(--gold-light)); color:#1a1200; border-color:transparent; }

  .card[data-tier="pro"] .check{ background:rgba(255,255,255,.08); color:#fff; }
  .card[data-tier="pro"] .badge{ display:none; }
  .card[data-tier="pro"].active{ box-shadow:0 30px 60px -20px rgba(122,178,255,.35); border-image:linear-gradient(120deg, var(--blue), var(--gold)) 1; }
  .card[data-tier="pro"].active .cta{ background:linear-gradient(100deg, var(--blue), var(--blue-light)); border-color:transparent; }

  .card:not(.active):hover{ filter:brightness(1.15); }

  /* controls */
  .controls{ display:flex; align-items:center; gap:22px; margin-top:8px; }
  .arrow{
    width:46px; height:46px; border-radius:50%;
    border:1px solid var(--card-border); background:var(--card-border+00);
    display:flex; align-items:center; justify-content:center;
    color:var(--text); font-size:18px;
    transition:background .25s, border-color .25s, transform .2s;
  }
  .arrow:hover{ background:rgba(255,255,255,.06); border-color:rgba(255,255,255,.25); transform:scale(1.05); }
  .dots{ display:flex; gap:9px; }
  .dots .d{
    width:9px; height:9px; border-radius:50%; background:var(--card-border);
    cursor:pointer; transition:background .3s, width .3s;
  }
  .dots .d.on{ width:26px; border-radius:6px; background:linear-gradient(100deg, var(--blue-light), var(--gold-light)); }

  .web-note{
    margin-top:40px; display:flex; align-items:center; gap:12px;
    font-family:'Ubuntu'; font-size:14px; color:var(--muted);
    padding:14px 22px; border:1px dashed var(--card-border); border-radius:14px;
    max-width:520px; text-align:left;
  }
  .web-note b{ color:var(--text); font-weight:500; }

  /* ---------- pricing ---------- */
  .pricing{
    padding:2vw 6vw 8vw;
  }
  .billing-toggle{
    display:flex; justify-content:center; margin-bottom:4vw;
  }
  .billing-toggle .track{
    display:inline-flex; gap:4px;
    background:var(--card); border:1px solid var(--card-border);
    border-radius:999px; padding:5px;
  }
  .billing-toggle button{
    font-family:'Sora'; font-size:13.5px; font-weight:600;
    color:var(--muted); background:transparent; border:none;
    padding:10px 22px; border-radius:999px; cursor:pointer;
    transition:color .3s, background .3s;
  }
  .billing-toggle button.on{
    color:#0a0f1e;
    background:linear-gradient(100deg, var(--blue-light), var(--gold-light));
  }
  .billing-toggle .save-tag{
    font-family:'Ubuntu'; font-size:11px; font-weight:700;
    margin-left:6px; padding:1px 7px; border-radius:999px;
    background:rgba(47,191,133,.18); color:var(--success);
  }
  .billing-toggle button.on .save-tag{ background:rgba(10,15,30,.15); color:#0a0f1e; }

  .price-grid{
    display:grid; grid-template-columns:repeat(3, 1fr); gap:22px;
    max-width:1040px; margin:0 auto;
  }
  .price-card{
    background:linear-gradient(180deg, var(--card), #0e1526);
    border:1px solid var(--card-border); border-radius:22px;
    padding:32px 26px; position:relative;
    display:flex; flex-direction:column;
  }
  .price-card .plan-name{ font-size:19px; font-weight:700; margin-bottom:6px; }
  .price-card .plan-tag{ font-family:'Ubuntu'; font-size:13px; color:var(--muted); margin-bottom:22px; }
  .price-card .amount{
    font-family:'Sora'; font-weight:800; font-size:36px; line-height:1;
    display:flex; align-items:baseline; gap:6px; min-height:44px;
    transition:opacity .28s ease;
  }
  .price-card .amount .cur{ font-size:16px; font-weight:600; color:var(--muted); }
  .price-card .amount .period{ font-family:'Ubuntu'; font-size:13.5px; color:var(--muted); font-weight:400; }
  .price-card .sub-note{
    font-family:'Ubuntu'; font-size:12.5px; color:var(--muted);
    margin-top:8px; min-height:34px; transition:opacity .28s ease;
  }
  .price-card .sub-note b{ color:var(--success); font-weight:500; }
  .price-card .p-cta{
    margin-top:24px; text-align:center; padding:12px; border-radius:12px;
    font-family:'Sora'; font-weight:600; font-size:14px;
    border:1px solid var(--card-border); color:var(--text);
  }
  .price-card[data-tier="starter"] .amount{ color:var(--text); }
  .price-card[data-tier="max"]{ border-color:rgba(245,166,35,.4); }
  .price-card[data-tier="max"] .amount{ color:var(--gold-light); }
  .price-card[data-tier="max"] .p-cta{ background:linear-gradient(100deg, var(--gold), var(--gold-light)); color:#1a1200; border-color:transparent; }
  .price-card[data-tier="black"]{ border-color:rgba(61,139,255,.4); }
  .price-card[data-tier="black"] .amount{ color:var(--blue-light); }
  .price-card[data-tier="black"] .p-cta{ background:linear-gradient(100deg, var(--blue), var(--blue-light)); color:#fff; border-color:transparent; }

  @media (max-width:820px){
    .price-grid{ grid-template-columns:1fr; }
    .billing-toggle .track{ flex-wrap:wrap; justify-content:center; }
  }

  footer{
    text-align:center; padding:40px 6vw 60px;
    color:var(--muted); font-size:13px; font-family:'Ubuntu';
    border-top:1px solid rgba(255,255,255,.06);
  }

  @media (max-width:720px){
    .carousel{ height:auto; min-height:520px; }
    .card{ width:78vw; min-height:440px; padding:30px 22px 26px; }
    header{ padding:20px 5vw; }
    nav.pill span.txt{ display:none; }
  }
</style>
</head>
<body>

<header>
  <div class="brand"><span class="go">Go</span><span class="stay">Stay</span></div>
  <nav class="pill"><span class="dot"></span><span class="txt">100% online</span></nav>
</header>

<section class="hero">
  <div class="eyebrow reveal">Assinatura GoStay</div>
  <h1 class="reveal d1">O plano certo pra você <span class="grad">avançar no seu ritmo</span></h1>
  <p class="reveal d2">Conteúdo, mentoria e comunidade direto no navegador — sem instalar nada, sem ocupar espaço no seu dispositivo. Escolha o plano abaixo e comece agora.</p>
  <div class="hero-note reveal d3">↓ Arraste o carrossel para comparar os planos</div>
</section>

<section class="stage">
  <div class="section-head reveal">
    <h2>Planos GoStay</h2>
    <p>Três formas de estudar com a gente. Navegue pelo carrossel e escolha a que combina com o seu momento.</p>
  </div>

  <div class="carousel reveal d1" id="carousel">
    <!-- cards injected by JS -->
  </div>

  <div class="controls reveal d2">
    <div class="arrow" id="prev">‹</div>
    <div class="dots" id="dots"></div>
    <div class="arrow" id="next">›</div>
  </div>

  <div class="web-note reveal d3">
    <span>🌐</span>
    <span><b>Sistema 100% web.</b> Todo o conteúdo é assistido direto pelo navegador — não há aplicativo nem download para uso offline.</span>
  </div>
</section>

<section class="pricing">
  <div class="section-head reveal">
    <h2>Valores</h2>
    <p>Quanto mais tempo de plano, maior a economia. Compare mensal, trimestral e anual.</p>
  </div>

  <div class="billing-toggle reveal d1">
    <div class="track" id="billingTrack">
      <button data-period="mensal" class="on">Mensal</button>
      <button data-period="trimestral">Trimestral <span class="save-tag">-11%</span></button>
      <button data-period="anual">Anual <span class="save-tag">-32%</span></button>
    </div>
  </div>

  <div class="price-grid reveal d2" id="priceGrid"></div>
</section>

<footer class="reveal">© 2026 GoStay. Todos os direitos reservados.</footer>

<script>
  const plans = [
    {
      tier: 'starter',
      name: 'GoStay Starter',
      desc: 'Ideal para quem está começando e quer explorar conteúdos essenciais com flexibilidade.',
      price: 'Para começar com o pé direito',
      features: [
        'Acesso a cursos selecionados',
        'Certificado digital',
        'Suporte por e-mail',
        'Atualizações mensais'
      ],
      cta: 'Começar com o Starter',
      badge: null
    },
    {
      tier: 'max',
      name: 'GoStay Max',
      desc: 'Grandes aulas, experiências imperdíveis e os melhores professores em um único plano.',
      price: 'O favorito da comunidade',
      features: [
        'Acesso completo ao catálogo',
        'Certificados reconhecidos',
        'Mentoria ao vivo mensal',
        'Suporte prioritário 24/7'
      ],
      cta: 'Assinar o Max',
      badge: 'Mais popular'
    },
    {
      tier: 'pro',
      name: 'GoStay Pro',
      desc: 'Para profissionais que querem o máximo em crescimento acelerado e networking de alto nível.',
      price: 'Para quem quer ir além',
      features: [
        'Tudo do Max',
        'Trilhas personalizadas com IA',
        'Acesso antecipado a lançamentos',
        'Comunidade exclusiva Pro'
      ],
      cta: 'Ir para o Pro',
      badge: null
    }
  ];

  const carousel = document.getElementById('carousel');
  const dotsWrap = document.getElementById('dots');
  let active = 1; // start on GoStay Max, the highlighted plan

  function checkIcon(){ return '✓'; }

  plans.forEach((p, i) => {
    const card = document.createElement('div');
    card.className = 'card';
    card.dataset.tier = p.tier;
    card.dataset.index = i;
    card.innerHTML = `
      ${p.badge ? `<div class="badge">${p.badge}</div>` : ''}
      <div class="plan-name">${p.name}</div>
      <div class="plan-desc">${p.desc}</div>
      <div class="price">${p.price}</div>
      <ul>
        ${p.features.map(f => `<li><span class="check">${checkIcon()}</span>${f}</li>`).join('')}
      </ul>
      <div class="cta">${p.cta}</div>
    `;
    card.addEventListener('click', () => { active = i; render(); });
    carousel.appendChild(card);

    const dot = document.createElement('div');
    dot.className = 'd';
    dot.addEventListener('click', () => { active = i; render(); });
    dotsWrap.appendChild(dot);
  });

  const cards = Array.from(carousel.querySelectorAll('.card'));
  const dots = Array.from(dotsWrap.querySelectorAll('.d'));

  function render(){
    const n = plans.length;
    cards.forEach((card, i) => {
      let diff = i - active;
      if (diff > n/2) diff -= n;
      if (diff < -n/2) diff += n;

      const spacing = window.innerWidth < 720 ? 0 : 320;
      const x = diff * spacing + (window.innerWidth < 720 ? diff * 20 : 0);
      const scale = diff === 0 ? 1 : 0.82;
      const opacity = diff === 0 ? 1 : (Math.abs(diff) === 1 ? 0.45 : 0);
      const z = diff === 0 ? 3 : 1;

      card.style.transform = `translateX(${x}px) scale(${scale})`;
      card.style.opacity = opacity;
      card.style.zIndex = z;
      card.style.pointerEvents = Math.abs(diff) <= 1 ? 'auto' : 'none';
      card.classList.toggle('active', diff === 0);
    });
    dots.forEach((d, i) => d.classList.toggle('on', i === active));
  }

  document.getElementById('prev').addEventListener('click', () => {
    active = (active - 1 + plans.length) % plans.length; render();
  });
  document.getElementById('next').addEventListener('click', () => {
    active = (active + 1) % plans.length; render();
  });

  let autoplay = setInterval(() => {
    active = (active + 1) % plans.length; render();
  }, 5500);
  carousel.addEventListener('mouseenter', () => clearInterval(autoplay));
  carousel.addEventListener('mouseleave', () => {
    autoplay = setInterval(() => { active = (active + 1) % plans.length; render(); }, 5500);
  });

  window.addEventListener('resize', render);
  render();

  // ---------- pricing section ----------
  const pricingData = [
    {
      tier: 'starter',
      name: 'GoStay Starter',
      tag: 'Pra explorar sem compromisso',
      cta: 'Começar grátis',
      mensal: { amount: 'Grátis', note: 'Sem cartão de crédito. Para sempre.' },
      trimestral: { amount: 'Grátis', note: 'Sem cartão de crédito. Para sempre.' },
      anual: { amount: 'Grátis', note: 'Sem cartão de crédito. Para sempre.' }
    },
    {
      tier: 'max',
      name: 'GoStay Max',
      tag: 'O favorito da comunidade',
      cta: 'Assinar o Max',
      mensal: { amount: '59,90', period: '/mês', note: 'Cobrado todo mês.' },
      trimestral: { amount: '159,90', period: '/trimestre', note: 'Equivale a <b>R$ 53,30/mês</b> — economia de 11%.' },
      anual: { amount: '499,90', period: '/ano', note: 'Equivale a <b>R$ 41,66/mês</b> — economia de 30%.' }
    },
    {
      tier: 'black',
      name: 'GoStay Black',
      tag: 'Para quem quer ir além',
      cta: 'Assinar o Black',
      mensal: { amount: '89,90', period: '/mês', note: 'Cobrado todo mês.' },
      trimestral: { amount: '239,90', period: '/trimestre', note: 'Equivale a <b>R$ 79,97/mês</b> — economia de 11%.' },
      anual: { amount: '699,90', period: '/ano', note: 'Equivale a <b>R$ 58,33/mês</b> — economia de 35%.' }
    }
  ];

  const priceGrid = document.getElementById('priceGrid');

  pricingData.forEach(p => {
    const card = document.createElement('div');
    card.className = 'price-card';
    card.dataset.tier = p.tier;
    card.innerHTML = `
      <div class="plan-name">${p.name}</div>
      <div class="plan-tag">${p.tag}</div>
      <div class="amount" data-field="amount"></div>
      <div class="sub-note" data-field="note"></div>
      <div class="p-cta">${p.cta}</div>
    `;
    priceGrid.appendChild(card);
  });

  function paintPricing(period){
    pricingData.forEach(p => {
      const card = priceGrid.querySelector(`[data-tier="${p.tier}"]`);
      const amountEl = card.querySelector('[data-field="amount"]');
      const noteEl = card.querySelector('[data-field="note"]');
      const d = p[period];

      amountEl.style.opacity = 0;
      noteEl.style.opacity = 0;

      setTimeout(() => {
        amountEl.innerHTML = d.amount === 'Grátis'
          ? d.amount
          : `<span class="cur">R$</span>${d.amount}<span class="period">${d.period}</span>`;
        noteEl.innerHTML = d.note;
        amountEl.style.opacity = 1;
        noteEl.style.opacity = 1;
      }, 140);
    });
  }

  const billingButtons = document.querySelectorAll('#billingTrack button');
  billingButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      billingButtons.forEach(b => b.classList.remove('on'));
      btn.classList.add('on');
      paintPricing(btn.dataset.period);
    });
  });

  paintPricing('mensal');

  // ---------- reveal on scroll ----------
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in-view'); });
  }, { threshold: 0.15 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</body>
</html>