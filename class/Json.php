<?php
    class Json {
        public function envoiJson($parametre){
              $tailleMaxTableau = 10;
            // Lecture du fichier Json
            $json = file_get_contents("donnees.json");
            $json = json_decode($json);
            
            // Si le fichier de données est supprimé, on reprends init.json pour le réinitialiser
          
            if ($json == ""){
                $source="init.json";
                $dest="donnees.json";
                copy($source, $dest);
                
                $json = file_get_contents("donnees.json");
                $json = json_decode($json);
            }
            
            
            
            // Lecture & enregistrement du tableau ou va être ajouté une valeur
            $tableauValeur = $json->$parametre; 

            // Récupération de la dernière valeur entrée en BDD
            $recupBdd = new BaseDonnees;
            $nouvelleDonnee = $recupBdd->recupDonneeUnique($parametre);
            
            $longueurTableau = count($tableauValeur);
           
            while($longueurTableau > $tailleMaxTableau){
                array_shift($tableauValeur);
                $longueurTableau = count($tableauValeur);
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
            $addJson = fopen("donnees.json",'r+')
            or die("Erreur d'ouverture du fichier Json");
            //Ecriture du nouveau Json
            fputs($addJson,$json); 
        }
            
            
    }

?>