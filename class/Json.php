<?php
    class Json {        
        public $tailleMaxTableau;
        public $fichierEnregistrement;
       
        /**
         * @param type $tailleMaxTableau taille maximale du tableau dans le fichier json
         * @param type $fichierEnregistrement fichier ou est enregistré le fichier json
         */
        public function __construct($tailleMaxTableau,$fichierEnregistrement){
            $this->tailleMaxTableau = $tailleMaxTableau;
            $this->fichierEnregistrement = $fichierEnregistrement;
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
            $json = json_encode($json);
        
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
