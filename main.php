<?php


// Au chargement, on va faire la requete SQL qui va remplir correctement le json avec les dernieres 24h de données
$MajJson = new Json(0,"json/meteo24h.json");
$MajJson->save24h();
$statusCapteurs = new Json(0,"json/controleObservatoire.json");
/*$sms = new envoiSms();
$sms->sms("Quelqu'un est sur la page mainfeafaef");*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contrôle Observatoire</title>
          <!-- Jquery -->
          <link rel="icon" type="image/png" href="img/favicon.png" />
        <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
        <script src="js/libs/jquery-ui.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
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
        <!-- CSS de jqueryUI -->
        <link href="css/libs/jquery-ui.min.css" rel="stylesheet">
        <!-- JS du stripe -->
        <script src="js/libs/raphael-2.1.4.min.js"></script>
        <script src="js/libs/justgage.js"></script>
        <script src="js/libs/TweenMax.min.js"></script>
        <script src="js/libs/CSSPlugin.min.js"></script>
        <script src="js/utility.js"></script>
        <script src="js/UI/Stripe.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/googleButton.css">
        <link rel="stylesheet" type="text/css" href="css/contenu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- CSS du stripe -->
        <link rel="stylesheet" type="text/css" href="css/libs/style.css">
        <link rel="stylesheet" type="text/css" href="css/libs/Stripe.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <!-- Highcharts -->
        <script src="js/libs/highcharts.js"></script>
        <script src="js/libs/highcharts-more.js"></script>
        <script src="js/libs/exporting.js"></script>
        <script type="text/javascript" src="js/graphiqueJauge.js"></script>
        <script type="text/javascript" src="js/graphiqueSolidJauge.js"></script>
        <script type="text/javascript" src="js/graphiqueCourbe.js"></script>
        <script type="text/javascript" src="js/graphiqueStyles.js"></script>
        <script type="text/javascript" src="js/jsonHandler.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script src="js/libs/solid-jauge.js"></script>
        <script type="text/javascript" src="js/clock.js"></script>
    </head>
    <body class="main">
    <?php
        include "menu.php";
    ?>
        <div class="centerPage" >
                <div class="fond affichageJauges">
                    <div class= "mainTitle">Météo résumé</div>
                    </br> 
                    <div class="carreMain2" id="carreMeteoResume">
                        <img src="img/weather.png" height="35"  id="weatherImg" >
                         <b><span id="titreMeteoResume" style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px">Météo résumé</span></b><img id="statusPluieWarning" style="display:none;position:absolute;z-index:100;margin-left:250px;margin-top:-30px;" height="35" src="img/warning.png" >
                       <img class="load" id="load1" src="img/load.gif" >
                        <table><tr><td style="width:200px;text-align:left">
                            <span style="margin-left:10px;display:none; opacity: 0.8" class="texteStatus"><b>Statut précipitations  </b></span>
                        </td><td>
                            <b><span id="statusPluie" style="display:none"> </span></b>
                        </td></tr><tr><td style="text-align:left">
                            <span style="margin-left:10px;display:none; opacity: 0.8;" class="texteStatus"><b>Statut lumière </b></span>
                        </td><td>
                            <img id="statusLumiere" style="display:none;opacity:0.7" src="img/jour.png" height="50">
                        </td></tr></table>
                    </div>
                    
                     <div class= "mainTitle">Météo temps réel</div>
                      <div class="carreMain resp1" style="">
                          
                     
                    <div  class="   jauge"  id="humidite"></div>
                    <div class="  jauge" id="pluie"></div>
                    <div class="   jauge" id="luminosite"></div>
                    <div  class=" jauge" id="temperatureExterieure"></div>
                    <div  class="solidJauge  " id="deltaTemperature" ></div>
                    <b>DirectionVent :</b> <span id="girouette"></span>
                </div>
                </div>
                <div class="fond affichageCommandes" >
                    <div class= "mainTitle">Contrôle des commandes</div>
                  
                    
                    <div class="carreMain" style="width:99%;margin-top:5px">
                        <!-- Statut des capteurs -->
                        <img src="img/alive.png" style="padding-left:5px;opacity:0.6;" height="35">
                        <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px" >Statut des capteurs / Commandes auxilières</span></b>
                        </br></br>
                        <table><tr><td style="width: 165px;">
                                    <b><span style="margin-left:10px;opacity:0.8">Etat capteurs </span></b>
                                </td><td>
                        <div id="sensor_status_stripe"></div>
                        <div style="clear:both"></div>
                        <div id="sensor_status_text"></div>
                        <div style="clear:both"></div>
                                </td></tr></table>
                        </br>

                        <a href="#" class="wakeup blue">Démarrage PC Observatoire</a>
                        <a href="https://nasorion68.no-ip.org:5001" target="_blank" class="wakeup blue">Accès NAS</a>

                    </div>
                    
                    
                    <div class="carreMain" style="width:99%;margin-top:1px;height:220px;">
                        <img src="img/control.png" style="padding-left:5px;opacity:0.8;" height="30"> <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px" >Contrôle des commandes    |</span>         
                        <?php 
                            if($_SESSION['userName'] == "maxime"){
                                include "commandes.php";
                            }else{
                                echo "<div style=\"text-align:center;color:red;font-size:18px;\"></br></br>Session Invité</div>";
                            }
                        ?>
                      </div>
                        
                    
                    
                    <div class="carreMain" style="margin-left:2px;margin-right:2px;margin-top:1px;width:99%" >
                        <img height="30" style="padding-left:5px;opacity:0.6;" src="img/sat.png">
                        <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"> Contrôle du toit  </span></b></br></br>
                        <table><tr><td style="width:165px">
                            <b>Toit fermé/ouvert  </b>
                        </td><td class="td100px">
                            0/x cm
                        </td></tr><tr><td>
                            <b>Distance du toit  </b>
                        </td><td style="margin:0px;">
                            <b><span id="capteurUltrason" >-</span> cm</b>
                        </td></tr></table>
                        </br>
                       
                        <div id="progressbar" style="text-align:center"></div></br>
                            
                        <table><tr><td style="width:165px">
                            <b>Confirmation position</b>
                        </td><td class="td100px">
                            <b> <span id="confirmationPositionToit" style="display:none"></span></br></b>
                        </td></tr><tr><td>
                            <b> Mouvement </b> 
                        </td><td>
                            <span id="confirmationmouvement">Non</span>
                        </td></tr></table>
                    </div>
                    </br>
                    <div class="carreMain" style="margin-top:1px;width:99%;margin-left:3px; margin-bottom:5px;margin-right:2px;" >
                         <img height="30" style="padding-left:5px;opacity:0.6;" src="img/status.png">
                         <span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"><b>Statut actuel </b></span></br>
                         <table><tr><td style="width:165px">
                            <b>Résistance chauffante </b> 
                        </td><td>
                            Marche / Arrêt 
                        </td></tr><td>
                            <b>Température rail </b> 
                        </td><td>
                            x°C
                        </td></tr><tr><td>
                                 <b>Alarme</b> 
                        </td><td>
                            STATUS
                        </td></tr></table>
                         
                    </div>
                    
                     
                    </br>
                    <div class="mainTitle">Vue 3D</div>
                    
                     <div class="carreMain" style="margin-top:5px;width:99%;height:105px;" >
                    AccelerometreX : <b><span id="accX">-</span></b></br>
                    Accelerometre Y : <b><span id="accY">-</span></b></br>
                    Accelerometre Z : <b><span id="accZ">-</span></b></br>
                     </div>
                </div>
                

                <div class="fond affichageCameras ">
                    <div class= "mainTitle">Caméras IP</div>
                    <div id="camera">
                    <div class="carreMain3" >
                        <img src="img/camera.png" height="30" style="padding-left:5px;opacity:0.6;">
                        <span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"><b>Caméras IP</b></span><a href="#" id="streamingIp" class="wakeup blue">Streaming Video</a><a href="#" id="imageIp" class="wakeup blue">Image / Image</a></br>
                         <img id="loadCamera" src="img/load.gif">
                        <img class="cameraNord" id="cameraNord" style="display:none" src=""/></br></br>
                        <img class="cameraSud" id="cameraSud" style="display:none" src=""/>
                    </div>
                    </div>

                </div>
            <div class="fond affichageGraphiques" >
                    <div class= "mainTitle">Meteo des dernières 24h</div>
                    <div class="carreMain" id="carreMainGraphiques">
                        <div class="graphique" id="graphePression" ></div>
                        <div class="graphique" id="grapheHumidite" ></div>
                        <div class="graphique" id="grapheTemperatureExterieure" ></div>
                        <div class="graphique" id="grapheDetectionEau"></div>
                        <div class="graphique" id="grapheLuminosite"></div>
                    </div>
            </div>
        </div>    
    </div>                  
    </body>
</html>
