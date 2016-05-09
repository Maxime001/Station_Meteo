<?php
   
    

    class CapteurTemperatureExterieure extends Capteur {
        // Nom de la colonne ou est stockée la température
        public function __construct(){ 
            $this->colonneBDD = "temperatureExterieure";
        }
        
       
        
    }