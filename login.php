<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self'");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    header("Permissions-Policy: geolocation=(), camera=(), microphone=()");
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>GoStay — Login</title>
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
      justify-content: center;
      padding: 32px 16px;
      color: #fff;
    }

    /* ── Navbar ── */
    .navbar {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: calc(100% - 32px);
      max-width: 480px;
      z-index: 10;
    }
    .navbar-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(255,255,255,0.06);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 14px;
      padding: 10px 18px;
    }
    .brand {
      display: flex;
      align-items: center;
      text-decoration: none;
    }
    .brand-go   { font-size: 18px; font-weight: 700; color: #fff; letter-spacing: -0.4px; }
    .brand-stay { font-size: 18px; font-weight: 700; color: var(--yellow); letter-spacing: -0.4px; }

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
      transition: background .15s, border-color .15s;
    }
    .btn-back:hover { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.25); }
    .btn-back svg { width: 14px; height: 14px; opacity: .8; }

    /* ── Card ── */
    .card {
      width: 100%;
      max-width: 420px;
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(255,255,255,0.10);
      border-radius: 20px;
      padding: 40px 36px 36px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-top: 72px;
    }

    /* ── Header do card ── */
    .card-header { text-align: center; display: flex; flex-direction: column; gap: 6px; }
    .card-header .logo {
      font-size: 28px;
      font-weight: 700;
      letter-spacing: -0.6px;
      color: #fff;
    }
    .card-header .logo span { color: var(--yellow); }
    .card-header h2 {
      font-size: 15px;
      font-weight: 500;
      color: rgba(255,255,255,0.55);
      letter-spacing: .2px;
    }

    /* ── Separador ── */
    .divider { border: none; border-top: 1px solid rgba(255,255,255,0.07); }

    /* ── Campos ── */
    .field { display: flex; flex-direction: column; gap: 6px; }
    label {
      font-size: 12px;
      font-weight: 500;
      color: rgba(255,255,255,0.65);
      letter-spacing: .3px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 14px;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.10);
      border-radius: 10px;
      color: #fff;
      font-size: 14px;
      font-family: inherit;
      outline: none;
      appearance: none;
      transition: border-color .15s, box-shadow .15s, background .15s;
    }
    input::placeholder { color: rgba(255,255,255,0.22); }
    input:focus {
      border-color: rgba(245,197,24,0.6);
      background: rgba(255,255,255,0.07);
      box-shadow: 0 0 0 3px rgba(245,197,24,0.10);
    }
    input.invalid {
      border-color: #ff6b6b !important;
      box-shadow: 0 0 0 3px rgba(255,107,107,0.12) !important;
    }

    /* ── Esqueceu a senha ── */
    .forgot {
      text-align: right;
      margin-top: -8px;
    }
    .forgot a {
      font-size: 12px;
      color: rgba(255,255,255,0.4);
      text-decoration: none;
      transition: color .15s;
    }
    .forgot a:hover { color: var(--yellow); }

    /* ── Botão submit ── */
    .btn-submit {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, var(--yellow), var(--yellow-h));
      color: var(--blue-dk);
      border: none;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      letter-spacing: .2px;
      transition: transform .12s, box-shadow .12s;
      margin-top: 4px;
    }
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(245,197,24,0.30);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ── Rodapé do card ── */
    .card-footer {
      text-align: center;
      font-size: 13px;
      color: rgba(255,255,255,0.40);
    }
    .card-footer a {
      color: var(--yellow);
      font-weight: 600;
      text-decoration: none;
    }
    .card-footer a:hover { text-decoration: underline; }

    /* ── Flash messages ── */
    .flash {
      width: 100%;
      max-width: 420px;
      padding: 12px 18px;
      border-radius: 10px;
      font-size: 13.5px;
      font-weight: 500;
      margin-bottom: 12px;
      margin-top: 72px;
    }
    .flash-error   { background: rgba(255,107,107,0.12); border: 1px solid rgba(255,107,107,0.3); color: #ff9a9a; }
    .flash-success { background: rgba(80,200,120,0.10); border: 1px solid rgba(80,200,120,0.25); color: #7de8a0; }

    @media (max-width: 480px) {
      .card { padding: 32px 22px 28px; margin-top: 80px; }
    }
  </style>
</head>
<body>

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
      <a href="https://gostay.com.br" class="brand" aria-label="GoStay">
        <span class="brand-go">Go</span><span class="brand-stay">Stay</span>
      </a>
      <div style="width:80px"></div><!-- espaçador para centralizar a logo -->
    </div>
  </nav>

  <?php if (isset($_SESSION['flash_error'])): ?>
    <div class="flash flash-error"><?= htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
  <?php endif; ?>
  <?php if (isset($_SESSION['flash_success'])): ?>
    <div class="flash flash-success"><?= htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
  <?php endif; ?>

  <!-- CARD DE LOGIN -->
  <main class="card" role="main" aria-label="Formulário de login">

    <div class="card-header">
      <div class="logo">Go<span>Stay</span></div>
      <h2>Acesse sua conta</h2>
    </div>

    <hr class="divider"/>

    <form method="POST" action="securityNormal.php" id="loginForm" novalidate>

      <div style="display:flex;flex-direction:column;gap:14px">

        <div class="field">
          <label for="email">E-mail</label>
          <input
            type="email" id="email" name="email"
            required autocomplete="email"
            placeholder="seu@exemplo.com"
          />
        </div>

        <div class="field">
          <label for="senha">Senha</label>
          <input
            type="password" id="senha" name="senha"
            required autocomplete="current-password"
            placeholder="Sua senha"
          />
        </div>

        <div class="forgot">
          <a href="#">Esqueceu a senha?</a>
        </div>

      </div>

      <button type="submit" name="submit" class="btn-submit">Entrar</button>

    </form>

    <hr class="divider"/>

    <div class="card-footer">
      Ainda não tem conta?
      <a href="formAluno.php">Cadastre-se</a>
    </div>

  </main>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      let valid = true;
      this.querySelectorAll('[required]').forEach(function (field) {
        if (!field.value.trim()) {
          field.classList.add('invalid');
          valid = false;
        } else {
          field.classList.remove('invalid');
        }
      });
      if (!valid) e.preventDefault();
    });

    document.querySelectorAll('input').forEach(function (el) {
      el.addEventListener('input', function () { this.classList.remove('invalid'); });
    });
  </script>

</body>
</html>