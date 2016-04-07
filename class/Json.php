<?php
    class Json {        
        public $tailleMaxTableau;
        public $fichierEnregistrement;
       
        public function __construct($tailleMaxTableau,$fichierEnregistrement){
            $this->tailleMaxTableau = $tailleMaxTableau;
            $this->fichierEnregistrement = $fichierEnregistrement;
        }
              
        public function envoiJson($parametre){
            $tailleMaxTableau = $this->tailleMaxTableau;
            $fichierEnregistrement = $this->fichierEnregistrement;
 
            // Lecture du fichier Json
            $json = file_get_contents($fichierEnregistrement);
            $json = json_decode($json);
            
            // Si le fichier de données est supprimé, on reprends init.json pour le réinitialiser
          
            if ($json == ""){
                $source="json/init.json";
                $dest=$this->fichierEnregistrement;
                copy($source, $dest);
                
                $json = file_get_contents($this->fichierEnregistrement);
                $json = json_decode($json);
            }
                
            // Lecture & enregistrement du tableau ou va être ajouté une valeur
            $tableauValeur = $json->$parametre; 

            // Récupération de la dernière valeur entrée en BDD
            $recupBdd = new BaseDonnees;
            $nouvelleDonnee = $recupBdd->recupDonneeUnique($parametre);
            settype($nouvelleDonnee,'float');
            $longueurTableau = count($tableauValeur);
            if($this->tailleMaxTableau != 0){
                while($longueurTableau > $tailleMaxTableau){
                    array_shift($tableauValeur);
                    $longueurTableau = count($tableauValeur);
                }
            }
            
            // Ajout de la dernière valeur au tableau
            array_push($tableauValeur,$nouvelleDonnee);

           // Mise a jour de la variable contenant tout le fichier json
            $json->$parametre = $tableauValeur;
            // Reencodage du fichier json
            $json = json_encode($json);
        
             // Compteur de taille des données
            $compteur = count($tableauValeur);
            
            // Ouverture du fichier Json
            $addJson = fopen($this->fichierEnregistrement,'r+')
            or die("Erreur d'ouverture du fichier Json");
            //Ecriture du nouveau Json
            fputs($addJson,$json); 
        }
    }
