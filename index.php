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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Highcharts -->
    <script src="js/libs/highcharts.js"></script>
    <script src="js/libs/highcharts-more.js"></script>
    <script src="js/libs/exporting.js"></script>

    <!-- Fonctions graphiques et JSON -->
    <script type="text/javascript" src="js/graphiqueJauge.js"></script>
     <script type="text/javascript" src="js/graphiqueSolidJauge.js"></script>
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
        <div class="jauge col-xs-2" id="humidite"></div>
        <div class="jauge col-xs-2" id="pluie"></div>
        <div class="jauge col-xs-2" id="pression"></div>
       
        <div class="jauge col-xs-2" id="luminosite"></div>
        
    
    </div>
</div>



<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<div style="width: 600px; height: 400px; margin: 0 auto">
     <div class="jauge col-xs-2" id="temperatureExterieure"></div>
    <div id="deltaTemperature" style="width: 300px; height: 200px; float: left"></div>
</div>

<!--col-xs-4 col-sm-3 col-md-2-->
 Affichage des graphiques journaliers
 <div class="graphique" id="grapheHumidite" ></div>
<div class="graphique" id="grapheTemperatureExterieure" ></div>
<div class="graphique" id="grapheDetectionEau"></div>
<div class="graphique" id="grapheLuminosite"></div>


</body>

<?php
