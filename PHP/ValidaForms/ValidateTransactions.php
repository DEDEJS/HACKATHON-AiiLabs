<?php
ini_set('default_charset','UTF-8');
class InputHandlerTransaction {
    public static function get(string $key): ?string {
        return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : null;
    }
}
$InputHandler = new InputHandlerTransaction();
class ValueDisplayTransction {
    public static function show(string $field) {
        echo InputHandlerTransaction::get($field);
    }
    public static function showKey() {
        self::show('Key');
    }
    public static function showKeyPix() {
        self::show('KeyPix');
    }
     public static function showValueTransactionPix() {
        self::show('ValueTransaction');
    }
 }
 class ValidateTransaction{
       public $KeyEmail;
       public $KeyPhone;
       public $ValueTransaction;
     public function validateKey() {
        $Key = InputHandlerTransaction::get('Key');
        $KeysArray = array("email","Phone");
            if($Key != $KeysArray[0] && $Key != $KeysArray[1]){
               echo 'Escolha Um Tipo De Chave';
               
            }
    }
    public function ValidateKeyPix(){
         $KeyPix = InputHandlerTransaction::get('KeyPix');
         $Key = InputHandlerTransaction::get('Key');
          if($Key == "email"){
            if(strlen($Key) <= 0) {
                echo "Preenche o Campo Email";
            } else if(!filter_var($KeyPix, FILTER_VALIDATE_EMAIL)) {
                echo "Email Inválido".$KeyPix;
            } else {
             $this->KeyEmail = $KeyPix;
            }
          }else if($Key == "phone"){
             if(!preg_match("/^(\d{10}|\d{11})$/", $KeyPix)) {
                echo "Telefone Inválido";
               
            } else {
                $this->KeyPhone = $KeyPix;
            }
          }
    }
    public function validateValueTransaction() {
    $value = InputHandlerTransaction::get('ValueTransaction');
    if (empty($value)) {
        echo "O valor não pode estar vazio";
        return false;
    }
    $value = str_replace(",", ".", $value);
    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $value)) {
        echo "Valor inválido";
        return false;
    }
    if ($value <= 0) {
        echo "O valor deve ser maior que zero";
        return false;
    }

    $this->ValueTransaction = $value;
    return true;
}
   public function HeaderTransiction($Connection){
    if($this->KeyEmail != null ){
         $KeyPix = $this->KeyEmail;
         $Type = "Email";
    }else if($this->KeyPhone != null){
          $KeyPix = $this->KeyPhone;
          $Type = "Phone";
    }else{
        $KeyPix = false;
        $Type = false;
    }
     $KeyValue = $this-> ValueTransaction;
      if($KeyPix != false && $KeyValue != false){
           include_once("../PHP/CRUD/select.php");
           $ID = $_SESSION['ID'];
           $CheckSelect -> CheckEmailAndPhone($Connection, $KeyValue,$ID,$Type,$KeyPix);
           $Transactions-> AlteraBalance($Connection,$CheckSelect,$KeyValue,$ID);
      }else{
        echo 'falta';
      }
   }

 }
 $transaction = new ValidateTransaction();