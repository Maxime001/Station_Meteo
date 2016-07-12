<?php

class CameraIp{
    public function getImage($port,$lien){
       include("config.php");
       if($_SERVER['SERVER_NAME'] == "localhost"){ 
            $url = "http://$ipLog:$ipPass@$adress:$port/image.jpg";
       }
       else{
            $url = "http://$ipLog:$ipPass@$localAdress.$port/image.jpg";  
       }
        $fichier = $lien;
        $ch = curl_init($url);
        $fp = fopen($fichier, 'wb');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
   }
   
   
    public function streamingIp($port,$lien){
        include("config.php");
        if($_SERVER['SERVER_NAME'] == "localhost"){ 
            $url = "http://$ipLog:$ipPass@$adress:$port/video/mjpg.cgi?profileid=1";
        }
        else{
            $url = "http://$ipLog:$ipPass@$localAdress.$port/video/mjpg.cgi?profileid=1";  
        }
        
        return $url;
    }
}
