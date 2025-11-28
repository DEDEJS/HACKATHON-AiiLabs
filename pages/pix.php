<?php
include_once("../PHP/sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área Pix | Aiia Bank</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logo_aiia.png" type="image/x-icon">
  </head>
  <body>
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
          <h2>Área Pix</h2>
        </div>
        <i class="ph ph-qr-code"></i>
      </header>

      <div class="pix-grid" style="margin-top: 1.5rem">
        <div class="pix-btn" onclick="window.location.href = 'Transferir.php'">
          <i class="ph ph-paper-plane-tilt"></i>
          <span>Transferir</span>
        </div>
        <div class="pix-btn">
          <i class="ph ph-copy"></i>
          <span>Copia e Cola</span>
        </div>
        <div class="pix-btn">
          <i class="ph ph-qr-code"></i>
          <span>Ler QR Code</span>
        </div>
        <div class="pix-btn" onclick="window.location.href = 'keys.php'">
          <i class="ph ph-key"></i>
          <span><a href="keys.php">Minhas Chaves</a></span>
        </div>
        <div class="pix-btn">
          <i class="ph ph-arrow-counter-clockwise"></i>
          <span>Devolução</span>
        </div>
        <div class="pix-btn">
          <i class="ph ph-question"></i>
          <span>Ajuda</span>
        </div>
      </div>

      <section class="transactions-section">
        <div class="section-header">
          <h2>Favoritos Recentes</h2>
        </div>
        <div class="transaction-list">
          <div class="transaction-item">
            <div
              class="avatar"
              style="
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
                margin-right: 1rem;
              "
            >
              JS
            </div>
            <div class="t-details">
              <strong>João Silva</strong><span>Chave: joao@email.com</span>
            </div>
            <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
          </div>
          <div class="transaction-item">
            <div
              class="avatar"
              style="
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
                margin-right: 1rem;
                background: #8257e5;
              "
            >
              MC
            </div>
            <div class="t-details">
              <strong>Maria Clara</strong><span>Chave: (11) 99999...</span>
            </div>
            <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
          </div>
        </div>
      </section>

      <nav class="bottom-nav">
        <a href="home.php" class="nav-item active"
          ><i class="ph ph-house"></i><span>Início</span></a
        >
        <a href="extrato.php" class="nav-item"
          ><i class="ph ph-receipt"></i><span>Extrato</span></a
        >
        <a href="cartoes.php" class="nav-item"
          ><i class="ph ph-cards"></i><span>Cartões</span></a
        >
        <a href="ajustes.php" class="nav-item"
          ><i class="ph ph-gear"></i><span>Ajustes</span></a
        >
      </nav>
    </div>
    <script src="../js/script.js"></script>
    <script>
      // Script rápido para preencher o Sidebar (se você não quiser copiar e colar manualmente em todos,
      // mas o ideal é copiar o HTML do menu para garantir)
      // O código principal está em ../js/script.js
    </script>
  </body>
</html>
