<?php
    /**
     *Classe gérant toutes les requetes json
     */
    class Json {        
        public $tailleMaxTableau;
        public $fichierEnregistrement;
        private $envoiCommandes = "envoiCommandes";
       
        /**
         * @param type $tailleMaxTableau taille maximale du tableau dans le fichier json
         * @param type $fichierEnregistrement fichier ou est enregistré le fichier json
         */
        public function __construct($tailleMaxTableau,$fichierEnregistrement){
            $this->tailleMaxTableau = $tailleMaxTableau;
            $this->fichierEnregistrement = $fichierEnregistrement;
        }
        
        /**
         * Fonction de sauvegarde des 24 dernières heures de données météo dans un fichier json
         */
        public function save24h(){
            $fichierEnregistrement = $this->fichierEnregistrement;
            $json = file_get_contents($fichierEnregistrement);
            $json = json_decode($json);
            $bdd = new BaseDonnees();
            $donnees = $bdd->recup24h();
            
            $json->Date = $donnees[0];
            $json->pression = $donnees[1];
            $json->luminosite = $donnees[2];
            $json->humidite = $donnees[3];
            $json->detectionEau = $donnees[4];
            $json->mesureBruit = $donnees[5];
            $json->temperatureExterieure = $donnees[6];
            $json->temperatureInterieure = $donnees[7];
            
           
            $json = json_encode($json, JSON_PRETTY_PRINT);
            
            $addJson = fopen($this->fichierEnregistrement,'r+')
            or die("Erreur d'ouverture du fichier Json");
            ftruncate($addJson,0);
            //Ecriture du nouveau Json
            fputs($addJson,$json);

        }
        
        /**
         * fonction d'envoi de commande pour le python (ouverture du json, changement du statut d'une action de 0 à 1
         * @param type $parametre type de commande a envoyer 
         */
        public function envoiCommande($parametre){
            $fichierEnregistrement = $this->fichierEnregistrement;
            $json = file_get_contents($fichierEnregistrement);
            $json = json_decode($json);
            $json->envoiCommandes->$parametre = 1;
            $json = json_encode($json, JSON_PRETTY_PRINT);
            // Ouverture du fichier Json
            $addJson = fopen($this->fichierEnregistrement,'r+')
            or die("Erreur d'ouverture du fichier Json");
            ftruncate($addJson,0);
            //Ecriture du nouveau Json
            fputs($addJson,$json);
        }
        
        
        /**
         * Enregistre dans un fichier json les dernieres entrées de bdd
         * @param String $parametre nom de la colonne en bdd que l'on veux sauver en json
         */
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
            if($parametre != "Date"){
                settype($nouvelleDonnee,'float');
            }
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
            $json = json_encode($json, JSON_PRETTY_PRINT);
        
             // Compteur de taille des données
            $compteur = count($tableauValeur);
            
            // Ouverture du fichier Json
            $addJson = fopen($this->fichierEnregistrement,'r+')
            or die("Erreur d'ouverture du fichier Json");
            //Ecriture du nouveau Json
            fputs($addJson,$json); 
        }
        
        /**
         * Vérifie en fonction du paramètre entré (jour, mois, annee...) si les dates sont les mêmes. Si ce n'est pas le cas, le contenu du fichier json est supprimé.
         * @param String $typeDate
         */
        public function controleFichierJson($typeDate){
            $fichierEnregistrement = $this->fichierEnregistrement;
            $recupDate = new BaseDonnees; 
            $date = $recupDate->recupDate($typeDate);
            // Si les dates sont différentes les unes des autres, on efface le contenu du fichier Json
            if($date[0] != $date[1]){
                $suppressionContenu = fopen($fichierEnregistrement,"w");
                ftruncate($suppressionContenu,0);
                fclose($suppressionContenu);
                echo "fichier supprimé";
            }
        }
        
    }
