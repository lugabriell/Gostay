<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PriceIQ — Calculadora Estratégica de Precificação</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Mono:wght@300;400;500&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --blue: #0EA5E9;
    --blue-bright: #38BDF8;
    --blue-dim: #0369A1;
    --blue-glow: rgba(14, 165, 233, 0.18);
    --blue-border: rgba(56, 189, 248, 0.25);
    --blue-border-active: rgba(56, 189, 248, 0.6);
    --bg-void: #060810;
    --bg-deep: #090C14;
    --bg-card: rgba(12, 16, 28, 0.92);
    --bg-card2: rgba(15, 20, 36, 0.85);
    --bg-field: rgba(8, 12, 22, 0.9);
    --text-white: #F0F4FF;
    --text-muted: #6B7A99;
    --text-dim: #3A4560;
    --green: #10B981;
    --red: #EF4444;
    --amber: #F59E0B;
    --grid-line: rgba(56, 189, 248, 0.04);
    --border-dim: rgba(56, 189, 248, 0.1);
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'Instrument Sans', sans-serif;
    background: var(--bg-void);
    color: var(--text-white);
    min-height: 100vh;
    overflow-x: hidden;
    position: relative;
  }

  /* Grid background */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image:
      linear-gradient(var(--grid-line) 1px, transparent 1px),
      linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
    z-index: 0;
  }

  /* Ambient glow blobs */
  body::after {
    content: '';
    position: fixed;
    top: -20%;
    left: -10%;
    width: 60%;
    height: 60%;
    background: radial-gradient(ellipse, rgba(14,165,233,0.06) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
  }

  .glow-blob-right {
    position: fixed;
    bottom: -20%;
    right: -10%;
    width: 50%;
    height: 50%;
    background: radial-gradient(ellipse, rgba(14,165,233,0.05) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
  }

  .app-wrap {
    position: relative;
    z-index: 1;
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 24px 80px;
  }

  /* ── HEADER ── */
  header {
    padding: 32px 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--border-dim);
    margin-bottom: 36px;
  }

  .logo-area { display: flex; align-items: center; gap: 14px; }
  .logo-icon {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, var(--blue-dim), var(--blue));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'DM Mono', monospace;
    font-size: 18px; font-weight: 500;
    color: #fff;
    box-shadow: 0 0 20px rgba(14,165,233,0.3);
  }
  .logo-text {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.5px;
    color: var(--text-white);
  }
  .logo-sub {
    font-size: 11px;
    color: var(--text-muted);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    font-weight: 400;
  }

  .header-right { display: flex; align-items: center; gap: 20px; }

  .score-pill {
    display: flex; align-items: center; gap: 10px;
    padding: 8px 18px;
    background: var(--bg-card);
    border: 1px solid var(--blue-border);
    border-radius: 100px;
  }
  .score-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--blue-bright);
    box-shadow: 0 0 8px var(--blue);
    animation: pulse 2s infinite;
  }
  @keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.8); }
  }
  .score-label { font-size: 12px; color: var(--text-muted); }
  .score-val {
    font-family: 'DM Mono', monospace;
    font-size: 14px;
    color: var(--blue-bright);
    font-weight: 500;
  }

  .categoria-badge {
    font-size: 11px;
    padding: 5px 12px;
    border: 1px solid var(--blue-border);
    border-radius: 100px;
    color: var(--blue-bright);
    background: rgba(14,165,233,0.08);
    letter-spacing: 0.06em;
    font-weight: 500;
    text-transform: uppercase;
  }

  .btn-primary {
    display: flex; align-items: center; gap: 8px;
    padding: 10px 22px;
    background: linear-gradient(135deg, var(--blue-dim), var(--blue));
    border: none;
    border-radius: 10px;
    color: #fff;
    font-family: 'Instrument Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 0 20px rgba(14,165,233,0.25);
    letter-spacing: 0.02em;
  }
  .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 0 32px rgba(14,165,233,0.45);
  }
  .btn-primary:active { transform: scale(0.98); }

  /* ── GRID LAYOUT ── */
  .main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
  }
  .main-grid-bottom {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
  }

  /* ── CARDS ── */
  .card {
    background: var(--bg-card);
    border: 1px solid var(--border-dim);
    border-radius: 16px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    transition: border-color 0.25s, box-shadow 0.25s;
  }
  .card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(14,165,233,0.03) 0%, transparent 60%);
    pointer-events: none;
  }
  .card:hover {
    border-color: var(--blue-border-active);
    box-shadow: 0 0 24px rgba(14,165,233,0.08), inset 0 0 24px rgba(14,165,233,0.02);
  }

  .card-title {
    font-family: 'Syne', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--blue-bright);
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .card-title::before {
    content: '';
    width: 3px; height: 14px;
    background: var(--blue);
    border-radius: 2px;
    box-shadow: 0 0 6px var(--blue);
  }

  /* ── FORM FIELDS ── */
  .field { margin-bottom: 14px; }
  .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 14px; }

  label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: var(--text-muted);
    margin-bottom: 6px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  input[type="text"],
  input[type="number"],
  select {
    width: 100%;
    padding: 10px 14px;
    background: var(--bg-field);
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    color: var(--text-white);
    font-family: 'DM Mono', monospace;
    font-size: 13px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    -webkit-appearance: none;
  }
  input[type="text"]::placeholder,
  input[type="number"]::placeholder { color: var(--text-dim); }
  input:focus, select:focus {
    border-color: var(--blue-border-active);
    box-shadow: 0 0 0 3px rgba(14,165,233,0.1), 0 0 12px rgba(14,165,233,0.12);
  }
  select { cursor: pointer; }
  select option { background: #0C1020; }

  /* ── SLIDERS ── */
  .slider-wrap { margin-bottom: 16px; }
  .slider-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }
  .slider-label {
    font-size: 11px;
    font-weight: 500;
    color: var(--text-muted);
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }
  .slider-val {
    font-family: 'DM Mono', monospace;
    font-size: 16px;
    font-weight: 500;
    color: var(--blue-bright);
  }

  input[type="range"] {
    -webkit-appearance: none;
    width: 100%;
    height: 4px;
    background: rgba(56,189,248,0.15);
    border-radius: 2px;
    outline: none;
    cursor: pointer;
  }
  input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 18px; height: 18px;
    background: var(--blue);
    border-radius: 50%;
    border: 2px solid rgba(14,165,233,0.4);
    box-shadow: 0 0 10px rgba(14,165,233,0.5);
    cursor: pointer;
    transition: box-shadow 0.2s;
  }
  input[type="range"]::-webkit-slider-thumb:hover {
    box-shadow: 0 0 18px rgba(14,165,233,0.8);
  }

  /* ── PROCEDIMENTO TAG ── */
  .proc-list { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
  .proc-tag {
    display: flex; align-items: center; gap: 6px;
    padding: 5px 12px;
    background: rgba(14,165,233,0.08);
    border: 1px solid var(--blue-border);
    border-radius: 100px;
    font-size: 12px;
    color: var(--blue-bright);
    cursor: pointer;
    transition: all 0.15s;
    font-weight: 500;
  }
  .proc-tag:hover { background: rgba(14,165,233,0.18); }
  .proc-tag.active {
    background: rgba(14,165,233,0.22);
    border-color: var(--blue-border-active);
    box-shadow: 0 0 10px rgba(14,165,233,0.2);
  }
  .proc-tag-x { color: var(--text-dim); font-size: 14px; line-height: 1; }

  /* ── RESULTADO HERO ── */
  .result-hero {
    grid-column: 1 / -1;
    background: linear-gradient(135deg, rgba(10,16,32,0.98), rgba(6,10,22,0.98));
    border: 1px solid rgba(56,189,248,0.35);
    border-radius: 20px;
    padding: 36px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 60px rgba(14,165,233,0.1), inset 0 0 60px rgba(14,165,233,0.03);
  }
  .result-hero::after {
    content: '';
    position: absolute;
    top: -40%; right: -10%;
    width: 400px; height: 400px;
    background: radial-gradient(ellipse, rgba(14,165,233,0.08) 0%, transparent 70%);
    pointer-events: none;
  }

  .result-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr 1fr 1fr;
    gap: 32px;
    align-items: start;
  }

  .result-main {}
  .result-eyebrow {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--blue-bright);
    margin-bottom: 12px;
  }
  .result-price-range {
    font-family: 'Syne', sans-serif;
    font-size: 52px;
    font-weight: 800;
    line-height: 1;
    color: #fff;
    letter-spacing: -2px;
    text-shadow: 0 0 40px rgba(14,165,233,0.3);
    margin-bottom: 4px;
  }
  .result-price-sub {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 20px;
  }

  .result-alert {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
  }
  .alert-ok { background: rgba(16,185,129,0.12); color: #10B981; border: 1px solid rgba(16,185,129,0.25); }
  .alert-warn { background: rgba(245,158,11,0.12); color: #F59E0B; border: 1px solid rgba(245,158,11,0.25); }
  .alert-danger { background: rgba(239,68,68,0.12); color: #EF4444; border: 1px solid rgba(239,68,68,0.25); }

  .result-metric {}
  .result-metric-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--text-dim);
    margin-bottom: 8px;
  }
  .result-metric-val {
    font-family: 'Syne', sans-serif;
    font-size: 30px;
    font-weight: 800;
    letter-spacing: -1px;
    margin-bottom: 6px;
  }
  .result-bar-wrap {
    height: 4px;
    background: rgba(255,255,255,0.06);
    border-radius: 2px;
    overflow: hidden;
    margin-top: 8px;
  }
  .result-bar {
    height: 100%;
    border-radius: 2px;
    transition: width 0.8s cubic-bezier(0.22,1,0.36,1);
  }

  /* ── SCORE RING ── */
  .score-ring-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }
  .score-ring {
    width: 80px; height: 80px;
    position: relative;
  }
  .score-ring svg { transform: rotate(-90deg); }
  .score-ring-label {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #fff;
  }
  .score-ring-sub { font-size: 11px; color: var(--text-muted); text-align: center; }

  /* ── MERCADO ── */
  .mkt-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
  }
  .mkt-label { font-size: 12px; color: var(--text-muted); width: 120px; flex-shrink: 0; }
  .mkt-bar-bg {
    flex: 1;
    height: 6px;
    background: rgba(255,255,255,0.05);
    border-radius: 3px;
    overflow: hidden;
    position: relative;
  }
  .mkt-bar {
    height: 100%;
    border-radius: 3px;
    transition: width 0.8s cubic-bezier(0.22,1,0.36,1);
  }
  .mkt-pct {
    font-family: 'DM Mono', monospace;
    font-size: 12px;
    color: var(--blue-bright);
    width: 40px;
    text-align: right;
  }

  /* ── RADAR ── */
  .radar-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* ── MINI CHART ── */
  .mini-chart { margin-top: 14px; }

  /* ── BOTTOM GRID ── */
  .full-row { grid-column: 1 / -1; }

  /* ── INSUMO ITEM ── */
  .insumo-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border-dim);
  }
  .insumo-item:last-child { border-bottom: none; }
  .insumo-name { font-size: 13px; color: var(--text-white); }
  .insumo-cost {
    font-family: 'DM Mono', monospace;
    font-size: 13px;
    color: var(--blue-bright);
  }
  .insumo-add-btn {
    display: flex; align-items: center; gap: 6px;
    padding: 7px 14px;
    background: transparent;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    color: var(--blue-bright);
    font-size: 12px;
    cursor: pointer;
    transition: all 0.15s;
    font-family: 'Instrument Sans', sans-serif;
    margin-top: 10px;
    width: 100%;
    justify-content: center;
    font-weight: 500;
  }
  .insumo-add-btn:hover {
    background: rgba(14,165,233,0.1);
    border-color: var(--blue-border-active);
  }

  /* ── TABS ── */
  .tabs { display: flex; gap: 4px; margin-bottom: 18px; }
  .tab {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid transparent;
    color: var(--text-muted);
    transition: all 0.15s;
    background: transparent;
    font-family: 'Instrument Sans', sans-serif;
  }
  .tab.active {
    background: rgba(14,165,233,0.12);
    border-color: var(--blue-border);
    color: var(--blue-bright);
  }

  /* ── FOOTER STRIP ── */
  .calc-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 24px;
    border-top: 1px solid var(--border-dim);
    margin-top: 8px;
  }
  .footer-info { font-size: 11px; color: var(--text-dim); letter-spacing: 0.04em; }
  .footer-time {
    font-family: 'DM Mono', monospace;
    font-size: 11px;
    color: var(--text-dim);
  }

  /* ── ANIM ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .card { animation: fadeUp 0.5s ease both; }
  .card:nth-child(1) { animation-delay: 0.05s; }
  .card:nth-child(2) { animation-delay: 0.10s; }
  .card:nth-child(3) { animation-delay: 0.15s; }
  .card:nth-child(4) { animation-delay: 0.20s; }
  .card:nth-child(5) { animation-delay: 0.25s; }
  .card:nth-child(6) { animation-delay: 0.30s; }

  .num-anim {
    transition: all 0.5s cubic-bezier(0.22,1,0.36,1);
  }

  /* Scrollbar */
  ::-webkit-scrollbar { width: 6px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: rgba(14,165,233,0.2); border-radius: 3px; }

  @media (max-width: 1024px) {
    .main-grid { grid-template-columns: 1fr 1fr; }
    .result-grid { grid-template-columns: 1fr 1fr; gap: 20px; }
    .result-price-range { font-size: 38px; }
  }
  @media (max-width: 700px) {
    .main-grid, .main-grid-bottom { grid-template-columns: 1fr; }
    header { flex-wrap: wrap; gap: 12px; }
    .result-grid { grid-template-columns: 1fr; }
    .result-price-range { font-size: 34px; }
    .result-hero { padding: 24px; }
  }
</style>
</head>
<body>

<div class="glow-blob-right"></div>

<div class="app-wrap">

  <!-- HEADER -->
  <header>
    <div class="logo-area">
      <div class="logo-icon">Σ</div>
      <div>
        <div class="logo-text">PriceIQ</div>
        <div class="logo-sub">Calculadora Estratégica de Precificação</div>
      </div>
    </div>
    <div class="header-right">
      <div class="score-pill">
        <div class="score-dot"></div>
        <span class="score-label">Score Estratégico</span>
        <span class="score-val" id="headerScore">—</span>
      </div>
      <div class="categoria-badge" id="headerCategoria">Clínica Padrão</div>
      <button class="btn-primary" onclick="calcular()">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        Gerar Análise
      </button>
    </div>
  </header>

  <!-- RESULTADO HERO -->
  <div class="result-hero" id="resultHero" style="margin-bottom:16px; display:none;">
    <div class="result-grid">
      <div class="result-main">
        <div class="result-eyebrow">★ Faixa de Preço Recomendada</div>
        <div class="result-price-range" id="rPreco">R$ —</div>
        <div class="result-price-sub" id="rSubtitle">Configure os campos e clique em Gerar Análise</div>
        <div class="result-alert alert-ok" id="rAlert" style="display:none;"></div>
      </div>

      <div class="result-metric">
        <div class="result-metric-label">Margem Estimada</div>
        <div class="result-metric-val" id="rMargem" style="color: #10B981;">—%</div>
        <div class="result-bar-wrap">
          <div class="result-bar" id="rMargemBar" style="width:0%; background: linear-gradient(90deg, #10B981, #34D399);"></div>
        </div>
        <div style="font-size:11px; color:var(--text-muted); margin-top:6px;" id="rMargemTxt">—</div>
      </div>

      <div class="result-metric">
        <div class="result-metric-label">Nível Competitivo</div>
        <div class="result-metric-val" id="rNivel" style="color: var(--blue-bright);">—</div>
        <div class="result-bar-wrap">
          <div class="result-bar" id="rNivelBar" style="width:0%; background: linear-gradient(90deg, var(--blue-dim), var(--blue-bright));"></div>
        </div>
        <div style="font-size:11px; color:var(--text-muted); margin-top:6px;" id="rNivelTxt">—</div>
      </div>

      <div class="score-ring-wrap">
        <div class="result-metric-label" style="margin-bottom:0; font-size:10px; letter-spacing:0.12em;">Saúde Comercial</div>
        <div class="score-ring">
          <svg viewBox="0 0 80 80" width="80" height="80">
            <circle cx="40" cy="40" r="32" fill="none" stroke="rgba(56,189,248,0.1)" stroke-width="6"/>
            <circle cx="40" cy="40" r="32" fill="none" stroke="url(#scoreGrad)" stroke-width="6"
              stroke-dasharray="201" stroke-dashoffset="201" stroke-linecap="round" id="scoreCircle"/>
            <defs>
              <linearGradient id="scoreGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#0369A1"/>
                <stop offset="100%" stop-color="#38BDF8"/>
              </linearGradient>
            </defs>
          </svg>
          <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <span class="score-ring-label" id="rScoreNum">0</span>
          </div>
        </div>
        <div class="score-ring-sub" id="rScoreTxt">Análise pendente</div>
      </div>
    </div>
  </div>

  <!-- MAIN GRID: 3 cols -->
  <div class="main-grid">

    <!-- CARD 1: CONFIGURAÇÃO DA CLÍNICA -->
    <div class="card">
      <div class="card-title">Configuração da Clínica</div>
      <div class="field">
        <label>Nome da Clínica</label>
        <input type="text" id="nomeClinica" placeholder="Ex: Studio Aesthetic" oninput="atualizarCategoria()">
      </div>
      <div class="field">
        <label>Segmento</label>
        <select id="segmento" onchange="atualizarCategoria()">
          <option value="estetica_facial">Estética Facial</option>
          <option value="corporal">Corporal & Modelagem</option>
          <option value="capilar">Tricologia Capilar</option>
          <option value="oncoestetica">Oncoestetica</option>
          <option value="integrativa">Estética Integrativa</option>
          <option value="premium">Clínica Premium Multiespecialidade</option>
        </select>
      </div>
      <div class="field-row">
        <div>
          <label>Cidade</label>
          <input type="text" id="cidade" placeholder="São Paulo">
        </div>
        <div>
          <label>Porte</label>
          <select id="porte" onchange="atualizarCategoria()">
            <option value="micro">Micro (1-2 salas)</option>
            <option value="pequeno">Pequeno (3-5 salas)</option>
            <option value="medio">Médio (6-10 salas)</option>
            <option value="grande">Grande (10+ salas)</option>
          </select>
        </div>
      </div>
      <div class="slider-wrap">
        <div class="slider-header">
          <span class="slider-label">Anos de Experiência</span>
          <span class="slider-val" id="expVal">3 anos</span>
        </div>
        <input type="range" min="0" max="30" value="3" step="1" id="experiencia"
          oninput="document.getElementById('expVal').textContent=this.value+(this.value==1?' ano':' anos'); calcular()">
      </div>
    </div>

    <!-- CARD 2: ESTRUTURA OPERACIONAL -->
    <div class="card">
      <div class="card-title">Estrutura Operacional</div>
      <div class="field-row">
        <div>
          <label>Aluguel Mensal (R$)</label>
          <input type="number" id="aluguel" placeholder="3500" value="3500" oninput="calcular()">
        </div>
        <div>
          <label>Nº de Funcionários</label>
          <input type="number" id="funcionarios" placeholder="3" value="3" oninput="calcular()">
        </div>
      </div>
      <div class="field-row">
        <div>
          <label>Salário Médio (R$)</label>
          <input type="number" id="salarioMedio" placeholder="2500" value="2500" oninput="calcular()">
        </div>
        <div>
          <label>Outros Fixos (R$)</label>
          <input type="number" id="outrosFixos" placeholder="1200" value="1200" oninput="calcular()">
        </div>
      </div>
      <div class="slider-wrap">
        <div class="slider-header">
          <span class="slider-label">Atendimentos/mês</span>
          <span class="slider-val" id="atendVal">80</span>
        </div>
        <input type="range" min="10" max="500" value="80" step="5" id="atendimentos"
          oninput="document.getElementById('atendVal').textContent=this.value; calcular()">
      </div>
      <div class="slider-wrap">
        <div class="slider-header">
          <span class="slider-label">Taxa de Ocupação</span>
          <span class="slider-val" id="ocpVal">70%</span>
        </div>
        <input type="range" min="20" max="100" value="70" step="1" id="ocupacao"
          oninput="document.getElementById('ocpVal').textContent=this.value+'%'; calcular()">
      </div>
    </div>

    <!-- CARD 3: BIBLIOTECA DE PROCEDIMENTOS -->
    <div class="card">
      <div class="card-title">Biblioteca de Procedimentos</div>
      <div class="field">
        <label>Procedimento Principal</label>
        <select id="procedimento" onchange="atualizarProc()">
          <option value="limpeza_pele">Limpeza de Pele Profunda</option>
          <option value="botox">Toxina Botulínica (Botox)</option>
          <option value="preenchimento">Preenchimento Facial</option>
          <option value="peeling">Peeling Químico</option>
          <option value="laser">Laser & Fototerapia</option>
          <option value="radiofrequencia">Radiofrequência</option>
          <option value="carboxiterapia">Carboxiterapia</option>
          <option value="drenagem">Drenagem Linfática</option>
          <option value="massagem_modeladora">Massagem Modeladora</option>
          <option value="microagulhamento">Microagulhamento</option>
        </select>
      </div>
      <div style="margin-bottom:14px;">
        <label>Serviços Ofertados</label>
        <div class="proc-list" id="procList">
          <div class="proc-tag active" data-proc="facial">Facial</div>
          <div class="proc-tag active" data-proc="corporal">Corporal</div>
          <div class="proc-tag" data-proc="laser">Laser</div>
          <div class="proc-tag" data-proc="injetaveis">Injetáveis</div>
          <div class="proc-tag" data-proc="capilares">Capilares</div>
          <div class="proc-tag" data-proc="oncoestetica">Oncoestetica</div>
        </div>
      </div>
      <div class="field-row">
        <div>
          <label>Tempo do Proc. (min)</label>
          <input type="number" id="tempoProc" placeholder="60" value="60" oninput="calcular()">
        </div>
        <div>
          <label>Dificuldade Técnica</label>
          <select id="dificuldade" onchange="calcular()">
            <option value="1">Básica</option>
            <option value="1.3" selected>Intermediária</option>
            <option value="1.7">Avançada</option>
            <option value="2.2">Especializada</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- GRID BOTTOM: 2 cols -->
  <div class="main-grid-bottom">

    <!-- CARD 4: CUSTOS & INSUMOS -->
    <div class="card">
      <div class="card-title">Custos & Insumos</div>
      <div id="insumosList">
        <div class="insumo-item">
          <span class="insumo-name">Produto/Ativo Principal</span>
          <input type="number" id="custoInsumo1" placeholder="45" value="45" style="width:100px;" oninput="calcular()">
        </div>
        <div class="insumo-item">
          <span class="insumo-name">Descartáveis & EPI</span>
          <input type="number" id="custoInsumo2" placeholder="12" value="12" style="width:100px;" oninput="calcular()">
        </div>
        <div class="insumo-item">
          <span class="insumo-name">Energia & Manutenção</span>
          <input type="number" id="custoInsumo3" placeholder="8" value="8" style="width:100px;" oninput="calcular()">
        </div>
        <div class="insumo-item">
          <span class="insumo-name">Depreciação Equipamentos</span>
          <input type="number" id="custoInsumo4" placeholder="15" value="15" style="width:100px;" oninput="calcular()">
        </div>
      </div>
      <button class="insumo-add-btn" onclick="adicionarInsumo()">+ Adicionar Insumo</button>

      <div style="margin-top:16px; padding-top:14px; border-top:1px solid var(--border-dim);">
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <span style="font-size:12px; color:var(--text-muted);">Total de Custos Variáveis</span>
          <span style="font-family:'DM Mono',monospace; font-size:18px; color:var(--blue-bright); font-weight:500;" id="totalInsumos">R$ 80,00</span>
        </div>
      </div>
    </div>

    <!-- CARD 5: MARGEM & METAS -->
    <div class="card">
      <div class="card-title">Margem de Lucro & Metas</div>
      <div class="slider-wrap">
        <div class="slider-header">
          <span class="slider-label">Margem de Lucro Desejada</span>
          <span class="slider-val" id="margemVal">45%</span>
        </div>
        <input type="range" min="5" max="85" value="45" step="1" id="margemLucro"
          oninput="document.getElementById('margemVal').textContent=this.value+'%'; calcular()">
      </div>
      <div class="slider-wrap">
        <div class="slider-header">
          <span class="slider-label">Ticket Médio Desejado</span>
          <span class="slider-val" id="ticketVal">R$ 250</span>
        </div>
        <input type="range" min="50" max="3000" value="250" step="10" id="ticketDesejado"
          oninput="document.getElementById('ticketVal').textContent='R$ '+this.value; calcular()">
      </div>
      <div class="slider-wrap">
        <div class="slider-header">
          <span class="slider-label">Meta de Faturamento/mês</span>
          <span class="slider-val" id="metaVal">R$ 20.000</span>
        </div>
        <input type="range" min="2000" max="200000" value="20000" step="500" id="metaFat"
          oninput="document.getElementById('metaVal').textContent='R$ '+Number(this.value).toLocaleString('pt-BR'); calcular()">
      </div>
      <div class="field">
        <label>Posicionamento de Mercado</label>
        <select id="posicionamento" onchange="calcular()">
          <option value="0.75">Popular — Acessível</option>
          <option value="1.0" selected>Padrão — Custo-benefício</option>
          <option value="1.35">Premium — Alto padrão</option>
          <option value="1.75">Luxo — Exclusivo</option>
        </select>
      </div>
    </div>

  </div>

  <!-- INTELIGÊNCIA DE MERCADO -->
  <div class="main-grid">
    <div class="card" style="grid-column: 1 / 2;">
      <div class="card-title">Inteligência de Mercado</div>
      <div class="field-row">
        <div>
          <label>Preço Médio Regional (R$)</label>
          <input type="number" id="precioRegional" placeholder="180" value="180" oninput="calcular()">
        </div>
        <div>
          <label>Nº de Concorrentes</label>
          <input type="number" id="concorrentes" placeholder="8" value="8" oninput="calcular()">
        </div>
      </div>
      <div style="margin-top:8px;">
        <label style="margin-bottom:10px; display:block;">Comparativo de Mercado</label>
        <div class="mkt-row">
          <span class="mkt-label">Seu Preço</span>
          <div class="mkt-bar-bg">
            <div class="mkt-bar" id="mktBarSeu" style="width:50%; background:linear-gradient(90deg,var(--blue-dim),var(--blue-bright));"></div>
          </div>
          <span class="mkt-pct" id="mktPctSeu">—</span>
        </div>
        <div class="mkt-row">
          <span class="mkt-label">Média Regional</span>
          <div class="mkt-bar-bg">
            <div class="mkt-bar" id="mktBarReg" style="width:40%; background:rgba(107,122,153,0.5);"></div>
          </div>
          <span class="mkt-pct" id="mktPctReg">—</span>
        </div>
        <div class="mkt-row">
          <span class="mkt-label">Mínimo Viável</span>
          <div class="mkt-bar-bg">
            <div class="mkt-bar" id="mktBarMin" style="width:25%; background:rgba(239,68,68,0.4);"></div>
          </div>
          <span class="mkt-pct" id="mktPctMin">—</span>
        </div>
        <div class="mkt-row">
          <span class="mkt-label">Preço Premium</span>
          <div class="mkt-bar-bg">
            <div class="mkt-bar" id="mktBarPrem" style="width:80%; background:rgba(245,158,11,0.5);"></div>
          </div>
          <span class="mkt-pct" id="mktPctPrem">—</span>
        </div>
      </div>
    </div>


    <div class="card" style="grid-column: 2 / 2;">
      <div class="card-title">Projeção Financeira</div>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:14px;">
        <div style="background:rgba(14,165,233,0.07); border:1px solid var(--blue-border); border-radius:10px; padding:14px;">
          <div style="font-size:10px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.1em; margin-bottom:6px;">Faturamento Proj.</div>
          <div style="font-family:'Syne',sans-serif; font-size:20px; font-weight:800; color:var(--blue-bright);" id="projFat">—</div>
        </div>
        <div style="background:rgba(16,185,129,0.07); border:1px solid rgba(16,185,129,0.2); border-radius:10px; padding:14px;">
          <div style="font-size:10px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.1em; margin-bottom:6px;">Lucro Líquido</div>
          <div style="font-family:'Syne',sans-serif; font-size:20px; font-weight:800; color:#10B981;" id="projLucro">—</div>
        </div>
        <div style="background:rgba(245,158,11,0.07); border:1px solid rgba(245,158,11,0.2); border-radius:10px; padding:14px;">
          <div style="font-size:10px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.1em; margin-bottom:6px;">Ponto de Equilíbrio</div>
          <div style="font-family:'Syne',sans-serif; font-size:20px; font-weight:800; color:#F59E0B;" id="projPE">—</div>
        </div>
        <div style="background:rgba(239,68,68,0.07); border:1px solid rgba(239,68,68,0.2); border-radius:10px; padding:14px;">
          <div style="font-size:10px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.1em; margin-bottom:6px;">ROI Mensal</div>
          <div style="font-family:'Syne',sans-serif; font-size:20px; font-weight:800; color:#EF4444;" id="projROI">—</div>
        </div>
      </div>
      <div style="height:90px; position:relative;">
        <canvas id="barChart" role="img" aria-label="Gráfico de projeção financeira mensal"></canvas>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="calc-footer">
    <div class="footer-info">PriceIQ — Ferramenta de Análise Estratégica para Clínicas Estéticas</div>
    <div class="footer-time" id="footerTime"></div>
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
// Clock
function updateClock() {
  document.getElementById('footerTime').textContent =
    new Date().toLocaleTimeString('pt-BR', {hour:'2-digit',minute:'2-digit',second:'2-digit'});
}
setInterval(updateClock, 1000); updateClock();

// Proc tags toggle
document.querySelectorAll('.proc-tag').forEach(t => {
  t.addEventListener('click', () => { t.classList.toggle('active'); calcular(); });
});

// Insumo counter
let insumoCount = 4;
function adicionarInsumo() {
  insumoCount++;
  const list = document.getElementById('insumosList');
  const div = document.createElement('div');
  div.className = 'insumo-item';
  div.innerHTML = `<input type="text" placeholder="Descrição do insumo" style="flex:1;margin-right:8px;">
    <input type="number" id="custoInsumo${insumoCount}" placeholder="0" value="0" style="width:100px;" oninput="calcular()">`;
  list.appendChild(div);
}

// Categoria
function atualizarCategoria() {
  const seg = document.getElementById('segmento').value;
  const porte = document.getElementById('porte').value;
  const labels = {
    'estetica_facial':'Estética Facial', 'corporal':'Corporal',
    'capilar':'Tricologia Capilar', 'oncoestetica':'Oncoestetica',
    'integrativa':'Integrativa', 'premium':'Premium Multi'
  };
  const portes = {'micro':'Micro','pequeno':'Pequeno','medio':'Médio','grande':'Grande'};
  document.getElementById('headerCategoria').textContent =
    (labels[seg]||'Clínica') + ' · ' + (portes[porte]||'');
  calcular();
}

// Radarchart
let radarInst = null, barInst = null;

function initRadar() {
  const ctx = document.getElementById('radarChart').getContext('2d');
  if (radarInst) radarInst.destroy();
  radarInst = new Chart(ctx, {
    type: 'radar',
    data: {
      labels: ['Margem', 'Competitiv.', 'Estrutura', 'Experiência', 'Posição', 'Volume'],
      datasets: [{
        label: 'Sua Clínica',
        data: [0,0,0,0,0,0],
        backgroundColor: 'rgba(14,165,233,0.15)',
        borderColor: '#0EA5E9',
        borderWidth: 2,
        pointBackgroundColor: '#38BDF8',
        pointRadius: 4,
      }]
    },
    options: {
      responsive: false,
      plugins: { legend: { display: false } },
      scales: {
        r: {
          min: 0, max: 100,
          ticks: { display: false, stepSize: 20 },
          grid: { color: 'rgba(56,189,248,0.12)' },
          angleLines: { color: 'rgba(56,189,248,0.1)' },
          pointLabels: {
            color: '#6B7A99',
            font: { size: 10, family: "'Instrument Sans', sans-serif" }
          }
        }
      }
    }
  });
}

function initBar() {
  const ctx = document.getElementById('barChart').getContext('2d');
  if (barInst) barInst.destroy();
  barInst = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Custos Fixos','Custos Var.','Lucro Líq.'],
      datasets: [{
        data: [0,0,0],
        backgroundColor: ['rgba(239,68,68,0.6)','rgba(245,158,11,0.6)','rgba(16,185,129,0.7)'],
        borderRadius: 5,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { ticks: { color:'#6B7A99', font:{size:9} }, grid:{display:false} },
        y: { display: false }
      }
    }
  });
}

initRadar(); initBar();

// CALCULAR
function calcular() {
  // coleta
  const aluguel       = parseFloat(document.getElementById('aluguel').value) || 0;
  const funcionarios  = parseInt(document.getElementById('funcionarios').value) || 0;
  const salarioMedio  = parseFloat(document.getElementById('salarioMedio').value) || 0;
  const outrosFixos   = parseFloat(document.getElementById('outrosFixos').value) || 0;
  const atendimentos  = parseInt(document.getElementById('atendimentos').value) || 1;
  const ocupacao      = parseInt(document.getElementById('ocupacao').value) / 100;
  const margemDesej   = parseInt(document.getElementById('margemLucro').value) / 100;
  const posicMult     = parseFloat(document.getElementById('posicionamento').value);
  const dificMult     = parseFloat(document.getElementById('dificuldade').value);
  const experiencia   = parseInt(document.getElementById('experiencia').value);
  const tempoProc     = parseInt(document.getElementById('tempoProc').value) || 60;
  const precioReg     = parseFloat(document.getElementById('precioRegional').value) || 180;
  const concorrentes  = parseInt(document.getElementById('concorrentes').value) || 5;
  const ticketDesej   = parseInt(document.getElementById('ticketDesejado').value);
  const metaFat       = parseInt(document.getElementById('metaFat').value);

  // insumos
  let totalVar = 0;
  for(let i=1; i<=insumoCount; i++) {
    const el = document.getElementById('custoInsumo'+i);
    if(el) totalVar += parseFloat(el.value)||0;
  }
  document.getElementById('totalInsumos').textContent = 'R$ ' + totalVar.toFixed(2).replace('.',',');

  // custo fixo por atendimento
  const totalFixo = aluguel + (funcionarios * salarioMedio * 1.4) + outrosFixos;
  const fixoPorAten = totalFixo / Math.max(atendimentos * ocupacao, 1);

  // custo total por atendimento
  const custoTotal = fixoPorAten + totalVar;

  // preço mínimo viável
  const precoMinimo = custoTotal / (1 - margemDesej);

  // fator experiência (0-30 anos → 1.0 a 1.5)
  const fatorExp = 1 + (Math.min(experiencia, 30) / 30) * 0.5;

  // fator serviços ativos
  const ativos = document.querySelectorAll('.proc-tag.active').length;
  const fatorServicos = 1 + (ativos * 0.04);

  // fator concorrência (menos concorrentes = mais margem)
  const fatorConc = Math.max(0.85, 1.2 - (concorrentes * 0.025));

  // preço calculado
  const precoCalc = precoMinimo * posicMult * dificMult * fatorExp * fatorServicos * fatorConc;

  // faixa
  const precoMin = Math.round(precoCalc * 0.88 / 5) * 5;
  const precoMax = Math.round(precoCalc * 1.15 / 5) * 5;
  const precoIdeal = Math.round(precoCalc / 5) * 5;

  // margem real
  const margemReal = ((precoIdeal - custoTotal) / precoIdeal) * 100;

  // score (0-100)
  let score = 50;
  score += Math.min(20, margemReal * 0.5);
  score += Math.min(15, fatorExp * 8);
  score += Math.min(10, ocupacao * 12);
  score += Math.min(5, ativos * 1);
  score = Math.round(Math.min(100, Math.max(0, score)));

  // nível competitivo
  const pctVsRegional = (precoIdeal / precioReg) * 100;

  // projeções
  const faturamentoProjMes = atendimentos * ocupacao * precoIdeal;
  const custosMes = atendimentos * ocupacao * custoTotal;
  const lucroLiq = faturamentoProjMes - custosMes;
  const atenPE = Math.ceil(totalFixo / (precoIdeal - totalVar));
  const roi = ((lucroLiq / totalFixo) * 100);

  // alert
  let alertClass = 'alert-ok', alertTxt = '✓ Precificação saudável e competitiva';
  if (precoIdeal < precoMinimo * 0.95) {
    alertClass = 'alert-danger'; alertTxt = '⚠ Subvalorização — abaixo do mínimo viável';
  } else if (pctVsRegional > 220) {
    alertClass = 'alert-warn'; alertTxt = '↑ Sobrepreço — muito acima da média regional';
  } else if (margemReal > 65) {
    alertClass = 'alert-ok'; alertTxt = '★ Excelente margem estratégica!';
  }

  // ─── ATUALIZA UI ───
  document.getElementById('resultHero').style.display = 'block';

  document.getElementById('rPreco').textContent =
    'R$ ' + precoMin.toLocaleString('pt-BR') + ' – R$ ' + precoMax.toLocaleString('pt-BR');
  document.getElementById('rSubtitle').textContent =
    'Preço ideal: R$ ' + precoIdeal.toLocaleString('pt-BR') + ' · Custo unitário: R$ ' + Math.round(custoTotal).toLocaleString('pt-BR');

  const alertEl = document.getElementById('rAlert');
  alertEl.style.display = 'inline-flex';
  alertEl.className = 'result-alert ' + alertClass;
  alertEl.textContent = alertTxt;

  const mr = Math.max(0, Math.round(margemReal));
  document.getElementById('rMargem').textContent = mr + '%';
  document.getElementById('rMargem').style.color = margemReal > 40 ? '#10B981' : margemReal > 20 ? '#F59E0B' : '#EF4444';
  document.getElementById('rMargemBar').style.width = Math.min(100, mr) + '%';
  document.getElementById('rMargemTxt').textContent = margemReal > 40 ? 'Margem excelente' : margemReal > 20 ? 'Margem razoável' : 'Margem crítica';

  let nivelTxt = 'Padrão de mercado', nivelPct = 50;
  if (pctVsRegional < 80) { nivelTxt = 'Abaixo da média'; nivelPct = 25; }
  else if (pctVsRegional < 110) { nivelTxt = 'Na média regional'; nivelPct = 50; }
  else if (pctVsRegional < 150) { nivelTxt = 'Acima da média'; nivelPct = 70; }
  else { nivelTxt = 'Posição premium'; nivelPct = 90; }

  document.getElementById('rNivel').textContent = nivelTxt;
  document.getElementById('rNivelBar').style.width = nivelPct + '%';
  document.getElementById('rNivelTxt').textContent = Math.round(pctVsRegional) + '% vs. média regional';

  document.getElementById('rScoreNum').textContent = score;
  document.getElementById('rScoreTxt').textContent =
    score >= 80 ? 'Saúde excelente' : score >= 60 ? 'Saúde boa' : score >= 40 ? 'Atenção necessária' : 'Revisão urgente';
  const circle = document.getElementById('scoreCircle');
  const circumference = 201;
  circle.style.strokeDashoffset = circumference - (score / 100) * circumference;
  circle.style.stroke = score >= 70 ? '#10B981' : score >= 45 ? '#F59E0B' : '#EF4444';

  document.getElementById('headerScore').textContent = score + '/100';

  // Mercado bars
  const maxMkt = Math.max(precoIdeal, precioReg) * 1.5 || 1;
  document.getElementById('mktBarSeu').style.width = Math.min(100,(precoIdeal/maxMkt*100)) + '%';
  document.getElementById('mktBarReg').style.width = Math.min(100,(precioReg/maxMkt*100)) + '%';
  document.getElementById('mktBarMin').style.width = Math.min(100,(precoMinimo/maxMkt*100)) + '%';
  document.getElementById('mktBarPrem').style.width = Math.min(100,(precioReg*1.8/maxMkt*100)) + '%';
  document.getElementById('mktPctSeu').textContent = 'R$'+Math.round(precoIdeal);
  document.getElementById('mktPctReg').textContent = 'R$'+Math.round(precioReg);
  document.getElementById('mktPctMin').textContent = 'R$'+Math.round(precoMinimo);
  document.getElementById('mktPctPrem').textContent = 'R$'+Math.round(precioReg*1.8);

  // Projeções
  document.getElementById('projFat').textContent = 'R$ '+Math.round(faturamentoProjMes).toLocaleString('pt-BR');
  document.getElementById('projLucro').textContent = 'R$ '+Math.round(lucroLiq).toLocaleString('pt-BR');
  document.getElementById('projPE').textContent = atenPE + ' aten.';
  document.getElementById('projROI').textContent = Math.round(roi) + '%';

  // Radar update
  const rMargemNorm = Math.min(100, margemReal * 1.4);
  const rComp = Math.min(100, (fatorConc - 0.85) / 0.35 * 100);
  const rEstr = Math.min(100, ocupacao * 100);
  const rExp  = Math.min(100, (experiencia / 30) * 100);
  const rPos  = Math.min(100, (posicMult - 0.75) / 1.0 * 100);
  const rVol  = Math.min(100, (atendimentos / 500) * 100);
  if (radarInst) {
    radarInst.data.datasets[0].data = [
      Math.round(rMargemNorm), Math.round(100-rComp+50>100?100:100-rComp+50),
      Math.round(rEstr), Math.round(rExp), Math.round(rPos), Math.round(rVol)
    ];
    radarInst.update('none');
  }

  // Bar update
  if (barInst) {
    barInst.data.datasets[0].data = [
      Math.round(totalFixo), Math.round(custosMes - totalFixo), Math.round(Math.max(0,lucroLiq))
    ];
    barInst.update('none');
  }
}

// Init
atualizarCategoria();
calcular();
</script>
</body>
</html>