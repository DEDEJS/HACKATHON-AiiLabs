<?php
class Check{
    public $EmailTransaction;
    public $PhoneTransaction;
    public $Dados;
    public function CheckEmail($Connection,$Email){
       if($Email){
          $SQLEMAIL = "SELECT email FROM userdata WHERE Email = :Email LIMIT 1";
           $QueryEmail = $Connection->prepare($SQLEMAIL);
           $QueryEmail->bindParam(':Email', $Email, PDO::PARAM_STR);
           $QueryEmail->Execute();
           $EmailEncontrado = $QueryEmail->fetch(PDO::FETCH_ASSOC);
           if ($EmailEncontrado) {
            return false;
      } else {return true;}
       }
    }
    public function CheckTelefone($Connection, $Telefone){
         if($Telefone){
            $SQLTelefone = "SELECT Phone FROM userdata WHERE Phone = :Phone LIMIT 1";
           $QueryTelefone = $Connection->prepare($SQLTelefone);
           $QueryTelefone->bindParam(':Phone', $Telefone, PDO::PARAM_STR);
           $QueryTelefone->Execute();
           $TelefoneEncontrado = $QueryTelefone->fetch(PDO::FETCH_ASSOC);
           if ($TelefoneEncontrado) {
            return false;
      } else {return true;}
         }
    }
      public function CheckDocument($Connection, $Document){
         if($Document){
            $SQLDocument = "SELECT Phone FROM userdata WHERE Document = :Document LIMIT 1";
           $SQLDocument = $Connection->prepare($SQLDocument);
           $SQLDocument->bindParam(':Document', $Document, PDO::PARAM_STR);
           $SQLDocument->Execute();
           $DocumentEncontrado = $SQLDocument->fetch(PDO::FETCH_ASSOC);
           if ($DocumentEncontrado) {
            return false;
      } else {return true;}
         }
    }

     public function CheckEmailAndPhone($Connection, $KeyValue, $ID, $Type, $KeyPix){
            if(!$KeyValue){
                return false;
            }
            $SQLSELF = "SELECT Id, Email, Phone FROM userdata WHERE Id = :ID";
            $querySelf = $Connection->prepare($SQLSELF);
            $querySelf->bindParam(':ID', $ID, PDO::PARAM_INT);
            $querySelf->execute();
            $SelfData = $querySelf->fetch(PDO::FETCH_ASSOC);

            if(!$SelfData){
                echo "Erro ao verificar usuário atual.";
                return false;
            }
            if($Type == "Email"){
                if($SelfData['Email'] === $KeyPix){
                    echo "Email inválido. Você não pode enviar para você mesmo.";
                    return false;
                }
            } elseif ($Type == "Phone"){
                if($SelfData['Phone'] === $KeyPix){
                    echo "Telefone inválido. Você não pode enviar para você mesmo.";
                    return false;
                }
            }
            $SQLFIND = "SELECT Id, Email, Phone 
                        FROM userdata 
                        WHERE (Email = :pix OR Phone = :pix)
                        AND Id != :ID";

            $queryFind = $Connection->prepare($SQLFIND);
            $queryFind->bindParam(':pix', $KeyPix, PDO::PARAM_STR);
            $queryFind->bindParam(':ID', $ID, PDO::PARAM_INT);
            $queryFind->execute();
            $UserFound = $queryFind->fetch(PDO::FETCH_ASSOC);

            if(!$UserFound){
                echo "Chave PIX não encontrada.";
                return false;
            }

            if($Type == "Email"){
                $this->EmailTransaction = true;
            } elseif ($Type == "Phone") {
                $this->PhoneTransaction = true;
            }
            return $this->Dados = $UserFound;
}


          public function Retorn(){
              if($this->PhoneTransaction == true){

                return $this->Dados;
              }else if($this->EmailTransaction == true){
                return $this->Dados;
              }else{
                return false;
              }
          }
    
}
$CheckSelect = new Check();
class Login {
    public function SelectLogin($Connection, $Document, $Senha) {
        $query = $Connection->prepare(
            "SELECT Id, Name ,Document, PasswordHash
             FROM userdata  
             WHERE Document = :Document"
        );
        $query->bindParam(':Document', $Document);
        $query->execute();

        if ($query->rowCount() > 0) {
            $loginData = $query->fetch(PDO::FETCH_ASSOC);
            $Id = $loginData['Id'];
            if (password_verify($Senha, $loginData['PasswordHash'])) {
               include_once("PHP/CRUD/insert.php");
                $InsertUser -> InsertLogin($Connection,$Id);
                
                $_SESSION['ID'] = $loginData['Id'];
                $_SESSION['Nome'] = $loginData['Name'];
                header("location:pages/home.php");
            } else {
                echo 'Senha ou Documento Errado';
            }
        } else {
            echo 'Senha ou Documento Errado';
        }
    }
}
$Logar = new Login();
class Transations{
     public function GetValueMoney($Connection){
        if (isset($_SESSION['ID'])) {
        $SQLGETMONEY = "SELECT UserDataId, Balance FROM accounts WHERE UserDataId = :ID";
        $stmt = $Connection->prepare($SQLGETMONEY);

        $stmt->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $QueryResultGetMoney = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $QueryResultGetMoney['Balance'];
        }
    }

  }
   public function GetKeysUser($Connection, $SessionUser) {
    if (isset($_SESSION['ID'])) {

        $sql = "SELECT Type, Value, IDUser FROM keyspix WHERE IDUser = :ID";
        $stmt = $Connection->prepare($sql);
        $stmt->bindParam(':ID', $_SESSION['ID'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($key = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <div class="transaction-item">
                    <div class="avatar" style="width:40px;height:40px;font-size:0.9rem;margin-right:1rem;background:#8257e5;"></div>
                    <div class="t-details">
                        <strong>Tipo: '.$key["Type"].'</strong>
                        <span>Chave: '.$key["Value"].'</span>
                    </div>
                    <i class="ph ph-caret-right" style="color: var(--text-muted)"></i>
                </div>
                ';
            }
        } else {
            echo '<p>Nenhuma chave cadastrada.</p>';
        }
    }
    }
   public function AlteraBalance($Connection, $CheckSelect, $KeyValue, $ID)
{
    // 1. Buscar usuário recebedor (já validado no CheckSelect)
    $Recebedor = $CheckSelect->Retorn();
    if (!$Recebedor) {
        echo "Erro: chave PIX inválida.";
        return false;
    }

    $RecebedorID = $Recebedor['Id']; 

    try {
        $Connection->beginTransaction();

        $SQLSender = "SELECT Balance FROM accounts WHERE UserDataId = :ID FOR UPDATE";
        $QuerySender = $Connection->prepare($SQLSender);
        $QuerySender->bindParam(':ID', $ID, PDO::PARAM_INT);
        $QuerySender->execute();
        $SenderData = $QuerySender->fetch(PDO::FETCH_ASSOC);

        if (!$SenderData) {
            echo "Erro: conta do remetente não encontrada.";
            $Connection->rollBack();
            return false;
        }

        $SaldoRemetente = $SenderData['Balance'];

        if ($SaldoRemetente < $KeyValue) {
            echo "Saldo insuficiente.";
            $Connection->rollBack();
            return false;
        }

        $SQLReceiver = "SELECT Balance FROM accounts WHERE UserDataId = :RID FOR UPDATE";
        $QueryReceiver = $Connection->prepare($SQLReceiver);
        $QueryReceiver->bindParam(':RID', $RecebedorID, PDO::PARAM_INT);
        $QueryReceiver->execute();
        $ReceiverData = $QueryReceiver->fetch(PDO::FETCH_ASSOC);

        if (!$ReceiverData) {
            echo "Erro: conta do recebedor não encontrada.";
            $Connection->rollBack();
            return false;
        }

        $SQLDebito = "UPDATE accounts 
                      SET Balance = Balance - :valor 
                      WHERE UserDataId = :ID";

        $QueryDebito = $Connection->prepare($SQLDebito);
        $QueryDebito->bindParam(':valor', $KeyValue);
        $QueryDebito->bindParam(':ID', $ID);
        $QueryDebito->execute();

        $SQLCredito = "UPDATE accounts 
                       SET Balance = Balance + :valor 
                       WHERE UserDataId = :RID";

        $QueryCredito = $Connection->prepare($SQLCredito);
        $QueryCredito->bindParam(':valor', $KeyValue);
        $QueryCredito->bindParam(':RID', $RecebedorID);
        $QueryCredito->execute();

        $SQLTransOut = "INSERT INTO transactions (AccountId, Type, Amount, Description)
                        VALUES ((SELECT Id FROM accounts WHERE UserDataId = :ID),
                                'PIX_OUT', :valor, 'PIX enviado')";
        $QOut = $Connection->prepare($SQLTransOut);
        $QOut->bindParam(':ID', $ID);
        $QOut->bindParam(':valor', $KeyValue);
        $QOut->execute();

        $SQLTransIn = "INSERT INTO transactions (AccountId, Type, Amount, Description)
                       VALUES ((SELECT Id FROM accounts WHERE UserDataId = :RID),
                               'PIX_IN', :valor, 'PIX recebido')";
        $QIn = $Connection->prepare($SQLTransIn);
        $QIn->bindParam(':RID', $RecebedorID);
        $QIn->bindParam(':valor', $KeyValue);
        $QIn->execute();

        $Connection->commit();
        echo "PIX enviado com sucesso!";
        return true;

    } catch (PDOException $e) {
        $Connection->rollBack();
        echo "Erro na transação: " . $e->getMessage();
        return false;
    }
}

        

}
$Transactions = new Transations();
?>