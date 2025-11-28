<?php
include_once("../PHP/sessions/sessions.php");
include_once("../PHP/Banco/Banco.php");

include_once("../PHP/ValidaForms/ValidateTransactions.php");
$Connection = $Banco->conecta();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área Pix | App Banco</title>
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

      <<nav class="sidebar-nav">
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
          <h2>Área Pix </h2>
        </div>
        <i class="ph ph-qr-code"></i>
      </header>

      <div class="pix-grid" style="margin-top: 1.5rem">
        <div class="pix-btn">
          <i class="ph ph-paper-plane-tilt"></i>
          <span><a href="Transferir.php">Transferir</a></span>
        </div>
        <div class="pix-btn">
          <i class="ph ph-copy"></i>
          <span>Copia e Cola</span>
        </div>
        <div class="pix-btn">
          <i class="ph ph-qr-code"></i>
          <span>Ler QR Code</span>
        </div>
        <div class="pix-btn">
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
          <h2>Transferir:</h2>
        </div>
        <form action="#" method="post">
            <h1>Escolha A Chave</h1>
            <select name="Key">
                <option>Email</option>
                <option>Telefone</option>
            </select>
            <?php $transaction-> validateKey() ; ?> <!--Aqui vai a mensagem de erro vinda diretamento do php --><br>
            <input type="text" name="KeyPix" placeholder="Chave Pix">
             <?php $transaction-> ValidateKeyPix() ; ?> <!--Aqui vai a mensagem de erro vinda diretamento do php --><br>
            <input type="number" name="ValueTransaction" placeholder="Valor">
            <?php $transaction->validateValueTransaction(); ?>
             <input type="submit" value="Enviar">
             <?php $transaction->HeaderTransiction($Connection); ?>
        </form>
          
      </section>

      <nav class="bottom-nav">
        <a href="home.html" class="nav-item active"
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
      // Script rápido para preencher o Sidebar (se você não quiser copiar e colar manualmente em todos,
      // mas o ideal é copiar o HTML do menu para garantir)
      // O código principal está em ../js/script.js
    </script>
  </body>
</html>
