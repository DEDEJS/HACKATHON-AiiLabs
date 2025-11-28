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
    <title>Nova Conta | App Banco</title>
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
        <h1>Seja Cliente</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem">
          Preencha seus dados
        </p>
      </div>

      <form class="form-area" method="post" action="#">
        <div class="input-group">
          <label for="nome">Nome Completo</label>
          <input
            type="text"
            id="nome"
            name="nome"
            class="input-field"
            placeholder="Ex: Stenio Calado"
            value="<?php ValueDisplay::showName(); ?>"
          />
          <span class="error-msg"><?php $Validate -> validateName(); ?></span>
        </div>

        <div class="input-group">
          <label for="email">E-mail</label>
          <input
            type="email"
            id="email"
            name="email"
            class="input-field"
            placeholder="seu@email.com"
            value="<?php ValueDisplay::showEmail(); ?>"
          />
          <span class="error-msg"><?php $Validate -> validateEmail(); ?></span>
        </div>

        <div class="input-group">
          <label for="cpf">CPF ou CNPJ</label>

          <input
            type="text"
            id="cpf"
            name="documento"
            class="input-field"
            placeholder="Digite apenas números"
            maxlength="18"
            value="<?php ValueDisplay::showDocumento(); ?>"
          />
          <span class="error-msg"><?php $Validate -> ValidateDocumento(); ?></span>
        </div>
        <div class="input-group">
          <label for="birthday">Data de Aniversário</label>

          <input
            type="date"
            id="birthday"
            name="aniversario"
            class="input-field"
            value="<?php ValueDisplay::showAniversario(); ?>"
          />
          <span class="error-msg"><?php $Validate->ValidateBirthday(); ?></span>
          </div>
            <div class="input-group">
          <label for="Telefone">Telefone</label>
          <input
            type="text"
            id="telefone"
            name="telefone"
            class="input-field"
            placeholder="Telefone"
            value="<?php ValueDisplay::showPhone(); ?>"
          />
          <span class="error-msg"><?php $Validate -> validatePhone(); ?></span>
        </div>
        <div class="input-group">
          <label for="senha">Crie uma senha</label>
          <input
            type="password"
            id="senha"
            name="password"
            class="input-field"
            placeholder="Mínimo 6 caracteres"
          />
          <span class="error-msg"><?php $Validate -> validatePassword(); ?></span>
        </div>
         <span class="error-msg"><?php $Validate-> Header($Connection); ?></span>
        <button type="submit" class="btn-primary">Criar Conta Grátis</button>
      </form>

      <div class="links">
        <p>Já tem uma conta? </p>
        <a href="index.php">Fazer Login</a>
      </div>
    </div>

    <script src="js/auth.js"></script>
  </body>
</html>
