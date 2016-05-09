<?php

class BaseDonnees {
    private $bdd="";
    
    /**
     * Connection a la base de donnée
     */
    public function __construct(){
        try{ $this->bdd = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8', 'root', ''); }
        catch(Exception $e){die('Erreur : '.$e->getMessage());}
    }
    
    /**
     * Requete SQL qui retourne un tableau des dernieres Données et Temps
     * @param string $donnee
     * @return array
     */
    public function recupDonnees($donnee){
       $array = array();
       $reponse = $this->bdd->query('SELECT '.$donnee.',Date FROM infometeo ORDER BY ID desc LIMIT 1');
        if ($donnees = $reponse->fetch()){
            array_push($array, $donnees[$donnee], $donnees['Date']);
            return $array;
        }
    }
    
    /**
     * Retourne la valeur de la dernière donnée entrée en bdd
     * @param string $donnee
     * @return string  
     */
    public function recupDonneeUnique($donnee){
       $array = array();
       $reponse = $this->bdd->query('SELECT '.$donnee.' FROM infometeo ORDER BY ID desc LIMIT 1');
        if ($donnees = $reponse->fetch()){
             return $donnees[$donnee];
        }
    }
    
    /**
     * Retourne la valeur de la dernière date (annee,mois,jour...) entrée en bdd
     * @param string $parametre quel parametre de la date (jour,mois,annee,heure..)  ?  
     * @return int
     */
    public function recupDate($parametre){
        $reponse = $this->bdd->query('SELECT Date, DAY(date) AS jour, MONTH(date) AS mois, YEAR(date) AS annee, HOUR(date) AS heure, MINUTE(date) AS minute, SECOND(date) AS seconde FROM infometeo ORDER BY ID desc LIMIT 2');
        $array = array();
        while($donnees =$reponse->fetch()){ 
           array_push($array,$donnees[$parametre]);
        }
         return $array;
    }
}