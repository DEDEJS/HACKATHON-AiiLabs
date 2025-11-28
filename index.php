<?php
include_once("PHP/ValidaForms/ValidateForm.php");
include_once("PHP/Banco/banco.php");
$Validate = new Validate();
$Connection = $Banco->conecta();
include_once("PHP/Sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | App Banco</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="login-page">
    <div class="login-container">
      <div class="logo-area">
        <img src="img/logo_aiia.png" alt="Logo" id="logo-dark" class="top-logo" />
        
        <img src="img/logo_aiia_light-mode (1).png" alt="Logo Escura" id="logo-light" class="top-logo" />
        
        <h1>Acesse sua conta</h1>
      </div>

      <form class="form-area" onsubmit="validateLogin(event)" method="post" action="#">
        <div class="input-group">
          <label for="cpf">CPF ou CNPJ</label>
          <input
            type="text"
            id="cpf"
            name="documento"
            class="input-field"
            placeholder="Digite apenas números"
            maxlength="18"
            
          />
          <span class="error-msg"><?php $Validate -> ValidateDocumento(); ?></span>
        </div>

        <div class="input-group">
          <label for="senha">Senha</label>
          <input
            type="password"
            id="senha"
            name="password"
            class="input-field"
            placeholder="••••••••"
          />
          <span class="error-msg"><?php $Validate -> validatePassword(); ?></span>
        </div>
          <span class="error-msg"><?php $Validate -> Logar($Connection); ?></span>
        <button type="submit" class="btn-primary">Entrar</button>
      </form>

      <div class="links">
        <p>Ainda não é cliente?</p>
        <a href="cadastro.php">Criar minha conta</a>
      </div>
    </div>

    <script src="js/auth.js"></script>
  </body>
</html>
