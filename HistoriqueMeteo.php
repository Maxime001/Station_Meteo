<!doctype html>
<html>
    <head>
        <title> Station Météo</title>
        <meta name="robots" content="noindex">
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="../favicon.ico">
        <!-- CSS du template -->
        <link rel="stylesheet" type="text/css" href="css/template/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/template/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/template/css/component.css" />
        <!-- JS du template -->
        <script src="js/modernizr.custom.js"></script>     
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
<script type="text/javascript">
$(function () {
    $.getJSON('json/meteo.json', function (data) {
        AfficheGraphe("#Humidite",data.humidite);
        AfficheGraphe("#Pression",data.pression);
        AfficheGraphe("#Humidite",data.humidite);
        AfficheGraphe("#Humidite",data.humidite);
        AfficheGraphe("#Humidite",data.humidite);
        
        // Création du graphique
        function AfficheGraphe(Div,dataType){
                $(Div).highcharts('StockChart', {
                    credits: {
                        enabled: false
                     },
                    exporting: {
                        enabled: false 
                    },
                    rangeSelector : {
                        selected : 1
                    },
                    title : {
                        text : 'Historique Meteo'
                    },
                    series : [{
                            name : 'Humidité',
                            data : dataType,
                            tooltip: {
                                    valueDecimals: 1
                            }
                    }]
                });
            }
        });
});
</script>
</head>
    <?php
        include "menu.php";
    ?>
    <body class="main">
        <div class="centerPage">
            <div class="fond affichageGraphiques2">
                <div class= "mainTitle">Historique Meteo - Humidite</div>
                <div id="Humidite" style="height: 400px; min-width: 310px"></div>
                <div id="Pression" style="height: 400px; min-width: 310px"></div>
            </div>
        </div>
        <?php
        include 'class/Json.php';
        include 'class/BaseDonnees.php';
        include 'class/VerificationDonnees.php';
        $test = new Json(0,'json/meteo.json');
        $test->saveAll();
        ?>
    </body>
</html>