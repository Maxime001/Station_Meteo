<?php
// Appel de l'autoload -> Chargement automatique des class
require 'class/Autoloader.php';
Autoloader::register();
session_start();


if($_GET['requete'] == 'updateWeather'){
    $save ="json/donneesInstantanee.json";
    $jsonInst = new Json(1,$save);
    $jsonInst->envoiJson("Date");
    $jsonInst->envoiJson("pression");
    $jsonInst->envoiJson("luminosite");
    $jsonInst->envoiJson("humidite");
    $jsonInst->envoiJson("photoresistance");
    $jsonInst->envoiJson("detectionEau");
    $jsonInst->envoiJson("mesureBruit");
    $jsonInst->envoiJson("temperatureExterieure");
    $jsonInst->envoiJson("temperatureInterieure");
}
