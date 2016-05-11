<?php

class BaseDonnees extends Bdd {
    
    public function recup24h(){
        date_default_timezone_set("Europe/Paris");
        $Date = time();
        $DateJ = $Date - 86400;
        $DateMoinsUnJour =  date('Y-m-d H:i:d',$DateJ)."</br>";
        $date = array();
        $pression = array();
        $luminosite = array();
        $humidite = array();
        $detectionEau = array();
        $mesureBruit = array();
        $temperatureExterieure = array();
        $termperatureInterieure = array();
        $reponse = $this->bdd->query('SELECT * FROM infometeo WHERE Date >= "'.$DateMoinsUnJour.'"');
        while($donnees = $reponse->fetch()){
            array_push($date,$donnees["Date"]);
            array_push($pression,intval($donnees["pression"]));
            array_push($luminosite,intval($donnees["luminosite"]));
            array_push($humidite,  floatval($donnees["humidite"]));
            array_push($detectionEau,intval($donnees["detectionEau"]));
            array_push($mesureBruit,intval($donnees["mesureBruit"]));
            array_push($temperatureExterieure,floatval($donnees["temperatureExterieure"]));
            array_push($termperatureInterieure,floatval($donnees["temperatureInterieure"]));
        }
        $array = array();
        array_push($array,$date);
        array_push($array,$pression);
        array_push($array,$luminosite);
        array_push($array,$humidite);
        array_push($array,$detectionEau);
        array_push($array,$mesureBruit);
        array_push($array,$temperatureExterieure);
        array_push($array,$termperatureInterieure);

        
       return $array;
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
