<?php

$verifForm = new Login();
echo $Verif =  $verifForm->verifChamps("id","pass");
if($Verif == true){
    $_SESSION['validUser'] = 1;
}