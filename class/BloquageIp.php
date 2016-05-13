<?php

class BloquageIp{
    
    function verifBloque(){
        $bdd = new BaseDonnees();
        $result = $bdd->receptionDonnee($_SERVER['REMOTE_ADDR']);
        return $result;
    }
   
}