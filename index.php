<?php
// Appel de l'autoload -> Chargement automatique des class
require 'class/Autoloader.php';
Autoloader::register();
?>

<!doctype html>
<head>
    <title> Station Météo</title>
    
    <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    

    <!-- Highcharts -->
    <script src="js/libs/highcharts.js"></script>
    <script src="js/libs/highcharts-more.js"></script>
    <script src="js/libs/exporting.js"></script>

    <!-- Fonctions graphiques et JSON -->
    <script type="text/javascript" src="js/graphiqueJauge.js"></script>
    <script type="text/javascript" src="js/graphiqueCourbe.js"></script>
    <script type="text/javascript" src="js/graphiqueStyles.js"></script>
    <script type="text/javascript" src="js/jsonHandler.js"></script>
    
    <script type="text/javascript" src="js/graphiqueOptions"></script>
    <script type="text/javascript" src="js/main.js"></script>
    
    <script type="text/javascript" src="js/progressBarr.js"></script>
    
    <script type="text/javascript" src="js/ajax.js"></script>
</head>

<body>



<!-- Affichage des jauges temps réel  -->
<div class="container">
    <div class="row">
        <div class="jauge col-lg2" id="humidite"></div>
        <div class="jauge col-lg2" id="pluie"></div>
        <div class="jauge col-lg2" id="pression"></div>
        <div class="jauge col-lg2" id="temperatureExterieure"></div>
        <div class="jauge col-lg2" id="luminosite"></div>
    </div>
</div>






 <!--Affichage des graphiques journaliers
 <div class="graphique" id="grapheHumidite" ></div>
<div class="graphique" id="grapheTemperatureExterieure" ></div>
<div class="graphique" id="grapheDetectionEau"></div>
<div class="graphique" id="grapheLuminosite"></div>
--> 




<?php
// Ici  il faut un script ajax qui va get les données json et les mettre a jour 
    $save ="json/donneesInstantanee.json";
    $jsonInst = new Json(1,$save);
    $jsonInst->envoiJson("Date");
    $jsonInst->envoiJson("pression");
    $jsonInst->envoiJson("luminosite");
    $jsonInst->envoiJson("humidite");
    $jsonInst->envoiJson("photoresistance");
    $jsonInst->envoiJson("detectionEau");
    $jsonInst->envoiJson("mesureBruit");
    $jsonInst->envoiJson("temperatureExterieure");
    $jsonInst->envoiJson("temperatureInterieure");

?> 
</body>