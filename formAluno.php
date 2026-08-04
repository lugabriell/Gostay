<?php
require_once __DIR__ . "/functions/headers.php";
require_once __DIR__ . "/functions/sessions.php";
include_once('connection.php');
$_SESSION['tokenn1'] = bin2hex(random_bytes(32));
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Gostay - Cadastro</title>
  <?php require_once __DIR__ . '/functions/analytics.php'; ?>
  <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --yellow:   #f5c518;
      --yellow-h: #e6b800;
      --blue-dk:  #0a1f3d;
      --blue-md:  #0f2a4e;
      --white-06: rgba(255,255,255,0.06);
      --white-10: rgba(255,255,255,0.10);
      --white-12: rgba(255,255,255,0.12);
      --success: #4caf50;
      --danger: #f44336;
      --warning: #ff9800;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background-color: var(--blue-dk);
      background-image:
        radial-gradient(ellipse 80% 60% at 20% 10%, rgba(30,80,160,0.55) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 80% 80%, rgba(10,40,100,0.7) 0%, transparent 60%),
        radial-gradient(ellipse 40% 30% at 60% 20%, rgba(250,200,0,0.07) 0%, transparent 50%);
      
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 32px 16px 48px;
      color: #fff;
    }

    /* ── Navbar ── */
    .navbar {
      width: 100%;
      max-width: 900px;
      margin-bottom: 28px;
    }
    .navbar-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(255,255,255,0.06);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid var(--white-12);
      border-radius: 14px;
      padding: 10px 18px;
    }
    .brand {
      display: flex;
      align-items: center;
      gap: 2px;
      text-decoration: none;
    }
    .brand-go   { font-size: 20px; font-weight: 700; color: #fff; letter-spacing: -0.4px; }
    .brand-stay { font-size: 20px; font-weight: 700; color: var(--yellow); letter-spacing: -0.4px; }

    .nav-links { display: flex; align-items: center; gap: 4px; }
    .nav-links a {
      text-decoration: none;
      color: rgba(255,255,255,0.75);
      font-size: 13.5px;
      font-weight: 500;
      padding: 6px 12px;
      border-radius: 8px;
      transition: background .15s, color .15s;
    }
    .nav-links a:hover { background: rgba(255,255,255,0.10); color: #fff; }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.14);
      color: rgba(255,255,255,0.9);
      font-size: 13px;
      font-weight: 500;
      padding: 7px 14px;
      border-radius: 8px;
      text-decoration: none;
      cursor: pointer;
      transition: background .15s, border-color .15s;
    }
    .btn-back:hover { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.25); }
    .btn-back svg { width: 14px; height: 14px; opacity: .8; }

    /* ── Card ── */
    .card {
      width: 100%;
      max-width: 900px;
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(255,255,255,0.10);
      border-radius: 20px;
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 460px;
      max-height: 90vh;
    }

    /* ── Hero ── */
    .hero {
      padding: 44px 36px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 18px;
      background: linear-gradient(135deg, rgba(245,197,24,0.06) 0%, rgba(255,255,255,0.01) 100%);
      border-right: 1px solid rgba(255,255,255,0.07);
    }
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(245,197,24,0.12);
      border: 1px solid rgba(245,197,24,0.25);
      color: var(--yellow);
      font-size: 12px;
      font-weight: 600;
      letter-spacing: .6px;
      padding: 5px 12px;
      border-radius: 999px;
      width: fit-content;
      text-transform: uppercase;
    }
    .hero-badge::before { content: '★'; font-size: 11px; }
    .hero h1 {
      font-size: 26px;
      font-weight: 700;
      color: #fff;
      line-height: 1.25;
      letter-spacing: -.4px;
    }
    .hero h1 span { color: var(--yellow); }
    .hero p {
      font-size: 14.5px;
      color: rgba(255,255,255,0.65);
      line-height: 1.6;
    }
    .hero-features { display: flex; flex-direction: column; gap: 10px; margin-top: 6px; }
    .feat { display: flex; align-items: center; gap: 10px; font-size: 13.5px; color: rgba(255,255,255,0.8); }
    .feat-dot {
      width: 22px; height: 22px;
      border-radius: 50%;
      background: rgba(245,197,24,0.15);
      border: 1px solid rgba(245,197,24,0.3);
      display: grid; place-items: center;
      flex-shrink: 0;
      color: var(--yellow);
      font-size: 11px;
    }

    /* ── Form side ── */
    .form-side {
      padding: 32px 28px;
      display: flex;
      flex-direction: column;
      gap: 14px;
      overflow-y: auto;
      max-height: 90vh;
    }
    .form-title { font-size: 16px; font-weight: 600; color: #fff; }
    .form-sub   { font-size: 12.5px; color: rgba(255,255,255,0.45); margin-bottom: 4px; }

    label {
      display: block;
      font-size: 12px;
      font-weight: 500;
      color: rgba(255,255,255,0.7);
      letter-spacing: .3px;
      margin-bottom: 6px;
    }
    label .req { color: var(--yellow); }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    input[type="date"],
    select {
      width: 100%;
      padding: 11px 14px;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.10);
      border-radius: 10px;
      color: #fff;
      font-size: 14px;
      font-family: inherit;
      outline: none;
      appearance: none;
      -webkit-appearance: none;
      transition: border-color .15s, box-shadow .15s, background .15s;
    }
    input[type="date"]  { color-scheme: dark; }
    input::placeholder  { color: rgba(255,255,255,0.25); }
    input:focus, select:focus {
      border-color: rgba(245,197,24,0.6);
      background: rgba(255,255,255,0.07);
      box-shadow: 0 0 0 3px rgba(245,197,24,0.10);
    }
    input.invalid { border-color: #ff6b6b !important; box-shadow: 0 0 0 3px rgba(255,107,107,0.12) !important; }
    input.valid { border-color: var(--success) !important; box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.12) !important; }

    .select-wrap { position: relative; }
    .select-wrap::after {
      content: '';
      position: absolute;
      right: 13px; top: 50%;
      transform: translateY(-50%);
      width: 0; height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 5px solid rgba(255,255,255,0.45);
      pointer-events: none;
    }
    select option { background: var(--blue-md); color: #fff; }

    .row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    /* Password requirements com animação */
    .password-requirements {
      margin-top: 6px;
      padding: 10px 12px;
      background: rgba(255,255,255,0.04);
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,0.06);
      
      /* Animação de aparecer/desaparecer */
      max-height: 0;
      overflow: hidden;
      opacity: 0;
      transform: translateY(-10px);
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                  opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                  transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                  margin 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      margin-top: 0;
      padding-top: 0;
      padding-bottom: 0;
    }

    .password-requirements.visible {
      max-height: 300px;
      opacity: 1;
      transform: translateY(0);
      margin-top: 6px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .requirement {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 4px 0;
      font-size: 12px;
      color: rgba(255,255,255,0.5);
      transition: all 0.3s ease;
      
      /* Animação individual dos itens */
      opacity: 0;
      transform: translateX(-10px);
      transition: opacity 0.3s ease 0.1s, transform 0.3s ease 0.1s, color 0.3s ease;
    }

    .password-requirements.visible .requirement {
      opacity: 1;
      transform: translateX(0);
    }

    /* Delay para cada item aparecer em sequência */
    .password-requirements.visible .requirement:nth-child(1) { transition-delay: 0.05s; }
    .password-requirements.visible .requirement:nth-child(2) { transition-delay: 0.10s; }
    .password-requirements.visible .requirement:nth-child(3) { transition-delay: 0.15s; }
    .password-requirements.visible .requirement:nth-child(4) { transition-delay: 0.20s; }
    .password-requirements.visible .requirement:nth-child(5) { transition-delay: 0.25s; }
    .password-requirements.visible .requirement:nth-child(6) { transition-delay: 0.30s; }

    .requirement.valid {
      color: var(--success);
    }

    .requirement.invalid {
      color: var(--danger);
    }

    .requirement-icon {
      font-size: 14px;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
    }

    .strength-bar {
      margin-top: 8px;
      height: 4px;
      background: rgba(255,255,255,0.1);
      border-radius: 2px;
      overflow: hidden;
      opacity: 0;
      transition: opacity 0.3s ease 0.2s;
    }

    .password-requirements.visible .strength-bar {
      opacity: 1;
    }

    .strength-bar-fill {
      height: 100%;
      width: 0%;
      transition: all 0.5s ease;
      border-radius: 2px;
    }

    .strength-text {
      font-size: 11px;
      color: rgba(255,255,255,0.4);
      margin-top: 4px;
      text-align: right;
      transition: color 0.3s ease, opacity 0.3s ease 0.2s;
      opacity: 0;
    }

    .password-requirements.visible .strength-text {
      opacity: 1;
    }

    /* Radio group (admin only) */
    .radio-group { display: flex; gap: 16px; margin-top: 8px; }
    .radio-group label {
      display: flex; align-items: center; gap: 6px;
      font-size: 13px; color: rgba(255,255,255,0.75);
      cursor: pointer; letter-spacing: 0; margin-bottom: 0;
    }
    .radio-group input[type="radio"] {
      width: 16px; height: 16px;
      accent-color: var(--yellow);
      padding: 0; border: none;
    }

    /* File input */
    .file-label {
      display: flex;
      align-items: center;
      gap: 10px;
      background: rgba(255,255,255,0.05);
      border: 1px dashed rgba(255,255,255,0.18);
      border-radius: 10px;
      padding: 10px 14px;
      cursor: pointer;
      transition: background .15s, border-color .15s;
    }
    .file-label:hover { background: rgba(255,255,255,0.09); border-color: rgba(245,197,24,0.35); }
    .file-icon {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: rgba(245,197,24,0.12);
      border: 1px solid rgba(245,197,24,0.20);
      display: grid; place-items: center;
      flex-shrink: 0;
      font-size: 16px;
    }
    .file-text { flex: 1; }
    .file-text strong { display: block; font-size: 13px; color: rgba(255,255,255,0.85); font-weight: 500; }
    .file-text span   { font-size: 11.5px; color: rgba(255,255,255,0.40); }
    input[type="file"] { position: absolute; opacity: 0; pointer-events: none; width: 0; height: 0; }

    hr.divider { border: none; border-top: 1px solid rgba(255,255,255,0.07); margin: 2px 0; }

    /* Actions */
    .actions { display: flex; gap: 10px; align-items: center; margin-top: 2px; }
    .btn-primary {
      flex: 1;
      padding: 12px;
      background: linear-gradient(135deg, var(--yellow), var(--yellow-h));
      color: var(--blue-dk);
      border: none;
      border-radius: 10px;
      font-size: 14.5px;
      font-weight: 700;
      cursor: pointer;
      letter-spacing: .2px;
      transition: transform .12s, box-shadow .12s, opacity .3s;
    }
    .btn-primary:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(245,197,24,0.28); }
    .btn-primary:disabled {
      opacity: 0.4;
      cursor: not-allowed;
      transform: none;
    }
    .btn-ghost {
      padding: 12px 16px;
      background: transparent;
      border: 1px solid rgba(255,255,255,0.12);
      color: rgba(255,255,255,0.65);
      border-radius: 10px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: background .15s, border-color .15s;
    }
    .btn-ghost:hover { background: rgba(255,255,255,0.07); border-color: rgba(255,255,255,0.22); }

    .login-link {
      text-align: center;
      font-size: 12.5px;
      color: rgba(255,255,255,0.4);
      margin-top: 2px;
    }
    .login-link a { color: var(--yellow); text-decoration: none; font-weight: 500; }
    .login-link a:hover { text-decoration: underline; }

    /* Feedback flash messages */
    .flash {
      width: 100%;
      max-width: 900px;
      padding: 12px 18px;
      border-radius: 10px;
      font-size: 13.5px;
      font-weight: 500;
      margin-bottom: 16px;
    }
    .flash-error   { background: rgba(255,107,107,0.12); border: 1px solid rgba(255,107,107,0.3); color: #ff9a9a; }
    .flash-success { background: rgba(80,200,120,0.10); border: 1px solid rgba(80,200,120,0.25); color: #7de8a0; }

    .password-input-wrapper {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: rgba(255,255,255,0.5);
      cursor: pointer;
      font-size: 18px;
      padding: 4px;
      transition: color 0.3s;
    }

    .toggle-password:hover {
      color: rgba(255,255,255,0.8);
    }

    /* Badge de dica flutuante */
    .password-hint {
      font-size: 11px;
      color: rgba(255,255,255,0.3);
      margin-top: 4px;
      display: flex;
      align-items: center;
      gap: 4px;
      transition: opacity 0.3s ease;
    }

    .password-hint.hidden {
      opacity: 0;
    }

    @media (max-width: 780px) {
      .card { grid-template-columns: 1fr; max-height: none; }
      .hero { display: none; }
      .nav-links { display: none; }
      .form-side { max-height: none; }
    }
    @media (max-width: 480px) {
      .row { grid-template-columns: 1fr; }
      .form-side { padding: 24px 18px; }
    }
  </style>
</head>
<body>

  <?php if (isset($_SESSION['flash_error'])): ?>
    <div class="flash flash-error"><?= htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
  <?php endif; ?>
  <?php if (isset($_SESSION['flash_success'])): ?>
    <div class="flash flash-success"><?= htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
  <?php endif; ?>

  <!-- NAVBAR -->
  <nav class="navbar" aria-label="Navegação principal">
    <div class="navbar-inner">

      <a href="https://gostay.com.br" class="btn-back" aria-label="Voltar para a página inicial">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Voltar
      </a>

      <a href="index.html" class="brand" aria-label="GoStay — página inicial">
        <span class="brand-go">Go</span><span class="brand-stay">Stay</span>
      </a>

      <div class="nav-links">
        <a href="index.php">Cursos</a>
        <a href="index.php">Metodologia</a>
        <a href="index.php">Certificados</a>
      </div>

    </div>
  </nav>

  <!-- MAIN CARD -->
  <div class="card" role="region" aria-label="Formulário de cadastro GoStay">

    <!-- Hero -->
    <section class="hero" aria-hidden="true">
      <div class="hero-badge">Cadastro</div>
      <h1>Entre em contato <span>conosco.</span></h1>
      <p>Preencha com seus dados para abrir portas para o seu futuro profissional.</p>
      <div class="hero-features">
        <div class="feat"><div class="feat-dot">✓</div> Acesso a cursos selecionados</div>
        <div class="feat"><div class="feat-dot">✓</div> Certificado digital reconhecido</div>
        <div class="feat"><div class="feat-dot">✓</div> Suporte por e-mail e chat</div>
        <div class="feat"><div class="feat-dot">✓</div> Atualizações mensais de conteúdo</div>
      </div>
    </section>

    <!-- Form -->
    <form
      class="form-side"
      enctype="multipart/form-data"
      action="creates/createaluno.php"
      method="POST"
      id="contactForm"
      novalidate
    >
      <div>
        <div class="form-title">Crie sua conta</div>
        <div class="form-sub">Preencha todos os campos obrigatórios</div>
      </div>

      <!-- Nome -->
      <div>
        <label for="nome">Nome completo <span class="req">*</span></label>
        <input
          id="nome" name="nome" type="text"
          minlength="1" maxlength="250" required
          placeholder="Seu nome completo"
          value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
        />
      </div>

      <!-- Email + Telefone -->
      <div class="row">
        <div>
          <label for="email">E-mail <span class="req">*</span></label>
          <input
            id="email" name="email" type="email"
            minlength="1" maxlength="250" required
            placeholder="seu@exemplo.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
          />
        </div>
        <div>
          <label for="telefone">Telefone <span class="req">*</span></label>
          <input
            id="telefone" name="telefone" type="tel"
            minlength="1" maxlength="20" required
            placeholder="(XX) XXXXX-XXXX"
            value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>"
          />
        </div>
      </div>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['tokenn1']); ?>">

      <!-- Senha + Data de nascimento -->
      <div class="row">
        <div>
          <label for="senha">Senha <span class="req">*</span></label>
          <div class="password-input-wrapper">
            <input
              id="senha" name="senha" type="password"
              minlength="8" maxlength="30" required
              placeholder="Mínimo 8 caracteres"
              autocomplete="new-password"
            />
            <button type="button" class="toggle-password" id="togglePassword" aria-label="Mostrar/ocultar senha">
              👁️
            </button>
          </div>
          
          <!-- Dica flutuante -->
          <!-- <div class="password-hint" id="passwordHint">
            💡 Clique no campo para ver os requisitos
          </div> -->

          <!-- Requisitos da senha em tempo real com animação -->
          <div class="password-requirements" id="passwordRequirements">
            <div class="requirement" id="req-length">
              <span class="requirement-icon">❌</span>
              <span>Mínimo 8 caracteres</span>
            </div>
            <div class="requirement" id="req-uppercase">
              <span class="requirement-icon">❌</span>
              <span>Pelo menos 1 letra maiúscula</span>
            </div>
            <div class="requirement" id="req-lowercase">
              <span class="requirement-icon">❌</span>
              <span>Pelo menos 1 letra minúscula</span>
            </div>
            <div class="requirement" id="req-number">
              <span class="requirement-icon">❌</span>
              <span>Pelo menos 1 número</span>
            </div>
            <div class="requirement" id="req-special">
              <span class="requirement-icon">❌</span>
              <span>Pelo menos 1 caractere especial (!@#$%^&*)</span>
            </div>
            <div class="strength-bar">
              <div class="strength-bar-fill" id="strengthBar"></div>
            </div>
            <div class="strength-text" id="strengthText">Força: Fraca</div>
          </div>
        </div>
        <div>
          <label for="datanas">Data de nascimento <span class="req">*</span></label>
          <input
            id="datanas" name="datanas" type="date"
            required
            value="<?= htmlspecialchars($_POST['datanas'] ?? '') ?>"
          />
        </div>
      </div>

      <!-- Formação -->
      <div>
        <label for="formacao">Formação <span class="req">*</span></label>
        <div class="select-wrap">
          <select name="formacao" id="formacao" required>
            <option value="">Selecione sua formação</option>
            <?php
              $opcoes = [
                'Farmácia'                               => 'Farmácia',
                'Odontologia'                            => 'Odontologia',
                'Curso Técnico na área da Estética'      => 'Curso Técnico — Estética',
                'Biomedicina'                            => 'Biomedicina',
                'Curso Técnico na área de odontologia'   => 'Curso Técnico — Odontologia',
              ];
              foreach ($opcoes as $value => $label):
                $selected = (($_POST['formacao'] ?? '') === $value) ? 'selected' : '';
            ?>
              <option value="<?= htmlspecialchars($value) ?>" <?= $selected ?>>
                <?= htmlspecialchars($label) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <?php if (isset($_SESSION['nameadm']) && isset($_SESSION['emailadm'])): ?>
          <div class="radio-group" style="margin-top:12px">
            <label>
              <input type="radio" name="autenticado" value="sim" required
                <?= (($_POST['autenticado'] ?? '') === 'sim') ? 'checked' : '' ?>
              /> Autenticado
            </label>
            <label>
              <input type="radio" name="autenticado" value="nao"
                <?= (($_POST['autenticado'] ?? '') === 'nao') ? 'checked' : '' ?>
              /> Não autenticado
            </label>
          </div>
        <?php endif; ?>
      </div>

      <!-- Foto de perfil -->
      <div>
        <label>Foto de perfil <span class="req">*</span></label>
        <label class="file-label" for="arquivo">
          <div class="file-icon" aria-hidden="true">📷</div>
          <div class="file-text">
            <strong id="file-name">Selecionar imagem</strong>
            <span>PNG, JPG ou WEBP — máx. 5 MB</span>
          </div>
          <input
            type="file" id="arquivo" name="arquivo"
            accept="image/*" required
          />
        </label>
      </div>

      <hr class="divider"/>

      <!-- Botões -->
      <div class="actions">
        <button type="submit" class="btn-primary" id="submitBtn" disabled>Criar conta</button>
        <button type="reset" class="btn-ghost">Limpar</button>
      </div>

      <div class="login-link">
        Já tem uma conta? <a href="index.html">Entrar</a>
      </div>
    </form>
  </div>

  <script>
    // Elementos DOM para validação de senha
    const passwordInput = document.getElementById('senha');
    const togglePassword = document.getElementById('togglePassword');
    const submitBtn = document.getElementById('submitBtn');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    const passwordRequirements = document.getElementById('passwordRequirements');
    const passwordHint = document.getElementById('passwordHint');

    // Flag para controlar se o campo já foi focado
    let hasBeenFocused = false;

    // Mapeamento dos requisitos
    const requirements = {
      length: {
        element: document.getElementById('req-length'),
        icon: document.querySelector('#req-length .requirement-icon'),
        check: (value) => value.length >= 8
      },
      uppercase: {
        element: document.getElementById('req-uppercase'),
        icon: document.querySelector('#req-uppercase .requirement-icon'),
        check: (value) => /[A-Z]/.test(value)
      },
      lowercase: {
        element: document.getElementById('req-lowercase'),
        icon: document.querySelector('#req-lowercase .requirement-icon'),
        check: (value) => /[a-z]/.test(value)
      },
      number: {
        element: document.getElementById('req-number'),
        icon: document.querySelector('#req-number .requirement-icon'),
        check: (value) => /\d/.test(value)
      },
      special: {
        element: document.getElementById('req-special'),
        icon: document.querySelector('#req-special .requirement-icon'),
        check: (value) => /[!@#$%^&*()_+\-=\[\]{};:'",.<>?/\\|`~]/.test(value)
      }
    };

    // Função para mostrar/ocultar requisitos com animação
    function toggleRequirements(show) {
      if (show) {
        passwordRequirements.classList.add('visible');
        passwordHint.classList.add('hidden');
        hasBeenFocused = true;
      } else {
        // Só esconde se o campo não tiver conteúdo ou se todos os requisitos forem atendidos
        if (passwordInput.value.length === 0 || validatePassword(passwordInput.value)) {
          passwordRequirements.classList.remove('visible');
          passwordHint.classList.remove('hidden');
        }
      }
    }

    // Função para validar a senha em tempo real
    function validatePassword(password) {
      let validCount = 0;
      const totalRequirements = Object.keys(requirements).length;

      // Verifica cada requisito
      Object.values(requirements).forEach(req => {
        const isValid = req.check(password);
        
        // Atualiza a classe do elemento
        req.element.className = `requirement ${isValid ? 'valid' : 'invalid'}`;
        
        // Atualiza o ícone
        req.icon.textContent = isValid ? '✅' : '❌';
        
        if (isValid) validCount++;
      });

      // Atualiza a barra de força
      const percentage = (validCount / totalRequirements) * 100;
      strengthBar.style.width = `${percentage}%`;
      
      // Define a cor e texto da força
      let color, text;
      if (percentage <= 20) {
        color = '#f44336';
        text = 'Muito Fraca';
      } else if (percentage <= 40) {
        color = '#ff9800';
        text = 'Fraca';
      } else if (percentage <= 60) {
        color = '#ffc107';
        text = 'Média';
      } else if (percentage <= 80) {
        color = '#8bc34a';
        text = 'Forte';
      } else {
        color = '#4caf50';
        text = 'Muito Forte';
      }
      
      strengthBar.style.background = color;
      strengthText.textContent = `Força: ${text}`;
      strengthText.style.color = color;

      // Habilita/desabilita o botão de submit
      const allValid = validCount === totalRequirements;
      submitBtn.disabled = !allValid;
      
      // Adiciona classe visual ao campo de senha
      if (password.length > 0) {
        passwordInput.className = allValid ? 'valid' : 'invalid';
      } else {
        passwordInput.className = '';
      }

      return allValid;
    }

    // Evento de foco no campo de senha - mostra os requisitos
    passwordInput.addEventListener('focus', function() {
      toggleRequirements(true);
    });

    // Evento de blur (perde foco) - esconde os requisitos se a senha for válida ou vazia
    passwordInput.addEventListener('blur', function() {
      // Pequeno delay para não atrapalhar o clique em outros campos
      setTimeout(() => {
        const password = this.value;
        if (password.length === 0 || validatePassword(password)) {
          toggleRequirements(false);
        }
        // Se a senha for inválida mas não vazia, mantém visível
      }, 150);
    });

    // Evento de input em tempo real
    passwordInput.addEventListener('input', function(e) {
      validatePassword(this.value);
      // Se o campo tem conteúdo e já foi focado, mantém visível
      if (this.value.length > 0 && hasBeenFocused) {
        passwordRequirements.classList.add('visible');
        passwordHint.classList.add('hidden');
      }
    });

    // Mostrar/ocultar senha
    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    // Fechar requisitos ao clicar em outro campo do formulário
    document.querySelectorAll('input:not(#senha), select, textarea').forEach(function(element) {
      element.addEventListener('focus', function() {
        const password = passwordInput.value;
        if (password.length === 0 || validatePassword(password)) {
          toggleRequirements(false);
        }
      });
    });

    // Atualiza nome do arquivo selecionado
    document.getElementById('arquivo').addEventListener('change', function () {
      const label = document.getElementById('file-name');
      label.textContent = this.files[0] ? this.files[0].name : 'Selecionar imagem';
    });

    // Validação de front-end básica antes do submit
    document.getElementById('contactForm').addEventListener('submit', function (e) {
      let valid = true;
      const required = this.querySelectorAll('[required]');
      required.forEach(function (field) {
        if (!field.value.trim()) {
          field.classList.add('invalid');
          valid = false;
        } else {
          field.classList.remove('invalid');
        }
      });
      
      // Verifica se a senha é válida antes de enviar
      const password = passwordInput.value;
      if (!validatePassword(password)) {
        valid = false;
        // Mostra os requisitos se houver erro
        toggleRequirements(true);
      }
      
      if (!valid) {
        e.preventDefault();
        // Scroll para o primeiro campo inválido
        const firstInvalid = document.querySelector('.invalid');
        if (firstInvalid) {
          firstInvalid.focus();
        }
      }
    });

    // Remove classe invalid ao digitar
    document.querySelectorAll('input, select').forEach(function (el) {
      el.addEventListener('input', function () { 
        if (this.id !== 'senha') {
          this.classList.remove('invalid'); 
        }
      });
      el.addEventListener('change', function () { 
        if (this.id !== 'senha') {
          this.classList.remove('invalid'); 
        }
      });
    });

    // Máscara simples de telefone
    document.getElementById('telefone').addEventListener('input', function () {
      let v = this.value.replace(/\D/g, '').slice(0, 11);
      if (v.length > 6) {
        v = '(' + v.slice(0,2) + ') ' + v.slice(2,7) + '-' + v.slice(7);
      } else if (v.length > 2) {
        v = '(' + v.slice(0,2) + ') ' + v.slice(2);
      }
      this.value = v;
    });

    // Validação inicial da senha (campo vazio)
    validatePassword('');
    
    // Esconde os requisitos inicialmente
    passwordRequirements.classList.remove('visible');
  </script>

</body>
</html>