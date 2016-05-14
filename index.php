<?php
    if($_SERVER['REQUEST_URI'] == '/index.php') header('Location:/');
    session_start();
    require 'class/Autoloader.php';
    Autoloader::register();  
    

  //  $ip = new BloquageIp();
  //  $res = $ip->verifBloque();
    
 //   if($res == true){
  //      include '404.php';
  //  }
  //  else{    
        if(!isset($_SESSION['validUser'])){
            include 'verif.php';
        }

        if(!isset($_SESSION['validUser'])){
            include 'login.php';
        }

        elseif(isset($_SESSION['validUser'])){
            include 'main.php';
        }
   // }
/*
$test = new envoiSms();
$test->sms("coucou");*/