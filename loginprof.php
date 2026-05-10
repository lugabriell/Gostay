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
  <title>Login - Ids Ead</title>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
  <div class="navbar">
    <a href="index.php">Voltar</a>
  </div>

  <div class="login-container">
    <div class="login-card">
      <div class="logo">Ids<span>Ead</span></div>
      <h2>Login Professor</h2>
      <form method="POST" action="securityProf.php">
        <div class="input-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
          <label for="senha">Senha</label>
          <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" name="submit">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>
