<!doctype html>
    <head>
<META HTTP-EQUIV="Refresh" CONTENT="1">

</head> 
    <?php
    // Appel de l'autoload -> Chargement automatique des class
    require 'class/Autoloader.php';
    Autoloader::register();
    $save ="json/donneesInstantanee.json";
    
    $jsonDate = new Json(1,$save);
    $jsonDate->envoiJson("Date");

    $jsonPression = new Json(1,$save);
    $jsonPression->envoiJson("pression");

    $jsonLuminosite = new Json(1,$save);
    $jsonLuminosite->envoiJson("luminosite");

    $jsonHumidite = new Json(1,$save);
    $jsonHumidite->envoiJson("humidite");

    $jsonPhotoresistance = new Json(1,$save);
    $jsonPhotoresistance->envoiJson("photoresistance");

    $jsonDetectionEau = new Json(1,$save);
    $jsonDetectionEau->envoiJson("detectionEau");

    $jsonMesureBruit = new Json(1,$save);
    $jsonMesureBruit->envoiJson("mesureBruit");

    $jsonTemperatureExterieure = new Json(1,$save);
    $jsonTemperatureExterieure->envoiJson("temperatureExterieure");

    $jsonTemperatureInterieure = new Json(1,$save);
    $jsonTemperatureInterieure->envoiJson("temperatureInterieure");
?>