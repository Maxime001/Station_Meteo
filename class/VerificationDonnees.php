<?php

class VerificationDonnees{
    public function verifDate($array){
        // Tableau de date en timestamp
        $timeStampArray = array();
        for($i=0;$i<count($array[0]); $i++){
            $timeStamp = strtotime($array[0][$i]);
            array_push($timeStampArray, $timeStamp);
        }
                // Si il manque des valeurs, on les rajoutes
        for($i=0;$i<count($timeStampArray)-1;$i++){
            $deltaT = $timeStampArray[$i+1] - $timeStampArray[$i];
            if($deltaT != 300){
              

                array_splice($timeStampArray,$i+1,0,$timeStampArray[$i]+300);
                for($j=1;$j<=7;$j++){
                    array_splice($array[$j],$i+1,0,"Missing");
                }
                $ajout = date('Y-m-d H:i:s',$timeStampArray[$i]+300);
                array_splice($array[0],$i+1,0,$ajout);
            }
            
        }
       // var_dump($array[0][5]);
        $timeStampArray = $array[0];
        return $array;
    }
    
    public function verifHeure($array){
        // Tableau de date en timestamp
        $timeStampArray = array();
        for($i=0;$i<count($array[0]); $i++){
            $timeStamp = strtotime($array[0][$i]);
            array_push($timeStampArray, $timeStamp);
        }
                // Si il manque des valeurs, on les rajoutes
        for($i=0;$i<count($timeStampArray)-1;$i++){
            $deltaT = $timeStampArray[$i+1] - $timeStampArray[$i];
            if($deltaT != 3600){
              

                array_splice($timeStampArray,$i+1,0,$timeStampArray[$i]+3600);
            
                    array_splice($array[1],$i+1,0,"Missing");
                
                $ajout = date('Y-m-d h:i:s',$timeStampArray[$i]+3600);
                array_splice($array[0],$i+1,0,$ajout);
            }
            
        }
       // var_dump($array[0][5]);
        $timeStampArray = $array[0];
        return $array;
    }
}