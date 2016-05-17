<!DOCTYPE html>
<html>
    <head>
        <title> Station Météo</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="../favicon.ico">
        <!-- CSS du template -->
        <link rel="stylesheet" type="text/css" href="template/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="template/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="template/css/component.css" />
        <!-- JS du template -->
        <script src="js/modernizr.custom.js"></script>        
        <!-- Jquery -->
        <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/contenu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
        <script type="text/javascript"></script>
    </head>
    <body class="main">
        <div class="container-fluid">
            <ul id="gn-menu" class="gn-menu-main">
                <li class="gn-trigger">
                    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
                    <nav class="gn-menu-wrapper">
                        <div class="gn-scroller">
                            <ul class="gn-menu">
                                <li class="gn-search-item">
                                    <input placeholder="Search" type="search" class="gn-search">
                                    <a class="gn-icon gn-icon-search"><span>Search</span></a>
                                </li>
                                <li>
                                    <a class="gn-icon gn-icon-download">Downloads</a>
                                    <ul class="gn-submenu">
                                        <li><a class="gn-icon gn-icon-illustrator">Vector Illustrations</a></li>
                                        <li><a class="gn-icon gn-icon-photoshop">Photoshop files</a></li>
                                    </ul>
                                </li>
                                <li><a class="gn-icon gn-icon-cog">Settings</a></li>
                                <li><a class="gn-icon gn-icon-help">Help</a></li>
                                <li>
                                    <a class="gn-icon gn-icon-archive">Archives</a>
                                    <ul class="gn-submenu">
                                        <li><a class="gn-icon gn-icon-article">Articles</a></li>
                                        <li><a class="gn-icon gn-icon-pictures">Images</a></li>
                                        <li><a class="gn-icon gn-icon-videos">Videos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </li>
                <li><a href="http://tympanus.net/codrops">Codrops</a></li>
                <li><a class="codrops-icon codrops-icon-prev" href=""><span>Previous Demo</span></a></li>
                <li> STATUT DES CAPTEURS </li>
                
            </ul>
            
            
            <main>

                <div class="fond affichageJauges">
                     <div class= "mainTitle">Meteo temps réel</div>
                    <div class="   jauge"  id="humidite"></div>
                    <div class="  jauge" id="pluie"></div>
                    <div class="   jauge" id="luminosite"></div>
                    <div class=" jauge" id="temperatureExterieure"></div>
                    <div class="solidJauge  " id="deltaTemperature" ></div>
                </div>
                <div class="fond" style="margin-top:80px;height:500px; padding:5px;z-index:-10;">
                    <div class= "mainTitle" style="">Contrôle des commandes</div>
                    </br></br>
                    <button id="Resistance">Resistance chauffante</button></br></br>
                    <button id="Alarme">Alarme</button></br></br>
                    <button id="Toit">Toit</button></br></br>
                </div>

                <div class="fond " style="margin-top:80px; height:auto; padding:5px;z-index:-10;">
                    <div class= "mainTitle">Meteo des dernières 24h</div>
                    <div class="graphique" id="graphePression" ></div></br>
                    <div class="graphique" id="grapheHumidite" ></div>
                    <div class="graphique" id="grapheTemperatureExterieure" ></div>
                    <div class="graphique" id="grapheDetectionEau"></div>
                    <div class="graphique" id="grapheLuminosite"></div>
                </div>
                <div class="fond" style="height:200px; padding:5px;z-index:-10;">
                    
            </main>

        </div>
        
        <script src="template/js/classie.js"></script>
        <script src="template/js/gnmenu.js"></script>
        <script>
                new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>
        
        
    </div>
    </body>
</html>