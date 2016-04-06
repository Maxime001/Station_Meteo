<!doctype html>
    <head>
<META HTTP-EQUIV="Refresh" CONTENT="1">

</head> 
    <?php
    // Appel de l'autoload -> Chargement automatique des class
    require 'class/Autoloader.php';
    Autoloader::register();
    
    $test = new Json(10,"donnees.json");
    $test->envoiJson("Date");

    $test2 = new Json(10,"donnees.json");
    $test2->envoiJson("pression");

    $test3 = new Json(10,"donnees.json");
    $test3->envoiJson("luminosite");

    $test4 = new Json(10,"donnees.json");
    $test4->envoiJson("humidite");

    $test5 = new Json(10,"donnees.json");
    $test5->envoiJson("photoresistance");

    $test6 = new Json(10,"donnees.json");
    $test6->envoiJson("detectionEau");

    $test7 = new Json(10,"donnees.json");
    $test7->envoiJson("mesureBruit");

    $test8 = new Json(10,"donnees.json");
    $test8->envoiJson("temperatureExterieure");

    $test9 = new Json(10,"donnees.json");
    $test9->envoiJson("temperatureInterieure");
?>