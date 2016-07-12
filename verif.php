<?php
    // Vérification des champs lors du login
    $verifForm = new Login();
    $Verif =  $verifForm->verifChamps("id","pass");

    if($Verif == "OK"){
        $_SESSION['validUser'] = 1;
    }

