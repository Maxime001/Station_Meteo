<?php
// Appel de l'autoload -> Chargement automatique des class
require 'class/Autoloader.php';
Autoloader::register();
session_start();


if($_GET['requete'] == 'updateWeather'){

}

// Ajax d'envoi de commandes à l'observatoire
$envoiCommandeObservatoire = new Json(0,"json/controleObservatoire.json");



if($_GET['requete'] == 'miseAJourPhoto'){                             
    $updateImage = new CameraIp();
   
    if($_SERVER['SERVER_NAME'] == "localhost"){
        $updateImage->getImage(54,"img/cameraNord.jpg");
        $updateImage->getImage(55,"img/cameraSud.jpg"); 
    }
    else{
        $updateImage->getImage(11,"img/cameraNord.jpg");
        $updateImage->getImage(10,"img/cameraSud.jpg");     
    }
}

if($_GET['requete'] == 'streamingIp'){                             
    $updateImage = new CameraIp();
   
    $updateImage->getVideo(11,"img/cameraNord.jpg");
    $updateImage->getVideo(10,"img/cameraSud.jpg");     
}


if($_GET['requete'] == 'ouvreToit'){
    $envoiCommandeObservatoire->envoiCommande("ouvreToit");  
}

if($_GET['requete'] == 'arretToit'){
    $envoiCommandeObservatoire->envoiCommande("arretToit");  
}
if($_GET['requete'] == 'fermeToit'){
    $envoiCommandeObservatoire->envoiCommande("fermeToit"); 
}
if($_GET['requete'] == 'activeAlarme'){
    $envoiCommandeObservatoire->envoiCommande("activeAlarme");
}

if($_GET['requete'] == 'sms'){
    $sms = new envoiSms();
    $sms->sms($_GET['message']);
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
