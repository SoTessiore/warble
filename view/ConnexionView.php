
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connectez-vous sur Warble</title>
        <link rel="stylesheet" href="style/ConnexionStyle.css"/>
        <link rel="shortcut icon" href="style/images/twitter3.png" type="image/x-icon">
    </head>

    <body>
        <img class = "logo" src="style/images/twitter3.png" alt="logo site">
        <h1 id="title">Se connecter à Warble</h1>

        <div class="error">
        <?php
        if(isset($error)) {
            echo '<div>';
            echo $error.'</br></br>';
            echo '</div>';
        }
        ?>
        </div>

        <form class="formulaire" action="" method="POST" autocomplete="off">
            <input autofocus type="text" name="identifiant" id="identifiant" value="<?= get_input('identifiant') ?>" class="input-field" placeholder="Email ou nom d'utilisateur" required>
            <input autofocus type="password" name="user_password" id="mdp"  class="input-field" placeholder="Mot de passe" required>
            <input class="Button" name="login" type="submit" value="Se connecter">
        </form>
        <div class="inscription">

            <a href="InscriptionController.php">S'inscrire sur Twitter</a>
        </div>
    </body>
</html>