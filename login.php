<!doctype html>
<head>
    <title>Bienvenue</title>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <?php
            $form = new Form();
            echo "</br></br>Identifiant :".$form->input("id","text");
            echo "Mot de passe :".$form->input("pass","password");
            echo $form->submit();
        ?>
    </form>
</body>