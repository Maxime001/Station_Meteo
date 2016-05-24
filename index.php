<?php
    if($_SERVER['REQUEST_URI'] == '/index.php') header('Location:/');
    session_start();
    require 'class/Autoloader.php';
    Autoloader::register();  
    

    $ip = new BloquageIp();
    $res = $ip->verifBloque();
    
    // Adresse IP bloquée 
    if($res == true){
        include '404.php';
    }
    else{ 
        // Vérification du login si il est déjà rentré
        if(!isset($_SESSION['validUser'])){
            include 'verif.php';
        }
        // Affichage de la page de log
        if(!isset($_SESSION['validUser'])){
            include 'login.php';
        }
        if(isset($_GET['p']) && $_GET['p'] == "HistoriqueMeteo" ){
            include 'HistoriqueMeteo.php';
        }
        // Affichage de la page main 
        elseif(isset($_SESSION['validUser'])){
            include 'main.php';
        }
        
    }
/*
$test = new envoiSms();
$test->sms("Quelqu'un est sur la page de login");

 */