<?php
    if($_SERVER['REQUEST_URI'] == '/index.php') header('Location:/');
    session_start();
    require 'class/Autoloader.php';
    Autoloader::register();  
    

    $ip = new BaseDonnees();
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
        // LOGGE
        if(isset($_SESSION['validUser']) && isset($_GET['p'])){
            if($_GET['p'] == "HistoriqueMeteo"){
            include 'HistoriqueMeteo.php';
            }
            elseif($_GET['p'] == "parametres"){
                include 'parametre.php';
            }
            elseif($_GET['p'] == "console"){
                include 'console.php';
            }
        }
        // Affichage de la page main 
        elseif(isset($_SESSION['validUser'])){
            include 'main.php';
        }
    }