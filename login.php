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
  <title>Login - GoStay</title>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
  <div class="navbar">
    <a href="index.php">Voltar</a>
  </div>

  <div class="login-container">
    <div class="login-card">
      <div class="logo">Go<span>Stay</span></div>
      <h2>Login</h2>
      <form method="POST" action="securityNormal.php">
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
      <p style="margin-top: 15px; font-size: 14px; color: #333;">
        Ainda não tem conta? 
        <a href="formAluno.php" style="color: #3399ff; font-weight: bold; text-decoration: none;">
          Cadastre-se
        </a>
      </p>
    </div>
  </div>
</body>
</html>
