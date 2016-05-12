<?php

class login{
    public function verifChamps($id,$pass){

        if(!isset($_POST[$id]) | !isset($_POST[$pass])){
            return;            
        }
        
        $id = htmlspecialchars($_POST[$id]);
        $pass = htmlspecialchars($_POST[$pass]);
        
        if(strlen($id) <= 5 || strlen($pass) <= 5){
            return "L'identifiant et le mot de passe doivent contenir au moins 5 caractères";
        }
        else{
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
        
    }
    /*


*/
}