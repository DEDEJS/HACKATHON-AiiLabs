<?php
include_once("../PHP/sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Extrato | Aiia Bank</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
          <h2>Extrato</h2>
        </div>
        <i class="ph ph-funnel"></i>
      </header>

      <div class="search-bar">
        <i class="ph ph-magnifying-glass" style="color: var(--text-muted)"></i>
        <input type="text" placeholder="Buscar lançamentos..." />
      </div>

      <div
        class="chart-container"
        style="
          position: relative;
          height: 250px;
          width: 100%;
          padding: 0 1.5rem;
          margin-bottom: 1.5rem;
        "
      >
        <canvas id="expenseChart"></canvas>
      </div>

      <section class="transactions-section" style="padding: 0">
        <div class="date-divider">Hoje, 26 de Novembro</div>
        <div class="transaction-list" style="padding: 0 1.5rem">
          <div class="transaction-item">
            <div class="t-icon expense"><i class="ph ph-coffee"></i></div>
            <div class="t-details">
              <strong>Padaria Estrela</strong><span>Café da manhã</span>
            </div>
            <div class="t-amount expense">- R$ 14,50</div>
          </div>
          <div class="transaction-item">
            <div class="t-icon income"><i class="ph ph-money"></i></div>
            <div class="t-details">
              <strong>Reembolso</strong><span>Estorno iFood</span>
            </div>
            <div class="t-amount income">+ R$ 32,90</div>
          </div>
        </div>

        <div class="date-divider">Ontem, 25 de Novembro</div>
        <div class="transaction-list" style="padding: 0 1.5rem">
          <div class="transaction-item">
            <div class="t-icon expense">
              <i class="ph ph-shopping-cart"></i>
            </div>
            <div class="t-details">
              <strong>Supermercado Extra</strong><span>Compras do mês</span>
            </div>
            <div class="t-amount expense">- R$ 450,20</div>
          </div>
          <div class="transaction-item">
            <div class="t-icon service"><i class="ph ph-film-strip"></i></div>
            <div class="t-details">
              <strong>Netflix</strong><span>Assinatura</span>
            </div>
            <div class="t-amount expense">- R$ 55,90</div>
          </div>
        </div>
      </section>

      <nav class="bottom-nav">
        <a href="home.php" class="nav-item"
          ><i class="ph ph-house"></i><span>Início</span></a
        >
        <a href="extrato.php" class="nav-item active"
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
  </body>
</html>
