<?php
/**
 * Classe gérant le bloquage des adresse IP 
 */
class BloquageIp{
    
    /**
     * Fonction vérifiant si une adresse IP est bloquée ou non
     * @return type  retourne NULL si l'adresse IP n'est pas bloquée / l'adresse IP si celle-ci est bloquée
     */
    function verifBloque(){
        $bdd = new BaseDonnees();
        $result = $bdd->receptionDonnee($_SERVER['REMOTE_ADDR']);
        return $result;
    }
   
}