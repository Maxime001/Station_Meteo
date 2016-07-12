<!-- Menu -->
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
                                    <a href="index.php?p=console" class="gn-icon gn-icon-download">Console</a>

                                </li>
                                <li><a href="index.php?p=parametres" class="gn-icon gn-icon-cog">Paramètres</a></li>
                                <li>
                                    <a href="index.php?p=HistoriqueMeteo" class="gn-icon gn-icon-archive">Meteo</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </li>         
                <li><a href="index.php" ><span>Accueil</span></a></li>
                <li><a href="logout.php"  ><img class="logout" src="img/logout.png"></a></li>         
            </ul>
            <div id="titresecondaire" class="principalTitle"><span>Andromede Observatory</span></div>
        </div> 
        <script src="css/template/js/classie.js"></script>
        <script src="css/template/js/gnmenu.js"></script>
        <script>
                new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>