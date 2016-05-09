<?php
// Appel de l'autoload -> Chargement automatique des class
require 'class/Autoloader.php';
Autoloader::register();
session_start();


if($_GET['requete'] == 'updateWeather'){

}

// Ajax d'envoi de commandes à l'observatoire
$envoiCommandeObservatoire = new Json(0,"json/controleObservatoire.json");

if($_GET['requete'] == 'ouvreToit'){
    $envoiCommandeObservatoire->envoiCommande("ouvreToit");  
}
if($_GET['requete'] == 'fermeToit'){
    $envoiCommandeObservatoire->envoiCommande("fermeToit"); 
}
if($_GET['requete'] == 'activeAlarme'){
    $envoiCommandeObservatoire->envoiCommande("activeAlarme");
}

if($_GET['requete'] == 'desactiveAlarme'){
    $envoiCommandeObservatoire->envoiCommande("desactiveAlarme");
}

if($_GET['requete'] == 'resistanceChauffanteOn'){
    $envoiCommandeObservatoire->envoiCommande("resistanceChauffanteOn");
}

if($_GET['requete'] == 'resistanceChauffanteOff'){
    $envoiCommandeObservatoire->envoiCommande("resistanceChauffanteOff");
}

if($_GET['requete'] == 'tensionTelescopeOn'){
    $envoiCommandeObservatoire->envoiCommande("tensionTelescopeOn");
}

if($_GET['requete'] == 'tensionTelescopeOff'){
    $envoiCommandeObservatoire->envoiCommande("tensionTelescopeOff");
}
