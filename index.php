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
</head>

<body>



<!-- Affichage des jauges temps réel  -->
<div id="humidite"></div>
<div id="pluie"></div>
<div id="pression"></div>
<div id="temperatureInterieure"></div>
<div id="luminosite"></div>

 Affichage des graphiques journaliers 
 <div id="grapheHumidite" ></div></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<div id="grapheTemperatureExterieure" ></div>
<div id="grapheDetectionEau"></div>
<div id="grapheLuminosite"></div>

<?php

    $T = "</br> Température exterieure(°C) : ";
    $T2 = "</br> Temperature interieure (°C) : ";
    $P = "</br> Pression(HPa) : ";
    $E = "</br> Detection eau : ";
    $H = "</br> Humidite(%) : ";
    $L = "</br> Luminosité : ";
    $B = "</br> Mesure du bruit : ";
    $La = "</br> Mesure de la photoresistance du laser : ";
    $D = "</br> </br> Date de la dernière mesure : ";
    // Affiche les 7 Capteurs
    $temperature = new CapteurTemperatureExterieure;
    $temperature = $temperature->getDonnee();
    echo $T . $temperature[0];

    $temperature2 = new CapteurTemperatureInterieure;
    $temperature2 = $temperature2->getDonnee();
    echo $T2 . $temperature2[0];

    $pression = new CapteurPression;
    $pression = $pression->getDonnee();
    echo $P . $pression[0];

    $eau = new CapteurDetectionEau;
    $eau = $eau->getDonnee();
    echo $E . $eau[0];

    $humidite = new CapteurHumidite;
    $humidite = $humidite->getDonnee();
    echo $H . $humidite[0];

    $luminosite = new CapteurLuminosite;
    $luminosite = $luminosite->getDonnee();
    echo $L . $luminosite[0];

    $bruit = new CapteurMesureBruit;
    $bruit = $bruit->getDonnee();
    echo $B . $bruit[0];

    $resistance = new CapteurLuminosite;
    $resistance = $resistance->getDonnee();
    echo $La . $resistance[0];

    $newDate = date("d/m/Y H:i:s", strtotime($luminosite[1]));
    //  echo $D.$newDate;
    /*
    // Affiche l'image satellite
    echo "</br></br>".Sat24::Date();

    // Affiche la phase lunaire
    echo Sat24::afficheLune();
    */
?>
</body>