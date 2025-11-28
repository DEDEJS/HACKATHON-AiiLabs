<?php
include_once("../PHP/sessions/sessions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Empréstimos | App Banco</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
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
      <header class="app-header" style="padding-bottom: 2rem">
        <div class="header-left">
          <i
            class="ph ph-list"
            id="open-menu"
            style="font-size: 2rem; cursor: pointer; margin-right: 15px"
          ></i>
          <h2>Empréstimo</h2>
        </div>
        <i class="ph ph-coins"></i>
      </header>

      <div class="loan-simulator">
        <p style="color: var(--text-muted); font-size: 0.9rem">
          Valor disponível para você
        </p>
        <div class="loan-display" id="loanValueDisplay">R$ 5.000,00</div>

        <div class="slider-container">
          <label>Quanto você precisa?</label>
          <input
            type="range"
            min="500"
            max="20000"
            step="100"
            value="5000"
            id="loanSlider"
          />
        </div>

        <div class="slider-container">
          <label
            >Em quantas vezes?
            <strong id="monthDisplay" style="color: var(--primary)"
              >12x</strong
            ></label
          >
          <input
            type="range"
            min="1"
            max="48"
            step="1"
            value="12"
            id="monthSlider"
          />
        </div>

        <div class="loan-summary">
          <span>Valor da parcela:</span>
          <strong id="installmentValue">R$ 458,33</strong>
        </div>

        <button
          class="btn-primary"
          style="
            margin-top: 1.5rem;
            background-color: var(--primary);
            border: none;
            padding: 1rem;
            width: 100%;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
          "
        >
          Simular Contratação
        </button>
      </div>

      <nav class="bottom-nav">
        <a href="home.html" class="nav-item"
          ><i class="ph ph-house"></i><span>Início</span></a
        >
        <a href="extrato.html" class="nav-item"
          ><i class="ph ph-receipt"></i><span>Extrato</span></a
        >
        <a href="cartoes.html" class="nav-item"
          ><i class="ph ph-cards"></i><span>Cartões</span></a
        >
        <a href="ajustes.html" class="nav-item"
          ><i class="ph ph-gear"></i><span>Ajustes</span></a
        >
      </nav>
    </div>

    <script src="../js/script.js"></script>

    <script>
      const loanSlider = document.getElementById("loanSlider");
      const loanDisplay = document.getElementById("loanValueDisplay");
      const monthSlider = document.getElementById("monthSlider");
      const monthDisplay = document.getElementById("monthDisplay");
      const installmentDisplay = document.getElementById("installmentValue");

      function updateLoan() {
        const value = parseFloat(loanSlider.value);
        const months = parseInt(monthSlider.value);

        // Simulação simples de juros (5% ao mês só para exemplo visual)
        const totalWithInterest = value * 1.5;
        const installment = totalWithInterest / months;

        // Formatação para Real Brasileiro
        loanDisplay.innerText = value.toLocaleString("pt-br", {
          style: "currency",
          currency: "BRL",
        });
        monthDisplay.innerText = months + "x";
        installmentDisplay.innerText = installment.toLocaleString("pt-br", {
          style: "currency",
          currency: "BRL",
        });
      }

      // Ouve o evento de "mexer" no slider
      loanSlider.addEventListener("input", updateLoan);
      monthSlider.addEventListener("input", updateLoan);
    </script>
  </body>
</html>
