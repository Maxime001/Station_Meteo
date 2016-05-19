<?php
// Au chargement, on va faire la requete SQL qui va remplir correctement le json avec les dernieres 24h de données
$MajJson = new Json(0,"json/meteo24h.json");
$MajJson->save24h();
/*$sms = new envoiSms();
$sms->sms("Quelqu'un est sur la page main");*/

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Station Météo</title>
        <meta name="robots" content="noindex">
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="../favicon.ico">
        <!-- CSS du template -->
        <link rel="stylesheet" type="text/css" href="template/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="template/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="template/css/component.css" />
        <!-- CSS de jqueryUI -->
        <link href="css/libs/jquery-ui.min.css" rel="stylesheet">
        <!-- JS du template -->
        <script src="js/modernizr.custom.js"></script>     
        <!-- JS du stripe -->
        <script src="js/libs/raphael-2.1.4.min.js"></script>
        <script src="js/libs/justgage.js"></script>
        <script src="js/libs/TweenMax.min.js"></script>
        <script src="js/libs/CSSPlugin.min.js"></script>
        <script src="js/utility.js"></script>
        <script src="js/UI/Stripe.js"></script>
        <script src="../js/main.js"></script>
        <!-- Jquery -->
        <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
        <script src="js/libs/jquery-ui.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/contenu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- CSS du stripe -->
        <link rel="stylesheet" type="text/css" href="css/libs/style.css">
        <link rel="stylesheet" type="text/css" href="css/libs/bootstrap.min.css">
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
        <script type="text/javascript" src="js/graphiqueOptions"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/progressBarr.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script src="js/libs/solid-jauge.js"></script>
        <script type="text/javascript" src="js/clock.js"></script>
        <script>
        $(document).ready(function() {
            var dist=20;
            function progressbarr(){   
            $("#progressbar").progressbar({
                value: dist
            });
        }
        
        setInterval(function() {
            progressbarr();
            if(dist < 100){
                dist = dist+5;
            }
        }, 2000);
                
                
         
        progressbarr();
        
  
        });
    </script>
    </head>
    <body class="main">
        <div class="container-fluid" >
            <ul id="gn-menu" class="gn-menu-main" style="z-index:100;">
                <li class="gn-trigger">
                    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
                    <nav class="gn-menu-wrapper">
                        <div class="gn-scroller">
                            <ul class="gn-menu">
                                <li class="gn-search-item">
                                    <input placeholder="Rechercher" type="search" class="gn-search">
                                    <a class="gn-icon gn-icon-search"><span>Rechercher</span></a>
                                </li>
                                <li>
                                    <a class="gn-icon gn-icon-download">Console</a>

                                </li>
                                <li><a class="gn-icon gn-icon-cog">Paramètres</a></li>
                                <li>
                                    <a class="gn-icon gn-icon-archive">Meteo</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </li>         
                <li><a href=""><span>Accueil</span></a></li>
                <li><a href="http://night-pixel.fr">NightPixel</a></li>
                <li><a href="logout.php"  ><img class="logout" src="img/logout.png"></a></li>         
            </ul>
        </div>    
        <div class="centerPage">
                <div class="fond affichageJauges">
                    <div class= "mainTitle">Météo résumé</div>
                    </br></br>
                    </br></br>
                    </br></br>
                    </br></br>
                     <div class= "mainTitle">Météo temps réel</div>
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
                    
                    <table class="commandesTelescopeStyle" align="center">
                        <tr>
                            <td class="tdButton">
                                <label class="switch">
                                    <input id="Resistance" class="switch-input" type="checkbox" />
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
                                    <input id="TensionTelescope" class="switch-input" type="checkbox" />
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
                                   <input id="Alarme" class="switch-input" type="checkbox" />
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
                                  <input id="Toit" class="switch-input" type="checkbox" />
                                  <span class="switch-label" data-on="Ouvrir" data-off="Fermer"></span> <span class="switch-handle"></span> 
                               </label>
                            </td>
                            <td class="tdDesc">
                                <span class="textControl">Ouverture / Fermeture toit</span>
                            </td>
                        </tr>

                    </table>
                    
                    


                        
                        
                    </br></br>
                      <div id="progressbar" style="width:300px;margin-left:100px;"></div>
                     
                     
                   </br></br>
                   
                  
                               
                         
                            
                                     
                                  
                         
                           
                           </br></br></br></br></br>
                     <!--
                    <button id="Resistance">Resistance chauffante</button></br></br>
                    <button id="Alarme">Alarme</button></br></br>
                    <button id="Toit">Toit</button></br></br>
                    </br></br></br></br></br></br></br></br>-->
                    <div class="mainTitle">Vue 3D</div>
                    <img src="img/3D.jpg">
                </div>
                

                <div class="fond affichageCourbes ">
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
        
        <script src="template/js/classie.js"></script>
        <script src="template/js/gnmenu.js"></script>
        <script>
                new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>
        
        
    </div>
    </body>
</html>