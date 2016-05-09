<!doctype html>
    <head>
<!--<META HTTP-EQUIV="Refresh" CONTENT="300">
-->
</head> 
    <?php
    // Appel de l'autoload -> Chargement automatique des class
    require 'class/Autoloader.php';
    Autoloader::register();
    $save ="json/donneesJournalieres.json";
    
    
    $Controle = new Json(0,$save);
    $Controle->controleFichierJson("jour");
    
    $jsonDate = new Json(0,$save);
    $jsonDate->envoiJson("Date");

    $jsonPression = new Json(0,$save);
    $jsonPression->envoiJson("pression");

    $jsonLuminosite = new Json(0,$save);
    $jsonLuminosite->envoiJson("luminosite");

    $jsonHumidite = new Json(0,$save);
    $jsonHumidite->envoiJson("humidite");

    $jsonPhotoresistance = new Json(0,$save);
    $jsonPhotoresistance->envoiJson("photoresistance");

    $jsonDetectionEau = new Json(0,$save);
    $jsonDetectionEau->envoiJson("detectionEau");

    $jsonMesureBruit = new Json(0,$save);
    $jsonMesureBruit->envoiJson("mesureBruit");

    $jsonTemperatureExterieure = new Json(0,$save);
    $jsonTemperatureExterieure->envoiJson("temperatureExterieure");

    $jsonTemperatureInterieure = new Json(0,$save);
    $jsonTemperatureInterieure->envoiJson("temperatureInterieure");
    

    
?>