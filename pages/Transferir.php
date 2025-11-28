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
    <title>Transferir Pix | Aiia Bank</title>
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
                <h2>Nova Transferência</h2>
            </div>
            <i class="ph ph-paper-plane-tilt"></i>
        </header>

        <section class="form-container">
            <form action="#" method="post" id="transfer-form">
                
                <div class="input-group">
                    <label class="form-label">Tipo de Chave</label>
                    <select name="Key" class="input-field" id="pix-type">
                        <option value="cpf" <?php echo (isset($_POST['Key']) && $_POST['Key'] === 'cpf') ? 'selected' : ''; ?>>CPF/CNPJ</option>
                        <option value="email" <?php echo (isset($_POST['Key']) && $_POST['Key'] === 'Email') ? 'selected' : ''; ?>>E-mail</option>
                        <option value="phone" <?php echo (isset($_POST['Key']) && $_POST['Key'] === 'phone') ? 'selected' : ''; ?>>Telefone</option>
                        <option value="random" <?php echo (isset($_POST['Key']) && $_POST['Key'] === 'random') ? 'selected' : ''; ?>>Chave Aleatória</option>
                    </select>
                    <span class="php-error"><?php if(isset($transaction)) $transaction->validateKey(); ?></span>
                </div>

                <div class="input-group">
                    <label class="form-label">Chave Pix</label>
                    <input type="text" name="KeyPix" class="input-field" id="pix-key" 
                           placeholder="Digite a chave" 
                           value="<?php echo isset($_POST['KeyPix']) ? htmlspecialchars($_POST['KeyPix']) : ''; ?>" required>
                    <span class="php-error"><?php if(isset($transaction)) $transaction->ValidateKeyPix(); ?></span>
                </div>

                <div class="input-group">
                    <label class="form-label">Valor (R$)</label>
                    <input type="text" name="ValueTransaction" class="input-field" id="pix-value" 
                           placeholder="0,00" 
                           value="<?php echo isset($_POST['ValueTransaction']) ? htmlspecialchars($_POST['ValueTransaction']) : ''; ?>" required>
                    <span class="php-error"><?php if(isset($transaction)) $transaction->validateValueTransaction(); ?></span>
                </div>

                <input type="submit" value="Revisar e Enviar" class="btn-primary" style="margin-top: 1rem;">
                
                <div style="margin-top: 10px; text-align: center;">
                    <?php if(isset($transaction)) $transaction->HeaderTransiction($Connection); ?>
                </div>
            </form>
        </section>

        <nav class="bottom-nav">
            </nav>
    </div>
    <script src="../js/script.js"></script>
    <script src="../js/pix-validation.js"></script>
</body>
</html>