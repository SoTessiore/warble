<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

// si on appuie sur le bouton déeconnexion, on détruit la session en cours et on redirige l'utilisateur vers la page de connexion
if(isset($_POST['Deconnexion'])){
    session_destroy();

    $_SESSION = [];

    header('Location: ConnexionController.php');
    exit();
}
