<?php

$verifForm = new Login();
echo $Verif =  $verifForm->verifChamps("id","pass");

if($Verif == "OK"){
    $_SESSION['validUser'] = 1;
}
