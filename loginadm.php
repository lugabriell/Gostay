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
    <a href="index.html">Voltar</a>
  </div>

  <div class="login-container">
    <div class="login-card">
      <div class="logo">Go<span>Stay</span></div>
      <h2>Login Adm</h2>
      <form method="POST" action="securityAdm.php">
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
