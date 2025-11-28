<?php
include_once("../PHP/sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartões | App Banco</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <div class="user-info-sidebar">
          <div class="avatar">SC</div>
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
        <header class="app-header" style="padding-bottom: 2rem;">
            <div class="header-left">
                <i class="ph ph-list" id="open-menu" style="font-size: 2rem; cursor: pointer; margin-right: 15px;"></i>
                <h2>Meus Cartões</h2>
            </div>
            <i class="ph ph-plus"></i>
        </header>

        <div class="card-display">
            <div class="card-header-visual">
                <div class="chip-icon"></div>
                <i class="ph ph-contactless-payment" style="font-size: 1.5rem;"></i>
            </div>
            <div class="card-number">•••• •••• •••• 8842</div>
            <div class="card-footer-visual">
                <div class="card-info">
                    <label>Titular</label>
                    <span>STENIO CALADO</span>
                </div>
                <div class="card-info">
                    <label>Validade</label>
                    <span>12/29</span>
                </div>
            </div>
        </div>

        <div class="limit-bar-container">
            <div class="limit-info">
                <span>Fatura atual</span>
                <strong>R$ 1.250,00</strong>
            </div>
            <div class="progress-bg">
                <div class="progress-fill"></div>
            </div>
            <div class="limit-info" style="margin-top: 5px;">
                <label>Limite disponível</label>
                <label>R$ 800,00</label>
            </div>
        </div>

        <section class="quick-actions" style="justify-content: flex-start; gap: 1.5rem;">
            <div class="action-btn">
                <div class="icon-box"><i class="ph ph-lock-key"></i></div>
                <span>Bloquear</span>
            </div>
            <div class="action-btn">
                <div class="icon-box"><i class="ph ph-credit-card"></i></div>
                <span>Virtual</span>
            </div>
            <div class="action-btn">
                <div class="icon-box"><i class="ph ph-password"></i></div>
                <span>Senha</span>
            </div>
        </section>

        <section class="transactions-section">
            <div class="section-header">
                <h2>Fatura Aberta</h2>
            </div>
            <div class="transaction-list">
                <div class="transaction-item">
                    <div class="t-icon expense"><i class="ph ph-bag"></i></div>
                    <div class="t-details"><strong>Magalu</strong><span>Eletrônicos</span></div>
                    <div class="t-amount expense">- R$ 1.250,00</div>
                </div>
            </div>
        </section>

        <nav class="bottom-nav">
             <a href="home.html" class="nav-item"><i class="ph ph-house"></i><span>Início</span></a>
            <a href="extrato.html" class="nav-item"><i class="ph ph-receipt"></i><span>Extrato</span></a>
            <a href="cartoes.html" class="nav-item active"><i class="ph ph-cards"></i><span>Cartões</span></a>
            <a href="ajustes.html" class="nav-item"><i class="ph ph-gear"></i><span>Ajustes</span></a>
        </nav>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>