<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Ids Ead</title>
    <link rel="shortcut icon" href="assets/ACELERADOR DO POTENCIAL HUMANO (1).png" type="image">
  <link rel="stylesheet" href="styleLogin.css">
</head>
<body>
  <div class="navbar">
    <a href="index.html">Voltar</a>
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
