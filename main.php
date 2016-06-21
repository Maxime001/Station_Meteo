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
        <title> Station Météo</title>
          <!-- Jquery -->
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
        <!-- JS du template -->
        <!--<script src="js/modernizr.custom.js"></script>    --> 
        <!-- JS du stripe -->
        <script src="js/libs/raphael-2.1.4.min.js"></script>
        <script src="js/libs/justgage.js"></script>
        <script src="js/libs/TweenMax.min.js"></script>
        <script src="js/libs/CSSPlugin.min.js"></script>
        <script src="js/utility.js"></script>
        <script src="js/UI/Stripe.js"></script>
       <!-- <script src="../js/main.js"></script>-->

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/googleButton.css">
        <link rel="stylesheet" type="text/css" href="css/contenu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- CSS du stripe -->
        <link rel="stylesheet" type="text/css" href="css/libs/style.css">
       <!-- <link rel="stylesheet" type="text/css" href="css/libs/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="css/libs/Stripe.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <!-- Highcharts -->
        <script src="js/libs/highcharts.js"></script>
        <script src="js/libs/highcharts-more.js"></script>
        <script src="js/libs/exporting.js"></script>
        <!-- Fonctions graphiques et JSON -->
        <script type="text/javascript" src="js/graphiqueJauge.js"></script>
        <script type="text/javascript" src="js/graphiqueSolidJauge.js"></script>
        <script type="text/javascript" src="js/graphiqueCourbe.js"></script>
        <script type="text/javascript" src="js/graphiqueStyles.js"></script>
        <script type="text/javascript" src="js/jsonHandler.js"></script>
       <!-- <script type="text/javascript" src="js/graphiqueOptions"></script>-->
        <script type="text/javascript" src="js/main.js"></script>
        <!--<script type="text/javascript" src="js/progressBarr.js"></script>-->
        <script type="text/javascript" src="js/ajax.js"></script>
        <script src="js/libs/solid-jauge.js"></script>
        <script type="text/javascript" src="js/clock.js"></script>

        <script>
            
            
        $(document).ready(function() {
            var dist=0;
            function progressbarr(){   
        $("#progressbar").progressbar({
                value: dist
            });
        }
        
     
                
      
         
        progressbarr();
        
        
        window.setTimeout(function(){
               $('#titresecondaire').fadeOut(1000);
               $('.affichageJauges').css('padding-top','-20px');
           },1000);

  
        });
    </script>
    <style>
       #progressbar {
         
	border-radius: 3px;
	background: white;
	/*border: 1px solid #AAA;*/
        height: 20px;
        padding-bottom:-1px;
	overflow: hidden;		
}
#progressbar div {
	background-image: url(img/charge.jpg); 

  margin:0;
  padding:0;
        
        
}
        </style>
    </head>
    <body class="main">
    <?php
        include "menu.php";
    ?>
        <div    class="centerPage" >
                <div  class="fond affichageJauges">
                    <div class= "mainTitle">Météo résumé</div>
                    </br>
                     
                    <div class="carreMain2" style="width:98%;margin-top:-35px;height:150px;margin-bottom:5px;">
                        <img src="img/weather.png" height="35"  style="padding-left:5px;opacity:0.8; margin-left:-230px">
                         <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px;" >Météo résumé</span></b>
                       <img class="load" src="img/load.gif" style="text-align:center;opacity:0.6;margin-left:-70px;position:absolute">
                        <table><tr><td style="width:200px;text-align:left">
                            <span style="margin-left:10px;display:none; opacity: 0.8" class="texteStatus"><b>Statut précipitations  </b></span>
                        </td><td>
                            <b><span id="statusPluie" style="display:none"> </span></b><img id="statusPluieWarning" style="display:none" height="35" src="img/warning.png" ></br>
                        </td></tr><tr><td style="text-align:left">
                            <span style="margin-left:10px;display:none; opacity: 0.8;" class="texteStatus"><b>Statut lumière </b></span>
                        </td><td>
                            <img id="statusLumiere" style="display:none;opacity:0.7" src="img/jour.png" height="50">
                        </td></tr></table>
                    </div>
                    
                     <div class= "mainTitle">Météo temps réel</div>
                      <div class="carreMain" style="width:98%; margin-top:5px;height:842px;">
                     
                    <div style="margin-top:-45px;position:absolute;" class="   jauge"  id="humidite"></div>
                    <div style="margin-top:-45px;margin-left:195px;position:absolute;" class="  jauge" id="pluie"></div>
                    <div style="margin-top:160px;position:absolute"class="   jauge" id="luminosite"></div>
                    <div style="margin-left:195px;margin-top:160px" class=" jauge" id="temperatureExterieure"></div>
                    <div style="margin-top:-60px;" class="solidJauge  " id="deltaTemperature" ></div>
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
                                    <b>Etat capteurs </b>
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
                    <div class="carreMain" style="width:99%;margin-top:5px;">
                         <img src="img/control.png" style="padding-left:5px;opacity:0.8;" height="30"> <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px" >Contrôle des commandes</span></b>
                        <table class="commandesTelescopeStyle" align="center">
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                        <input id="Resistance" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("resistanceChauffante")?>/>
                                        <span class="switch-label resistCouleur" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                    </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Résistance chauffante</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                        <input id="TensionTelescope" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("tension")?> />
                                        <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                    </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Mise sous tension télescope</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                       <input id="Alarme" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("alarme")?> />
                                       <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                    </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Alarme</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                      <input id="Toit" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("toit")?> />
                                      <span class="switch-label" data-on="Fermer" data-off="Ouvrir"></span> <span class="switch-handle"></span> 
                                   </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Ouverture / Fermeture toit</b></span>
                                </td>
                            </tr>

                        </table>
                    </div>
                    
                    
                        
                    
                    
                    <div class="carreMain" style="margin-top:5px;width:99%" >
                        <img height="30" style="padding-left:5px;opacity:0.6;" src="img/sat.png">
                        <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"> Contrôle du toit  </span></b></br></br>
                        <table><tr><td style="width:165px">
                            <b>Toit fermé/ouvert  </b>
                        </td><td style="width:100px">
                            0/x cm
                        </td></tr><tr><td>
                            <b>Distance du toit  </b>
                        </td><td style="margin:0px;">
                            <b><span id="capteurUltrason" style="display:none">-</span> cm</b>
                        </td></tr></table>
                        </br>
                       
                        <div id="progressbar" style="text-align:center"></div></br>
                            
                        <table><tr><td style="width:165px">
                            <b>Confirmation position</b>
                        </td><td style="width:100px">
                            <b> <span id="confirmationPositionToit" style="display:none"></span></br></b>
                        </td></tr><tr><td>
                            <b> Mouvement </b> 
                        </td><td>
                            <span id="confirmationmouvement">Non</span>
                        </td></tr></table>
                    </div>
                    </br>
                    <div class="carreMain" style="margin-top:5px;width:99%" >
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
                    
                     <div class="carreMain" style="margin-top:5px;width:99%;height:110px;" >
                    AccelerometreX : <b><span id="accX">-</span></b></br>
                    Accelerometre Y : <b><span id="accY">-</span></b></br>
                    Accelerometre Z : <b><span id="accZ">-</span></b></br>
                     </div>
                </div>
                

                <div class="fond affichageCameras ">
                    <div class= "mainTitle">Caméras IP</div>
                    <div id="camera">
                    <div class="carreMain" style="width:99%;margin-top:5px; height:1033px">
                        <img src="img/camera.png" height="30" style="padding-left:5px;opacity:0.6;">
                        <span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"><b>Caméras IP</b></span></br>
                         <img id="loadCamera" src="img/load.gif" style="text-align:center;opacity:0.6;margin-left:200px;position:absolute">
                        <img class="cameraNord" id="cameraNord" style="display:none" src=""/></br></br>
                        <img class="cameraSud" id="cameraSud" style="display:none" src=""/>
                    </div>
                    </div>

                </div>
            <div class="fond affichageGraphiques" style="margin-top:5px;width:89%">
                    <div class= "mainTitle">Meteo des dernières 24h</div>
                    <div class="carreMain" style="width:95%;margin-top:10px;">
                        <div class="graphique" id="graphePression" ></div>
                        <div class="graphique" id="grapheHumidite" ></div>
                        <div class="graphique" id="grapheTemperatureExterieure" ></div>
                        <div class="graphique" id="grapheDetectionEau"></div>
                        <div class="graphique" id="grapheLuminosite"></div>
                    </div>
            </div>
               <!-- <div class="fond meteo">
                      <div class= "mainTitle">API météo</div>
                      API's météo
                </div>-->
       

        </div>
        

        
    </div>
    
    
                    <div id="time2" style="color:blue;z-index:10000000;"></div>
                        
    </body>
</html>
