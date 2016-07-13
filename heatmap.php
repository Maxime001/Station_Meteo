<!-- Page paramètres -->
<!doctype html>
<html>
    <head>
        <title>HeatMap</title>
        <meta name="robots" content="noindex">
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=2.0, user-scalable=no" />
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
        <!-- JS des heatmap -->
        <script src="js/heatmap.js"></script>
        <script src="js/main_heatmap.js"></script>
        <script src="js/libs/highcharts/highcharts2.js"></script>
        <script src="js/libs/highcharts/data.js"></script>
        <script src="js/libs/highcharts/heatmap.js"></script>
        <script src="js/libs/highcharts/exporting.js"></script>
</head>
    <?php
        include "menu.php";
    ?>
    <body class="main">
        <div class="centerPage" >
            <div style="height:800px;" class="fond affichageGraphiques2">
                <div class= "mainTitle" >HeatMap</div> 

                   <div id="container" style="margin:5px;height:757px;"></div>
            </div>
         
        </div>
        
     
<!-- Donnees -->  
<pre id="csv" style="display:none;">Date,Time,Temperature 
<?php
     $saveJson = new Json(0, 'json/heatmap.json');
     $donnees = $saveJson->saveTemperaturesJson();

     for($i=0;$i<count($donnees);$i++){
        echo nl2br($donnees[$i])."\n";
     }
?> 
</pre>
   
    </body>
</html>