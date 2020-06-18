<?php

session_start();
include('../filters/GuestsFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

//si le formulaire est soumis
if(isset($_POST['register'])) {
    if(not_empty(['user_name','user_pseudo','user_password','user_password_confirm','user_mail'])) {

        $errors = []; //tableau contenant les erreurs

        extract($_POST);
        $name = $_POST['user_name'];
        $pseudo = $_POST['user_pseudo'];
        $born = $_POST['user_born'];
        $email = $_POST['user_mail'];
        $mdp = $_POST['user_password'];
        $mdp_confirm = $_POST['user_password_confirm'];

        //vérifie la taille du pseudo 
        if(mb_strlen($pseudo) <= 3 || mb_strlen($pseudo) >= 15) {
            $errors[] = "Le pseudo doit contenir entre 3 et  15 caractères";
        }

        //vérifie la validité du mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse mail n'est pas valide";
        }

        //vérifie la taille du mot de passe  
        if(mb_strlen($mdp) <= 6 || mb_strlen($mdp) >= 15) {
            $errors[] = "Le mot de passe doit contenir entre 6 et  15 caractères";
        } else {
            if($mdp !== $mdp_confirm) {
                $errors[] = "Les deux mots de passe ne sont pas les mêmes";
            }
        }

        //vérifie si le pseudo est libre
        if(is_already_in_use('user_pseudo', $pseudo, 'user')) {
            $errors[] = "Pseudo déjà utilisé";
        }

        //vérifie le mail est libre
        if(is_already_in_use('user_mail', $email, 'user')) {
            $errors[] = "Adresse mail déjà utilisée";
        }

        if(count($errors) == 0) {

            //enregistrement
            $query = $db->prepare('INSERT INTO user(user_name, user_pseudo, user_mail, user_password, user_born)
                                            VALUES (:user_name, :user_pseudo, :user_mail, :user_password, :user_born)' );
            $query->execute([
                'user_name' => $name,
                'user_pseudo' => $pseudo,
                'user_born' => $born,
                'user_password' => sha1($mdp),
                'user_mail' => $email,
            ]);

            redirect('ConnexionController.php');

        }else {
            save_input_data();
        }

    } else {
        $errors[] = "Veuillez remplir tous les champs svp";
    }
} else {
    clear_input_data();
}

require('../view/InscriptionView.php');