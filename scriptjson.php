<!doctype html>
    <head>
<META HTTP-EQUIV="Refresh" CONTENT="1";>

</head> 
    <?php
    // Appel de l'autoload -> Chargement automatique des class
    require 'class/Autoloader.php';
    Autoloader::register();
    
    $test = new Json;
    $test->envoiJson("Date");

    $test2 = new Json;
    $test2->envoiJson("pression");

    $test3 = new Json;
    $test3->envoiJson("luminosite");

    $test4 = new Json;
    $test4->envoiJson("humidite");

    $test5 = new Json;
    $test5->envoiJson("photoresistance");

    $test6 = new Json;
    $test6->envoiJson("detectionEau");

    $test7 = new Json;
    $test7->envoiJson("mesureBruit");

    $test8 = new Json;
    $test8->envoiJson("temperatureExterieure");

    $test9 = new Json;
    $test9->envoiJson("temperatureInterieure");
?>