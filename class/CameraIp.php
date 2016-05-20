<?php

class CameraIp{
   public function getImage($port,$lien){
       $url = "http://admin:P3gaze1992@nasorion68.no-ip.org:$port/image.jpg";
       $fichier = $lien;
$ch = curl_init($url);
$fp = fopen($fichier, 'wb');

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);
   }
}