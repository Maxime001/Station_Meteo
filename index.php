<?php
// Appel de l'autoload -> Chargement automatique des class
require 'class/Autoloader.php';
Autoloader::register();
?>

<!doctype html>
<head>
    <title> Station Météo</title>
    <!-- Jquery -->
    <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
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
    <script src="js/libs/solid-jauge.js"></script>
    <script type="text/javascript"></script>
    

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
    <div class="row">
        <div class="jauge col-xs-2" id="temperatureExterieure"></div>
        <div class="solidJauge col-xs-6" id="deltaTemperature" ></div>
                <div class="col-xs-2">
            <?php
            $Sat24 = new Sat24();
            echo $Sat24->afficheLune();
            
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <?php
            echo $Sat24->Date();
            ?>
        </div>
        <div class="col-xs-2"><h4>Interprétation :</h4></br>
            Alertes : </br>
            Humidité : 100%  : Fort risque de pluie </br>
            Pression : Baisse de 2HPa dans les 2 dernières heures ! </br>        
        </div>
    </div>
</div>

</br> 
______________________________________________________________________________________________________________________________________________________________________________________________________________________

</br></br>
    
<h1> Contrôle de l'observatoire </h1></br>
</br>


<button id="TensionTelescope">Mise sous tension télescope</button></br></br>
<button id="Resistance">Resistance chauffante</button></br></br>
<button id="Alarme">Alarme</button></br></br>
<button id="Toit">Toit</button></br></br>
</br>

<div style="height:400px;width:400px;background-color:grey">VUE 3D du télescope</div>
</br></br></br></br>______________________________________________________________________________________________________________________________________________________________________________________________________________

</br></br>
<h1>Affichage des graphiques journaliers</h1>
<?php
// Au chargement, on va faire la requete SQL qui va remplir correctement le json avec les dernieres 24h de données
$MajJson = new Json(0,"json/meteo24h.json");
$MajJson->save24h();

?>
 <div class="graphique" id="grapheHumidite" ></div>
<div class="graphique" id="grapheTemperatureExterieure" ></div>
<div class="graphique" id="grapheDetectionEau"></div>
<div class="graphique" id="grapheLuminosite"></div>

</br></br></br></br>______________________________________________________________________________________________________________________________________________________________________________________________________________

<h1> Affichage historique graphiques </h1>

</br></br>
</body>

<?php
