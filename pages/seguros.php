<?php
include_once("../PHP/sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seguros | Aiia Bank</title>
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
          <h2>Seguros</h2>
        </div>
        <i class="ph ph-shield-check"></i>
      </header>

      <h3 style="margin: 1.5rem; font-size: 1rem; color: var(--text-muted)">
        PROTEÇÕES DISPONÍVEIS
      </h3>

      <div class="insurance-card">
        <div class="insurance-info">
          <h3>Seguro de Vida</h3>
          <p>Proteção para você e família</p>
          <span class="price-tag">R$ 14,90 / mês</span>
        </div>
        <button class="btn-hire">Contratar</button>
      </div>

      <div class="insurance-card">
        <div class="insurance-info">
          <h3>Seguro Celular</h3>
          <p>Contra roubo e quebra de tela</p>
          <span class="price-tag">R$ 29,90 / mês</span>
        </div>
        <button class="btn-hire">Contratar</button>
      </div>

      <div class="insurance-card">
        <div class="insurance-info">
          <h3>Cartão Protegido</h3>
          <p>Segurança para transações Pix</p>
          <span class="price-tag">R$ 9,90 / mês</span>
        </div>
        <button class="btn-hire">Contratar</button>
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
        <a href="ajustes.php" class="nav-item"
          ><i class="ph ph-gear"></i><span>Ajustes</span></a
        >
      </nav>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
