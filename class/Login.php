<?php

class Login{
/**
 * 
 * @param type $value
 * @return boolean
 */
    public function isSecure($value){
    	// Regex a utiliser en fonction des champs choisis
	$regex = "#^[\w-ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ\' ]*$#";
		if(preg_match($regex, $value)){
                    return true;
		}
		else{
                    return false;
		}
	}
    /**
     * 
     * @param type $id
     * @param type $pass
     * @return string
     */     
    public function verifChamps($id,$pass){

        if(!isset($_POST[$id]) || !isset($_POST[$pass])){
            return "test";            
        }
        
        $id = htmlspecialchars($_POST[$id]);
        $pass = htmlspecialchars($_POST[$pass]);
        
        if(strlen($id) <= 5 || strlen($pass) <= 5){
            return "L'identifiant et le mot de passe doivent contenir au moins 5 caractères";
        }
        else{
            $Regex = self::isSecure($id);
            $Regex2 = self::isSecure($pass);
            if($Regex == true && $Regex2 == true){
                $pass = hash('sha256', $pass);
                $verifBdd = new BaseDonnees();
                $verif = $verifBdd->verifInfo($id);

                if($pass != $verif){
                    return "mauvais mot de passe/identifiant";
                }
                else{
                    return "OK";
                }
           }
           else{
                return "erreur regex";
            }   
        }
    }
}
