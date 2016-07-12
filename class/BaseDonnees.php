<?php

/**
 * Classe Base de données contenant toutes les requetes SQL du site
 */
class BaseDonnees {

    protected $bdd="";
    
    public function __construct(){
        include("config.php");
        try{
            $this->bdd = new PDO('mysql:host='.$host.';dbname='.$dbNameMeteo.';charset=utf8', "$user", "$pass");
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
        catch(Exception $e){die('Erreur : '.$e->getMessage());}
    }
    
    /**
     * Requete SQL qui va récupérer les dernières 24h de données de la station météo
     * @return array Retourne un tableau à 2 dimensions contenant les données des 24 dernières heures.
     */
    public function recup24h(){
        date_default_timezone_set("Europe/Paris");
        $Date = time();
        $DateJ = $Date - 86400;
        $DateMoinsUnJour =  date('Y-m-d H:i:s',$DateJ);
        $date = array();
        $pression = array();
        $luminosite = array();
        $humidite = array();
        $detectionEau = array();
        $mesureBruit = array();
        $temperatureExterieure = array();
        $termperatureInterieure = array();
        $reponse = $this->bdd->query('SELECT * FROM infometeo WHERE Date >= "'.$DateMoinsUnJour.'" ORDER BY ID ASC');
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

        $verif = new VerificationDonnees();
        $array2 = $verif->verifDate($array);
        
       return $array2;
    }
    
     public function recupAll(){
        
        $date = array();
        $pression = array();
        $luminosite = array();
        $humidite = array();
        $detectionEau = array();
        $mesureBruit = array();
        $temperatureExterieure = array();
        $termperatureInterieure = array();
        $reponse = $this->bdd->query('SELECT * FROM infometeo ORDER BY ID ASC');
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

        $verif = new VerificationDonnees();
        $array2 = $verif->verifDate($array);
        
        // Conversion des dates en timestamp
        for($i=0;$i<count($array2[0]); $i++){
             date_default_timezone_set("Europe/Paris");
          
            $array2[0][$i] = strtotime($array2[0][$i]);
            
            $array2[0][$i] = $array2[0][$i] * 1000;
  
            
        }

       return $array2;
    }
    
    public function recupTemperatures(){
        
        $temperatureExterieure = array();
        $date = array();
        
        $reponse = $this->bdd->query('SELECT temperatureExterieure,Date FROM infometeo WHERE MINUTE(date) = 0 ORDER BY ID ASC');
        while($donnees = $reponse->fetch()){
            array_push($temperatureExterieure,floatval($donnees["temperatureExterieure"]));
            array_push($date,$donnees["Date"]);
        }
        $array = array();
        array_push($array,$date);
        array_push($array,$temperatureExterieure);
        

        $verif = new VerificationDonnees();
        $array2 = $verif->verifHeure($array);
        
        for($i = 0;$i<count($array2[0]);$i++){    
            $date = explode(' ',$array2[0][$i]);   
            $heure = explode(':',$date[1]);
            $virgule = ",";
            $virgule2 = ",";
            $final = $date[0] . $virgule . $heure[0] . $virgule2;
            $array2[0][$i] = $final;   
        }
       return $array2;
    }
    
    /**
     * Fonction d'identification
     * @param type $nom recherche de l'identifiant entré dans la page de login dans la base de donnée
     * @return string retourne le mot de passe encrypté en sha256
     */
    public function verifInfo($nom){
        $reponse =$this->bdd->query('SELECT password FROM user WHERE name = "'.$nom.'"');
        if($donnees = $reponse->fetch()){
            return $donnees['password'];
        }
        else{
            return "Erreur d'identification";
        }
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
    
    /*
     * Fonction d'envoi en base de donnée d'une nouvelle adresse IP (si bloquage)
     */
    public function envoiDonnee($valeur){
        $this->bdd->exec('INSERT INTO ip(ip) VALUES('.$valeur.')');
    }
    
    /*
     * Récupère l'adresse IP si elle existe de la personne qui se connecte au site
     */
    public function receptionDonnee($valeur){
        $reponse =$this->bdd->query('SELECT ip FROM ip WHERE ip = "'.$valeur.'"');
            if($donnees = $reponse->fetch()){
                return true;
            }
    }
    
    public function verifBloque(){
        $result = BaseDonnees::receptionDonnee($_SERVER['REMOTE_ADDR']);
        return $result;
    }
}
