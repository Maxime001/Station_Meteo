<?php
// Appel de l'autoload -> Chargement automatique des class
require 'class/Autoloader.php';
Autoloader::register();
?>

<!doctype html>
<head>
    <title> Station Météo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="main.css">

    <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>

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
    
    <script type="text/javascript" src="js/ajax.js"></script>
</head>

<body>



<!-- Affichage des jauges temps réel  -->

<div id="humidite"></div>
<div id="pluie"></div>
<div id="pression"></div>
<div id="temperatureExterieure"></div>
<div id="luminosite"></div>
</br></br>


 <!--Affichage des graphiques journaliers--> 
 <div id="grapheHumidite" ></div>
<div id="grapheTemperatureExterieure" ></div>
<div id="grapheDetectionEau"></div>
<div id="grapheLuminosite"></div>


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