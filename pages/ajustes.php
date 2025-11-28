<?php
include_once("../PHP/sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajustes | Aiia Bank</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logo_aiia.png" type="image/x-icon">
  </head>
  <body>
    <div class="overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <div class="user-info-sidebar">
          <div class="ph ph-user"></div>
          <strong><?php echo $_SESSION['Nome'];?></strong>
        </div>
        <i class="ph ph-x" id="close-menu"></i>
      </div>

      <nav class="sidebar-nav">
        <a href="home.php"><i class="ph ph-house"></i> Início</a>
        <a href="extrato.php"><i class="ph ph-receipt"></i> Extrato</a>
        <a href="pix.php"><i class="ph ph-pix-logo"></i> Área Pix</a>
        <a href="#"><i class="ph ph-arrows-left-right"></i> Transferências</a>
        <a href="#"><i class="ph ph-barcode"></i> Pagar Boletos</a>
        <a href="cartoes.php"><i class="ph ph-credit-card"></i> Cartões</a>
        <a href="emprestimos.php"
          ><i class="ph ph-hand-coins"></i> Empréstimos</a
        >
        <a href="seguros.php"><i class="ph ph-shield-check"></i> Seguros</a>

        <a href="#"><i class="ph ph-chart-line-up"></i> Investimentos</a>

        <a href="ajustes.php"><i class="ph ph-gear"></i> Ajustes</a>
        <a href="#"><i class="ph ph-question"></i> Ajuda</a>

        <hr />

         <a href="deslogar.php" class="logout"
          ><i class="ph ph-sign-out"></i> Sair do App</a
        >
      </nav>
    </aside>

    <div class="app-container">
      <header class="app-header" style="padding-bottom: 2rem">
        <div class="header-left">
          <i
            class="ph ph-list"
            id="open-menu"
            style="font-size: 2rem; cursor: pointer; margin-right: 15px"
          ></i>
          <h2>Ajustes</h2>
        </div>
      </header>

      <div class="settings-list">
        <h3
          style="
            margin: 1.5rem 0 0.5rem 0;
            font-size: 0.9rem;
            color: var(--text-muted);
          "
        >
          PERFIL
        </h3>

        <a href="#" class="setting-item">
          <div class="setting-left">
            <i class="ph ph-user-circle"></i>
            <span>Meus Dados</span>
          </div>
          <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
        </a>

        <a href="#" class="setting-item">
          <div class="setting-left">
            <i class="ph ph-bell"></i>
            <span>Notificações</span>
          </div>
          <div class="toggle-switch on" id="toggle-notifications"></div>
        </a>

        <h3 style="margin: 2rem 0 0.5rem 0; font-size: 0.9rem; color: var(--text-muted);">
          APARÊNCIA
        </h3>

        <a href="#" class="setting-item">
          <div class="setting-left">
            <i class="ph ph-moon" id="theme-icon"></i>
            <span>Tema Escuro</span>
          </div>
          <div class="toggle-switch on" id="toggle-theme"></div>
        </a>

        <h3
          style="
            margin: 2rem 0 0.5rem 0;
            font-size: 0.9rem;
            color: var(--text-muted);
          "
        >
          SEGURANÇA
        </h3>

        <a href="#" class="setting-item">
          <div class="setting-left">
            <i class="ph ph-shield"></i>
            <span>Alterar Senha</span>
          </div>
          <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
        </a>

        <a href="#" class="setting-item">
          <div class="setting-left">
            <i class="ph ph-fingerprint"></i>
            <span>Biometria</span>
          </div>
          <div class="toggle-switch on" id="toggle-biometry"></div>
        </a>

        <h3
          style="
            margin: 2rem 0 0.5rem 0;
            font-size: 0.9rem;
            color: var(--text-muted);
          "
        >
          OUTROS
        </h3>

        <a href="#" class="setting-item">
          <div class="setting-left">
            <i class="ph ph-question"></i>
            <span>Ajuda</span>
          </div>
          <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
        </a>

        <a href="#" class="setting-item" style="border-bottom: none">
          <div class="setting-left">
            <i class="ph ph-file-text"></i>
            <span>Termos de Uso</span>
          </div>
          <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
        </a>
      </div>

      <nav class="bottom-nav">
        <a href="home.php" class="nav-item"
          ><i class="ph ph-house"></i><span>Início</span></a
        >
        <a href="extrato.php" class="nav-item"
          ><i class="ph ph-receipt"></i><span>Extrato</span></a
        >
        <a href="cartoes.php" class="nav-item"
          ><i class="ph ph-cards"></i><span>Cartões</span></a
        >
        <a href="ajustes.php" class="nav-item active"
          ><i class="ph ph-gear"></i><span>Ajustes</span></a
        >
      </nav>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
