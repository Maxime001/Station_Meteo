<?php

    /**
     * Classe principale gérant tout les capteurs de données météo
     */
    class Capteur {
       protected $colonneBDD;
        
       // Fonction qui retourne la dernière valeur en BDD du capteur appelé
        public function getDonnee(){
            $getTemperature = new BaseDonnees;
            return $getTemperature->recupDonnees($this->colonneBDD);
        }
    }