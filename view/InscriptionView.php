<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connectez-vous sur Warble</title>
        <link rel="stylesheet" href="style/InscriptionStyle.css">
        <link rel="shortcut icon" href="style/images/twitter3.png" type="image/x-icon">
    </head>

    <body>
        <img class = "logo" src="style/images/twitter3.png" alt="logo site">
        <h1 id="title">Créer votre compte</h1>
        <div class="error">
        <?php
            if(isset($errors) && count($errors) != 0) {
                echo '<div>';
                foreach ($errors as $error) {
                    echo $error.'</br></br>';
                }
                echo '</div>';
            }
        ?>
        </div>

        <form class="formulaire" method="POST" autocomplete="off">
            <input autofocus type="text" name="user_name" value="<?= get_input('user_name') ?>" id="identifiant" class="input-field" placeholder="Nom et Prenom" required>
            <input autofocus type="text" name="user_pseudo" value="<?= get_input('user_pseudo') ?>" id="pseudo" class="input-field" placeholder="Pseudo" required>
            <input autofocus type="date" name="user_born" id="age" value="<?= get_input('user_born') ?>" class="input-field" placeholder="Date de naissance">
            <input autofocus type="text" name="user_mail" id="email" value="<?= get_input('user_mail') ?>" class="input-field" placeholder="Email" required>
            <input autofocus type="password" name="user_password" id="mdp" class="input-field" placeholder="Mot de passe" required>
            <input autofocus type="password" name="user_password_confirm" id="mdp_confirm" class="input-field" placeholder="Confirmer le mot de passe" required>
            <input class="Button" type="submit" value="Créer" name="register">
        </form>
        <div class="inscription">
        <a href="ConnexionController.php">Se connecter</a>
        </div>
    </body>
</html>