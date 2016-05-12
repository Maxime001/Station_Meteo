<!doctype html>
<head>
    <title>Bienvenue</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="login">
    <form action="index.php" method="post" enctype="multipart/form-data">
        
        <div class="logBlock">
            <div class="logContainer"></br></br>
                <?php
                $form = new Form();
                ?>
                <div class="fieldContainer">
                    <?= $form->input("id","text"); ?>
                </div></br>
                <div class="fieldContainer">
                    <?=$form->input("pass","password"); ?>
                </div ></br>
                <div class="fieldContainer">
                    <?= $form->submit() ;?>
                </div>
                <div>
                    <?= $Verif;?>
                </div>
            </div>
        </div>
    </form>
</body>