<!doctype html>
<head>
    <title>Bienvenue</title>
    <meta name="robots" content="noindex">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/clock.js"></script>
     <link rel="icon" type="image/png" href="img/favicon.png" />
     <script src="js/main_login.js"></script>
</head>

<body class="login" onload="afficheAlerte(); document.getElementById('focus').focus(); startTime()" >
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <div style="display:none" id="time"></div>
        <div style="display:none" id="barr"></div>

        <div  id="dd" class="logBlock">     
            <div style="display:none" id="titreprincipal" class="title" style="">Andromède</div>
            <div class="logContainer"></br></br>
                <?php
                $form = new Form();
                ?>
                <div class="fieldContainer1">
                    <img src="img/user.png" class="imgConnect">
                    <span class="field">
                        <?= $form->input("id", "text", "saisie", " Identifiant","focus"); ?>
                    </span>
                </div></br>
                <div class="fieldContainer2">
                     <img src="img/pass.png" class="imgConnect">
                     <span  class="field">
                        <?=$form->input("pass", "password", "saisie", " Mot de passe","nonfocus"); ?>
                     </span>
                </div ></br>
                <div class="fieldContainerValidate">
                    <?= $form->submit("submitButton") ;?>
                </div>
            </div>     
        </div>
        <div id="alertBlock"  class="logBlock2"><span class="verifStyle2"><?= $Verif;?></span></div>  
    </form>
</body>