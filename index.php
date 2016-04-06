<?php
    // Appel de l'autoload -> Chargement automatique des class
    require 'class/Autoloader.php';
    Autoloader::register();
?>

<!doctype html>
<head>
    <title> Station Météo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Include des librairies JS highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript" src="js/charts.js"></script>
 
    <script type="text/javascript">
        afficheJson();

        $( document ).ready(function() {
            initGrapheJauge('#humidite','Taux d\'humidité',' %HR',0,100,0,50,'#55BF3B',50,75,'#DDDF0D',75,100,'#DF5353',0);
            initGrapheJauge('#pluie','Capteur de pluie',' SU',0,1000,0,500,'#DF5353',500,700,'#DDDF0D',700,1000,'#55BF3B',0);
            initGrapheJauge('#pression','Baromètre','Hpa',900,1100,900,975,'#DF5353',975,1000,'#DDDF0D',1000,1100,"#55BF3B",900);
            initGrapheJauge('#temperatureInterieure','Température Intérieure','°C',-20,45,-20,0,'#0066ff',0,25,'#55BF3B',25,45,"#DF5353",-20);
           

            setInterval(function() {
                importJSON('#humidite','humidite');
                importJSON('#pluie','detectionEau');
                importJSON('#pression','pression');
                importJSON('#temperatureInterieure','temperatureInterieure');
             
            }, 2500);
        });
    </script>	
</head>

<body>
    <!-- Affichage du fichier json -->
    <button id="lecture">Lancer la lecture</button>
    <div id="zone"></div>
    
    

    <!-- Affichage de la jauge -->
    
    <div id="humidite" style="float:left;min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto;"></div> 
    <div id="pluie" style="float:left;min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div> 
     <div id="pression" style="float:left;min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div> 
     <div id="temperatureInterieure" style="float:left;min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div> 
      

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
        $temperature =  new CapteurTemperatureExterieure;
        $temperature =  $temperature->getDonnee();
        echo $T.$temperature[0];

        $temperature2 = new CapteurTemperatureInterieure;
        $temperature2 = $temperature2->getDonnee();
        echo $T2.$temperature2[0];

        $pression = new CapteurPression;
        $pression = $pression->getDonnee();
        echo $P.$pression[0];

        $eau = new CapteurDetectionEau;
        $eau = $eau->getDonnee();
        echo $E.$eau[0];

        $humidite = new CapteurHumidite;
        $humidite = $humidite->getDonnee();
        echo $H.$humidite[0];

        $luminosite = new CapteurLuminosite;
        $luminosite =  $luminosite->getDonnee();
        echo $L.$luminosite[0];

        $bruit= new CapteurMesureBruit;
        $bruit = $bruit->getDonnee();
        echo $B.$bruit[0];

        $resistance = new CapteurLuminosite;
        $resistance = $resistance->getDonnee();
        echo $La.$resistance[0];

        $newDate = date("d/m/Y H:i:s", strtotime($luminosite[1]));
        echo $D.$newDate;
        /*
        // Affiche l'image satellite
        echo "</br></br>".Sat24::Date();

        // Affiche la phase lunaire
        echo Sat24::afficheLune();
        */
        
        
        
        


    ?>
</body>