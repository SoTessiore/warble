<?php

session_start();
include('../filters/GuestsFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

//si le formulaire est soumis
if(isset($_POST['login'])) {
    if(not_empty(['identifiant','user_password'])) {
        extract($_POST);
        $identifiant = $_POST['identifiant'];
        $user_password = $_POST['user_password'];

        //on récupère l'utilisateur avec cet identifiant et ce mot de passe
        $query = $db->prepare("SELECT user_id, user_pseudo, user_mail, user_avatar FROM user 
                                        WHERE (user_pseudo = :identifiant OR user_mail = :identifiant) 
                                        AND user_password = :user_password");
        $query->execute([
            'identifiant' => $identifiant,
            'user_password' => sha1($user_password)
        ]);

        //si un utilisateur a été trouvé on le redirige vers sa page de profil, sinon on affiche un message d'erreur
        $userHasBeenFound = $query->rowCount();

        if($userHasBeenFound){
            $user = $query->fetch(PDO::FETCH_OBJ);

            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_pseudo'] = $user->user_pseudo;
            $_SESSION['user_avatar'] = $user->user_avatar;

            redirect('ProfileController.php?id='.$user->user_id);
        } else {
            $error = "Identifiant ou mot de passe incorrect";
            save_input_data();
        }
    }
} else {
    clear_input_data();
}

require('../view/ConnexionView.php');