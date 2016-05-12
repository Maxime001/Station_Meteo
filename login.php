<!doctype html>
<head>
    <title>Bienvenue</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="login">
    <form action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">

        <div class="logBlock">
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
                    <?= $form->submit() ;?>
                </div>

            </div>

        </div>
                 <div>
                    <?= $Verif;?>
                </div>
    </form>
</body>