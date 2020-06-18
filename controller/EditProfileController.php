<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

//si l'utilisateur n'est pas connecté ou si il essaie de mofier un profil qui n'est pas le sien, il est redirigé
if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) {
    $user = find_user_by_id($_GET['id']);
    if(!$user){
        redirect('ConnexionController.php');
    }
} else {
    redirect('ProfileController.php?id='.get_session('user_id'));
}

$errors=[];

//permet de charger une photo de profil
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['avatar']['size'] <= $tailleMax){
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides)){
            $chemin = "style/images/avatars/".get_session('user_id').".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            if($resultat){
                $updateavatar = $db->prepare('UPDATE user SET user_avatar = :avatar WHERE user_id = :user_id');
                $updateavatar->execute([
                    'avatar' => get_session('user_id').".".$extensionUpload,
                    'user_id' => get_session('user_id')
                    ]);
            }else{
                $errors[] = "Erreur durant l'importation de votre photo de profil";
            }
        }else{
            $errors[] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    }else{
        $errors[] = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}

if(isset($_POST['enregistrer'])) {
    if(!empty($_POST['user_name']) && !empty($_POST['user_bio']) && !empty($_POST['user_born']) ) {
        extract($_POST);
        $name = $_POST['user_name'];
        $pseudo = $_POST['user_pseudo'];
        $bio = $_POST['user_bio'];
        $born = $_POST['user_born'];

        //enregistrement des modifications dans la base de données
        $query = $db->prepare('UPDATE user
                                    SET user_name = :user_name, user_bio = :user_bio, user_born = :user_born, user_pseudo = :user_pseudo
                                    WHERE    user_id = :user_id' );
        $query->execute([
            'user_name' => $name,
            'user_bio' => $bio,
            'user_born' => $born,
            'user_pseudo' => $pseudo,
            'user_id' => get_session('user_id')
        ]);

        if(count($errors) == 0){
            $success = "Profil modifié avec succès";
        }
        save_input_data();
    }
}

require('../view/EditProfileView.php');