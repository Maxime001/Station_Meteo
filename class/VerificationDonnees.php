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
   
                $valeursARajouter = ($deltaT/300) - 1;

                array_splice($timeStampArray,$i+1,0,$timeStampArray[$i]+300);
                for($j=1;$j<=7;$j++){
                    array_splice($array[$j],$i+1,0,"Missing");
                }
            }
        }
        return $array;
    }
}