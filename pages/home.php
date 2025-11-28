<?php
include_once("../PHP/sessions/sessions.php");
include_once("../PHP/CRUD/select.php");
include_once("../PHP/Banco/Banco.php");
$SessionUser -> CheckSessionLogin();
$Connection = $Banco->conecta();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Minha Conta | Aiia Bank</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
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
      <header class="app-header">
        <div class="header-left">
          <i
            class="ph ph-list"
            id="open-menu"
            style="font-size: 2rem; cursor: pointer; margin-right: 15px"
          ></i>
          <div class="greeting">
            <span id="greeting-text">Olá,</span>
            <strong><?php  echo $_SESSION['Nome'];?></strong>
          </div>
        </div>
        <div class="header-icons">
          <i class="ph ph-eye" id="toggle-balance"></i>
          <i class="ph ph-bell"></i>
        </div>
      </header>

      <section class="balance-card">
        <div class="balance-label">
          <span>Saldo disponível</span>
          <i class="ph ph-caret-right"></i>
        </div>
        <h1 class="balance-value" id="balance-amount"><?php $Transactions -> GetValueMoney($Connection); ?></h1>
      </section>

      <section class="quick-actions">
        <div class="action-btn">
          <div class="icon-box" onclick="window.location.href = 'pix.php'"><i class="ph ph-pix-logo"></i></div>
          <span>Área Pix</span>
        </div>
        <div class="action-btn">
          <div class="icon-box"><i class="ph ph-barcode"></i></div>
          <span>Pagar</span>
        </div>
        <div class="action-btn" onclick="window.location.href = 'Transferir.php'">
          <div class="icon-box"><i class="ph ph-arrow-up-right"></i></div>
          <span>Transferir</span>
        </div>
        <div class="action-btn">
          <div class="icon-box"><i class="ph ph-credit-card" onclick="window.location.href = 'cartoes.php'"></i></div>
          <span>Cartões</span>
        </div>
      </section>

      <section class="transactions-section">
        <div class="section-header">
          <h2>Histórico</h2>
          <a href="#">Ver tudo</a>
        </div>
        <div class="transaction-list">
          <div class="transaction-item">
            <div class="t-icon expense">
              <i class="ph ph-shopping-cart"></i>
            </div>
            <div class="t-details">
              <strong>Supermercado Extra</strong>
              <span>Ontem, 19:30</span>
            </div>
            <div class="t-amount expense">- R$ 450,20</div>
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
  </body>
  <script src="../js/script.js"></script>
</html>
