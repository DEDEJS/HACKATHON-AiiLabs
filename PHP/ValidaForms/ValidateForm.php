<?php
ini_set('default_charset','UTF-8');
class InputHandler {
    public static function get(string $key): ?string {
        return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : null;
    }
}
$InputHandler = new InputHandler();
class ValueDisplay {
    public static function show(string $field) {
        echo InputHandler::get($field);
    }
    public static function showEmail() {
        self::show('email');
    }
    public static function showName() {
        self::show('nome');
    }
    public static function showPhone() {
        self::show('telefone');
    }
    public static function showPassword() {
        self::show('password');
    }
     public static function showDocumento() {
        self::show('documento');
    }
     public static function showAniversario() {
        self::show('aniversario');
    }

 }
 $InputHandler = new InputHandler();
 class Validate{
    public $Nome;
    public $Email;
    public $Cpf;
    public $Cnpj;
    public $Senha;
    public $Aniversario;
    public $Telefone;
     public function validateEmail() {
        $email = InputHandler::get('email');
        
            if(strlen($email) <= 0) {
                echo "Preenche o Campo Email";
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email Inválido";
            } else {
             $this->Email = $email;
            }
        
    }
     public function validateName() {
        $name = InputHandler::get('nome');
            if(strlen($name) <= 2 || strlen($name) >= 70 || !preg_match("/^[\p{L} ]+$/u", $name)) {
                echo "Nome Inválido";
            } else {  
                $this->Nome = $name;
            }
        
    }
    public function validatePhone() {
        $phone = InputHandler::get('telefone');
            if(!preg_match("/^(\d{10}|\d{11})$/", $phone)) {
                echo "Telefone Inválido";
               
            } else {
                $this->Telefone = $phone;
                return true;
            }
        
    }
   public function validatePassword() {
        $password = InputHandler::get('password');
         if(strlen($password) <= 6 || strlen($password) > 31) {
         echo "Senha Inválida";
         }else{
            $this->Senha = $password;
         }
        
       
    }
     public function validateCpf() {
        $cpf = InputHandler::get('documento');
        $cpfClean = preg_replace('/\D/', '', $cpf);
            if(strlen($cpfClean) != 11 || preg_match('/(\d)\1{10}/', $cpfClean)) {
                echo "CPF Inválido";
                return false;
            } else {
               $this->Cpf = $cpfClean;
            }
        
    }
    public function validateCnpj() {
        $cnpj = InputHandler::get('documento');
        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            echo "CNPJ Inválido";
            return false;
        }

        $multiplicadores1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $multiplicadores2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        // 1º dígito
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $multiplicadores1[$i];
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        // 2º dígito
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $multiplicadores2[$i];
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        if ((int)$cnpj[12] !== $digito1 || (int)$cnpj[13] !== $digito2) {
            echo "CNPJ Inválido";
            return false;
        }

         $this->Cnpj = $cnpj;
        return true;
}

    public function ValidateDocumento(){
        $documento = InputHandler::get('documento');
        if(strlen($documento) == 14){
          return $this-> validateCpf();
        }else if(strlen($documento) == 18){
          return $this-> validateCnpj();
        }else{
            echo "Documento Inválido";
        }
    }
public function ValidateBirthday() {
        $birthday = InputHandler::get('aniversario');
        if (empty($birthday)) {
            echo "Por favor, informe a data de aniversário.";
            return false;
        }
        $date = DateTime::createFromFormat('Y-m-d', $birthday);
        if (!$date || $date->format('Y-m-d') !== $birthday) {
            echo "Data de aniversário inválida.";
            return false;
        }
         $this->Aniversario = $birthday;
        return true;
}
    public function Header($Connection){
        include_once("PHP/CRUD/select.php");
        $Nome = $this->Nome; 
        $Email = $this->Email;
        $Cnpj = $this->Cnpj;
        $Cpf = $this->Cpf;
        $Senha = password_hash($this->Senha, PASSWORD_DEFAULT);
        $Aniversario = $this->Aniversario;
        $Telefone = $this-> Telefone;
        if($Cnpj == null){
             
               $Document = $Cpf;
          }else if($Cpf == null){         
                 $Document = $Cnpj;
          }
         if($Nome != null && $Email != null  && $Senha != null && $Aniversario != null && $Telefone != null ){
            if($CheckSelect-> CheckEmail($Connection,$Email) == false){
              echo "Email Já Está  Sendo Utilizado, Deseja Logar? <a href='index.php'>Logar </a>";
            }else if($CheckSelect-> CheckTelefone($Connection, $Telefone) == false){
              echo "Telefone Já Está  Sendo Utilizado, Deseja Logar? <a href='index.php'>Logar </a>";
            }else if($CheckSelect -> CheckDocument($Connection, $Document) == false){
              echo "O Documento Já Está  Sendo Utilizado, Deseja Logar? <a href='index.php'>Logar </a>";
            }else{
            include_once("PHP/CRUD/insert.php");
           $InsertUser -> InsertUser($Connection,$Nome,$Email,$Cnpj,$Cpf,$Senha,$Aniversario,$Telefone);         
        }
    }
}    
    public function Logar($Connection){
        $Cnpj = $this->Cnpj;
        $Cpf = $this->Cpf;
        $Senha = $this->Senha;
          if($Cnpj == null){
               $Document = $Cpf;
          }else if($Cpf == null){         
                 $Document = $Cnpj;
          }else{
            $Document == null;
          }
          if($Senha != null && $Document != null){
            include_once("PHP/CRUD/select.php");
            $Logar -> SelectLogin($Connection, $Document, $Senha);
          } else{
          }
         
    }  
 }
$Validate = new Validate();
class HeaderCadastro{

}
