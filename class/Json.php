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
            
            for($j=1;$j<=7;$j++){
                for($i=0;$i<=count($donnees[0])-1;$i++){
                    if(is_string($donnees[$j][$i])){
                        $donnees[$j][$i] = null;
                        
                    } 
                    
                }
            }

            $json->donnees->Date = $donnees[0];
            $json->donnees->pression = $donnees[1];
            $json->donnees->luminosite = $donnees[2];
            $json->donnees->humidite = $donnees[3];
            $json->donnees->detectionEau = $donnees[4];
            $json->donnees->mesureBruit = $donnees[5];
            $json->donnees->temperatureExterieure = $donnees[6];
            $json->donnees->temperatureInterieure = $donnees[7];
            
            $pressionMin = min($donnees[1]);
            $pressionMax = max($donnees[1]);
            $luminositeMin = min($donnees[2]);
            $luminositeMax = max($donnees[2]);
            $humiditeMin = min($donnees[3]);
            $humiditeMax = max($donnees[3]);
            $detectionEauMin = min($donnees[4]);
            $detectionEauMax = max($donnees[4]);
            $mesureBruitMin = min($donnees[5]);
            $mesureBruitMax = max($donnees[5]);            
            $temperatureExterieureMin = min($donnees[6]);
            $temperatureExterieureMax = max($donnees[6]);
            $temperatureInterieureMin = min($donnees[7]);
            $temperatureInterieureMax = max($donnees[7]);
            
            $json->minMax->pressionMin = $pressionMin;
            $json->minMax->pressionMax = $pressionMax;
            $json->minMax->luminositeMin = $luminositeMin;
            $json->minMax->luminositeMax = $luminositeMax;
            $json->minMax->humiditeMin = $humiditeMin;
            $json->minMax->humiditeMax = $humiditeMax;
            $json->minMax->detectionEauMin = $detectionEauMin;
            $json->minMax->detectionEauMax = $detectionEauMax;
            $json->minMax-> mesureBruitMin = $mesureBruitMin;
            $json->minMax->mesureBruitMax = $mesureBruitMax;
            $json->minMax->temperatureExterieureMin = $temperatureExterieureMin;
            $json->minMax->temperatureExterieureMax = $temperatureExterieureMax;
            $json->minMax->temperatureInterieureMin = $temperatureInterieureMin;
            $json->minMax->temperatureInterieureMax = $temperatureInterieureMax;
                    
            $json = json_encode($json, JSON_PRETTY_PRINT);
            
            $addJson = fopen($this->fichierEnregistrement,'r+')
            or die("Erreur d'ouverture du fichier Json");
            ftruncate($addJson,0);
            //Ecriture du nouveau Json
            fputs($addJson,$json);
        }
        
        public function saveAll(){
            $fichierEnregistrement = $this->fichierEnregistrement;
            $json = file_get_contents($fichierEnregistrement);
            $json = json_decode($json);
            $bdd = new BaseDonnees();
            $donnees = $bdd->recupAll();
            

        
            for($j=1;$j<=7;$j++){
                for($i=0;$i<=count($donnees[0])-1;$i++){
                    if(is_string($donnees[$j][$i])){
                        $donnees[$j][$i] = null;
                        
                    } 
                    
                }
            }
            $pression = array();
            $humidite = array();
            $luminosite = array();
            $detectionEau = array();
            $mesureBruit = array();
            $temperatureExterieure = array();
            $temperatureInterieure = array();
            
  
            for($t=0;$t<count($donnees[0]);$t++){
                
                $pression[$t][0] = $donnees[0][$t];
                $pression[$t][1] = $donnees[1][$t];
                
                $luminosite[$t][0] = $donnees[0][$t];
                $luminosite[$t][1] = $donnees[2][$t];
                
                $humidite[$t][0] = $donnees[0][$t];
                $humidite[$t][1] = $donnees[3][$t];
                
                $detectionEau[$t][0] = $donnees[0][$t];
                $detectionEau[$t][1] = $donnees[4][$t];
                
                $mesureBruit[$t][0] = $donnees[0][$t];
                $mesureBruit[$t][1] = $donnees[5][$t];
                
                $temperatureExterieure[$t][0] = $donnees[0][$t];
                $temperatureExterieure[$t][1] = $donnees[6][$t];
                
                $temperatureInterieure[$t][0] = $donnees[0][$t];
                $temperatureInterieure[$t][1] = $donnees[7][$t];
                
                
            }
            

     
                $json->pression = $pression;
                $json->luminosite = $luminosite;
                $json->humidite = $humidite;
                $json->detectionEau = $detectionEau;
                $json->mesureBruit = $mesureBruit;
                $json->temperatureInterieure = $temperatureInterieure;
                $json->temperatureExterieure = $temperatureExterieure;
            

            
            
            $json = json_encode($json);
           
            
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
        
        public function verifStatut($parametre){
            $fichierEnregistrement = $this->fichierEnregistrement;
            $json = file_get_contents($fichierEnregistrement);
            $json = json_decode($json);
            $json = $json->position->$parametre;
            if($json == "activee" || $json == "ouvert" || $json== "on"){
                return "checked";
            }
        }
        
    }
