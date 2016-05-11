<?php
    session_start();
    require 'class/Autoloader.php';
    Autoloader::register();

    if(!isset($_SESSION['validUser'])){
        $form = new Form();
        echo "</br></br>Identifiant :".$form->input("id","text");
        echo "Mot de passe :".$form->input("pass","password");
        echo $form->submit();
    }
    else{
        include 'main.php';
    }