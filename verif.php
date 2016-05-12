<?php

$verifForm = new Login();
$Verif =  $verifForm->verifChamps("id","pass");
if($Verif == "OK"){
    $_SESSION['validUser'] = 1;
}

