<!doctype html>
<head>
    <title>Bienvenue</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript" src="js/libs/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript">
        function afficheAlerte(){
        $var = "<?= $Verif ?>";
        if($var != ""){
           document.getElementById("alertBlock").style.visibility = "visible";
        }
    }
    </script>
</head>
<body class="login" onload="afficheAlerte()">
    <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
        

        <div id="dd" class="logBlock">     
            <div class="title" style="margin-top:-40px; margin-left:100px; position:absolute; color:white; font-size:25px;">Andromède</div>
        
            <div class="logContainer"></br></br>
                <?php
                $form = new Form();
                ?>
                <div class="fieldContainer1">
                    <img src="img/user.png" class="imgConnect">
                    <span class="field">
                        <?= $form->input("id", "text", "saisie", "Identifiant"); ?>
                    </span>
                </div></br>
                <div class="fieldContainer2">
                     <img src="img/pass.png" class="imgConnect">
                     <span  class="field">
                        <?=$form->input("pass", "password", "saisie", "Mot de passe"); ?>
                     </span>
                </div ></br>
                <div class="fieldContainerValidate">
                    <?= $form->submit("submitButton") ;?>
                </div>
          
            </div>     


            </div>


        </div>
        <div id="alertBlock"  class="logBlock2"><span class="verifStyle2"><?= $Verif;?></span></div>  

    </form>
</body>
