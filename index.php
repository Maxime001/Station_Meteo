<?php
    if($_SERVER['REQUEST_URI'] == '/index.php') header('Location:/');
    session_start();
    require 'class/Autoloader.php';
    Autoloader::register();  
    
    include 'verif.php';

    if(!isset($_SESSION['validUser'])){
        include 'login.php';
    }

    elseif(isset($_SESSION['validUser'])){
        include 'main.php';
    }
?>
