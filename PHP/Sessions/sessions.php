<?php
session_start();
class SessionUser{
    public function CheckSessionLogin(){
       if(!isset($_SESSION['ID']) && !isset($_SESSION['Nome'])){
          header("location:http://localhost/Projects/HackthonAiilabs/index.php");
        }else{
           
        }
    }
    public function GetAvatarSession(){
       echo $iniciais = substr($_SESSION['Nome'], 0, 2);
    }
}
$SessionUser = new SessionUser();
?>