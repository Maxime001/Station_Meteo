<?php

class BaseDonnees {
    private $bdd="";
    
    // Connection à la BDD
    public function __construct(){
        try{ $this->bdd = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8', 'root', ''); }
        catch(Exception $e){die('Erreur : '.$e->getMessage());}
    }
    
    // Requete SQL qui retourne un tableau des dernieres Données et Temps
    public function recupDonnees($donnee){
       $array = array();
       $reponse = $this->bdd->query('SELECT '.$donnee.',Date FROM infometeo ORDER BY ID desc LIMIT 1');
        if ($donnees = $reponse->fetch()){
            array_push($array, $donnees[$donnee], $donnees['Date']);
            return $array;
        }
    }
    
    // Récupère une donnée unique
    public function recupDonneeUnique($donnee){
       $array = array();
       $reponse = $this->bdd->query('SELECT '.$donnee.' FROM infometeo ORDER BY ID desc LIMIT 1');
        if ($donnees = $reponse->fetch()){
             return $donnees[$donnee];
        }
    }
}