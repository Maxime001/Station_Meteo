<!doctype html>
<head>
    <title>Bienvenue</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript">
    </script>
</head>
<body class="login">
    <form action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">
        

        <div class="logBlock">     
            <div class="title" style="margin-top:-40px; margin-left:100px; position:absolute; color:white; font-size:25px;">Andromède</div>
            <div class="logContainer"></br></br>
                <?php
                $form = new Form();
                ?>
                <div class="fieldContainer1">
                    <img src="img/user.png" class="imgConnect">
                    <span class="field">
                        <?= $form->input("id","text","saisie"); ?>
                    </span>
                </div></br>
                <div class="fieldContainer2">
                     <img src="img/pass.png" class="imgConnect">
                     <span  class="field">
                        <?=$form->input("pass","password","saisie"); ?>
                     </span>
                </div ></br>
                <div class="fieldContainerValidate">
                    <?= $form->submit() ;?>
                </div>
            </div>     
        </div>
        <div class="logBlock2"><span class="verifStyle"><?= $Verif;?></span></div>  

    </form>
</body>