<!-- Page paramètres -->
<!doctype html>
<html>
    <head>
        <title>Paramètres</title>
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

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/heatmap.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){
    
    
  $('#container').highcharts({
        chart: {
            type: 'heatmap'
        },
        title: {
            text: null
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.yAxis.categories[this.point.y] + ' </b> had a value of <br><b>' + this.point.value + '</b> on <b>' + this.series.xAxis.categories[this.point.x] + '</b>';
            },
            //backgroundColor: null,
            borderWidth: 1,
            borderColor: '#000000',
            distance: 10,
            shadow: false,
            useHTML: true,
            style: {
                padding: 0,
                color: 'black'
            }
        },
        xAxis: {
            categories: ['2013-04-01', '2013-04-02', '2013-04-03'],
            labels: {
                rotation: 90
            }
        },
        yAxis: {
            title: {
                text: null
            },
            labels: {
                enabled: false
            },
            categories: ['0h', '1h', '2h', '3h', '4h', '5h', '6h', '7h', '8h', '9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h', '21h', '22h', '23h'],
            min: 0,
            max: 23,
            reversed: true
        },
        colorAxis: {
            stops: [
                [0, '#c4463a'],
                [0.1, '#c4463a'],
                [0.5, '#ffffff'],
                [1, '#3060cf']
            ],
            min: -50,
            max: 5,
            //minColor: '#FF0000',
            //maxColor: '#008000',
            startOnTick: false,
            endOnTick: false
        },
        series: [{
            borderWidth: 0,
            nullColor: '#EFEFEF',
            data: [ [0,0,-0.7],[0,1,-0.7], [1,0,-3.4], [2,0,-1.1] ]
        }]

    });
       
    });
</script>
</head>
    <?php
        include "menu.php";
    ?>
    <body class="main">
        <div class="centerPage">
            <div style="height:800px;" class="fond affichageGraphiques2">
                <div class= "mainTitle" >Statistiques Meteo</div> 
                <?php
                 $saveJson = new Json(0, 'json/heatmap.json');
                $saveJson->saveTemperaturesJson();
                ?> 
                 <!--  <div id="container" style="width:100%; height: 100%; margin: 0 auto"></div>-->
            </div>
         
        </div>
        
        
   
    </body>
</html>