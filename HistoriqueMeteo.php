<!-- Page historique meteo -->
<!doctype html>
<html>
    <head>
        <title> Station Météo</title>
        <meta name="robots" content="noindex">
        <meta charset="UTF-8" />
         <link rel="icon" type="image/png" href="img/favicon.png" />
        <meta name="viewport" content="initial-scale=2.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="../favicon.ico">
        <!-- CSS du template -->
        <link rel="stylesheet" type="text/css" href="css/template/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/template/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/template/css/component.css" />
        <!-- JS du template -->
        <!--<script src="js/modernizr.custom.js"></script>     -->
        <!-- Jquery -->
        <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
        <script src="js/libs/jquery-ui.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/googleButton.css">
        <link rel="stylesheet" type="text/css" href="css/contenu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
        <link rel="stylesheet" type="text/css" href="css/libs/style.css">
        
        <script src="js/libs/highcharts.js"></script>
        <script src="js/libs/highcharts-more.js"></script>
        <script src="js/libs/exporting.js"></script>
        <script src="js/main_HistoriqueMeteo.js"></script>
    </head>
    <?php
        include "menu.php";
    ?>
    <body class="main">
        <div class="centerPage">
            <div class="fond affichageGraphiques2">
                
                <div class= "mainTitle">Historique Météo - Humidité</div>
                <div id="Humidite2" class="carreMain4" ><img class="loading_historiqueMeteo" src="img/load.gif"/></div></br>
                <div class= "mainTitle">Historique Météo - Pression</div>
                <div id="Pression2" class="carreMain4"><img class="loading_historiqueMeteo" src="img/load.gif"/></div></br>
                <div class= "mainTitle">Historique Météo - Luminosité</div>
                <div id="luminosite2" class="carreMain4"><img class="loading_historiqueMeteo" src="img/load.gif"/></div></br>
                <div class= "mainTitle">Historique Météo - Détection Eau</div>
                <div id="detectionEau2" class="carreMain4"><img class="loading_historiqueMeteo" src="img/load.gif"/></div></br>
            
                <div class= "mainTitle">Historique Météo - Température Intérieure</div>
                <div id="temperatureInterieure2" class="carreMain4"><img class="loading_historiqueMeteo" src="img/load.gif"/></div></br>
                <div class= "mainTitle">Historique Météo - Température Exterieure</div>
                <div id="temperatureExterieure2" class="carreMain4"><img class="loading_historiqueMeteo" src="img/load.gif"/></div>
            </div>
        </div>
        <?php
            $test = new Json(0,'json/meteo.json');
            $test->saveAll();
        ?>
    </body>
</html>
