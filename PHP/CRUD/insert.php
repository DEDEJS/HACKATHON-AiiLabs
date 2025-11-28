<?php
class InsertUser{
  public function InsertLogin($Connection, $Id) {
    try {
        // Inicia a transação
        $Connection->beginTransaction();

        $QueryInsertLogin = $Connection->prepare('
            INSERT INTO UserLogin (UserDataId)
            VALUES (:ID)
        ');

        $QueryInsertLogin->execute([
            ':ID' => $Id
        ]);

        // Confirma a transação
        $Connection->commit();

    } catch (PDOException $e) {
        // Verifica se há transação ativa antes de dar rollback
        if ($Connection->inTransaction()) {
            $Connection->rollBack();
        }
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}

    public function InsertUser($Connection,$Nome,$Email,$Cnpj,$Cpf,$Senha,$Aniversario,$Telefone){
          if($Cnpj == null){
               $Account = "CPF";
               $Document = $Cpf;
          }else if($Cpf == null){         
                $Account = "CNPJ";
                 $Document = $Cnpj;
          }
        try {
        $Connection->beginTransaction();

        $QueryInsertUser = $Connection->prepare('
            INSERT INTO UserData (Email, PasswordHash, Name, Phone,DateOfBirth ,AccountType, Document)
            VALUES (:Email, :PasswordHash, :Name, :Phone, :DateOfBirth, :AccountType, :Document)
        ');
        $QueryInsertUser->execute(array(
            ':Email' => $Email,
            ':PasswordHash' => $Senha,
            ':Name' => $Nome,
            ':Phone' => $Telefone,
            ':DateOfBirth' => $Aniversario,
            ':AccountType' => $Account,
            ':Document' => $Document
        ));
         $userId = $Connection->lastInsertId();
         $QueryInsertMoney = $Connection->prepare('
         INSERT INTO accounts (UserDataId, Balance) 
         VALUES (:ID, :Money)
         ');
         $QueryInsertMoney->execute(array(
            ':ID' => $userId,
            ':Money' => "500"
         ));
      $QueryInsertKeyPHONE = $Connection->prepare('
     INSERT INTO keyspix (Type, Value, IDUser, Hora) 
     VALUES (:Type, :Value, :IDUser, :Hora)
     ');
        $QueryInsertKeyPHONE->execute(array(
            ':Type' => "PHONE",
            ':Value' => $Telefone,
            ':IDUser'=> $userId,
            ':Hora' => date('Y-m-d H:i:s')
        ));
        $QueryInsertKeyEMAIL = $Connection->prepare('
     INSERT INTO keyspix (Type, Value, IDUser, Hora) 
     VALUES (:Type, :Value, :IDUser, :Hora)
     ');
        $QueryInsertKeyEMAIL->execute(array(
            ':Type' => "EMAIL",
            ':Value' => $Email,
            ':IDUser'=> $userId,
            ':Hora' => date('Y-m-d H:i:s')
        ));

       
        $Connection->commit();
        echo "Usuário cadastrado com sucesso!";
        header("location:index.php");
    } catch (Exception $e) {
        $Connection->rollBack();
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
       }
}

$InsertUser = new InsertUser();
?>