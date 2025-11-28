<?php
class Check{
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
    public function CheckBalance($Connection, $KeyValue,$ID,$Type,$KeyPix){
             if($KeyValue){
                $SQLVALUEBALANCE = "SELECT Id, Email, Phone  FROM userdata WHERE Id = :ID";
                $SQLVALUEBALANCE = $Connection->prepare($SQLVALUEBALANCE);
                $SQLVALUEBALANCE->bindParam(':ID', $ID, PDO::PARAM_STR);
                $SQLVALUEBALANCE->Execute();
                $DadoEncontrado = $SQLVALUEBALANCE->fetch(PDO::FETCH_ASSOC);
                if($Type == "Email"){
                     if($DadoEncontrado['Email'] == $KeyPix){
                        echo "Email Inválido, Você Não Pode Enviar Para Voce Mesmo";
                        return false;
                     }else{
                      return true;
                     }
                }else if($Type == "Phone"){
                    if($DadoEncontrado['Phone'] == $KeyPix){
                      echo "Telefone Inválido, Você Não Pode Enviar Para Voce Mesmo";
                      return false;
                    }else{
                        return true;
                    }
                }
                  
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
        

}
$Transactions = new Transations();
?>