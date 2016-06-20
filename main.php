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
	background-image: url(img/pbar-ani.gif);
	border-right: 1px solid #AAA;
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
                    <div class="carreMain">
                        <table><tr><td style="width:150px;">
                            <span style="display:none" class="texteStatus"><b>Statut précipitations  </b></span>
                        </td><td>
                            <b><span id="statusPluie" style="display:none"> </span></b></br>
                        </td></tr><tr><td>
                            <span style="display:none" class="texteStatus"><b>Statut lumière </b></span>
                        </td><td>
                            <b><span id="statusLumiere" style="display:none"></span></b>
                        </td></tr></table>
                    </div>
                    </br></br>
                     <div class= "mainTitle">Météo temps réel</div>
                     </br>
                    <div class="   jauge"  id="humidite"></div>
                    <div class="  jauge" id="pluie"></div>
                    <div class="   jauge" id="luminosite"></div>
                    <div class=" jauge" id="temperatureExterieure"></div>
                    <div class="solidJauge  " id="deltaTemperature" ></div>
                </div>
                <div class="fond affichageCommandes">
                    <div class= "mainTitle">Contrôle des commandes</div>
                    <!-- Statut des capteurs -->
                    <table align="center">
                        <tr>
                            <td class="text"> <b>Statut capteurs</b> </td>
                            <td>
                    <div id="sensor_status_stripe"></div>
                    <div style="clear:both"></div>
                    <div id="sensor_status_text"></div>
                    <div style="clear:both"></div>
                    
                            </td>
                        </tr>
                    </table>
                    <div class="ligne"></div>
                    <a href="#" class="wakeup blue">Démarrage PC Observatoire</a><a href="https://nasorion68.no-ip.org:5001" target="_blank" class="wakeup blue">Accès NAS</a>
                    <table class="commandesTelescopeStyle" align="center">
                        <tr>
                            <td class="tdButton">
                                <label class="switch">
                                    <input id="Resistance" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("resistanceChauffante")?>/>
                                    <span class="switch-label resistCouleur" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                </label>
                            </td>
                            <td class="tdDesc">
                                <span class="textControl">Résistance chauffante</span>
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
                                <span class="textControl"> Mise sous tension télescope</span>
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
                                <span class="textControl">Alarme</span>
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
                                <span class="textControl">Ouverture / Fermeture toit</span>
                            </td>
                        </tr>

                    </table>
                    
                    

                        
                    
                    <p class="ligne"></p>
                    <div class="carreMain">
                        <img height="30" style="padding-left:5px;opacity:0.6;" src="img/sat.png">
                        <b><span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"> Contrôle du toit : </span></b></br></br>
                        <table><tr><td style="width:165px">
                            <b> Distance toit ouvert  </b>
                        </td><td style="width:50px">
                            x cm
                        </td></tr><tr><td>
                            <b> Distance toit fermé </b>
                        </td><td>
                            0 cm
                        </td></tr><tr><td>
                            <b>Distance du toit  </b>
                        </td><td style="margin:0px;">
                            <b><span id="capteurUltrason" style="display:none">-</span> cm</b>
                        </td></tr></table>
                        </br>
                       
                        <div id="progressbar" style="width:95%;text-align:center"></div></br>
                            
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
                    
                    <div class="carreMain">
                         <img height="30" style="padding-left:5px;opacity:0.6;" src="img/status.png">
                         <span style="padding-left:5px;padding-top:14px;opacity:0.9; font-size:17px"><b>Statut actuel :</b></span></br>
                         oaefea</br>
                         foaejfoapêj</br>
                    </div>
                    
                     
                   </br></br></br>
                    <div class="mainTitle">Vue 3D</div>
                    </br>
                    AccelerometreX : <b><span id="accX">-</span></b></br>
                    Accelerometre Y : <b><span id="accY">-</span></b></br>
                    Accelerometre Z : <b><span id="accZ">-</span></b></br>
                    <img style="width:180px;"src="img/3D.jpg"/>
                </div>
                

                <div class="fond affichageCameras ">
                    <div class= "mainTitle">Caméras IP</div>
                    <div id="camera">

                        <img class="cameraNord" id="cameraNord" src="img/cameraNord.jpg"/></br></br>
                    <img class="cameraSud" id="cameraSud" src="img/cameraSud.jpg"/>
                    </div>

                </div>
            <div class="fond affichageGraphiques">
                    <div class= "mainTitle">Meteo des dernières 24h</div>
                    <div class="graphique" id="graphePression" ></div>
                    <div class="graphique" id="grapheHumidite" ></div>
                    <div class="graphique" id="grapheTemperatureExterieure" ></div>
                    <div class="graphique" id="grapheDetectionEau"></div>
                    <div class="graphique" id="grapheLuminosite"></div>
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
