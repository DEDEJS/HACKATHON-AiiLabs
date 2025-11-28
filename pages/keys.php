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
    <title>Minhas Chaves | Aiia Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
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
            <div class="header-left header-with-back">
                <a href="pix.php" class="back-btn"><i class="ph ph-arrow-left"></i></a>
                <h2>Minhas Chaves</h2>
            </div>
            <i class="ph ph-key"></i>
        </header>

        <div style="margin: 1.5rem 1.5rem 2rem 1.5rem;">
            <button class="btn-primary" style="margin: 0; display: flex; align-items: center; justify-content: center; gap: 10px;">
                <i class="ph ph-plus"></i> Cadastrar Nova Chave
            </button>
        </div>

        <section class="transactions-section">
            <div class="section-header">
                <h2>Chaves Cadastradas</h2>
            </div>
            
            <div class="transaction-list">
                <?php 
                    // Envolvi em um try/catch visual caso dê erro no PHP deles
                    if(isset($Transactions)) {
                        $Transactions->GetKeysUser($Connection,$SessionUser); 
                    }
                ?>
            </div>
        </section>

        </div>
    <script src="../js/script.js"></script>
</body>
</html>