<?php

$verifForm = new Login();
$Verif =  $verifForm->verifChamps("id","pass");
var_dump($Verif);
if($Verif == "OK"){
    $_SESSION['validUser'] = 1;
}

