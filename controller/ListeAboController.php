<?php
session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

if(!empty($_GET['id'])) {
    $user = find_user_by_id($_GET['id']);
    $user_id = $_GET['id'];

    //vérifie si l'utilisateur est connecté
    if(!$user){
        redirect('ConnexionController.php');
    } else {
        //on affiche dans les tweets de l'utilisateur, ceux au'il a liké et retweeté par ordre chronologique
        $query = $db->prepare('SELECT user_pseudo, user_id, user_avatar, user_bio FROM user 
                                LEFT OUTER JOIN follow ON follow_follower_id = user_id
                                WHERE follow_following_id = :user_id
                                ORDER BY user_pseudo');
        $query->execute([
            'user_id' => $user_id
        ]);
        $followings = $query->fetchAll(PDO::FETCH_OBJ);

        $query = $db->prepare('SELECT user_pseudo, user_id, user_avatar, user_bio FROM user 
                                LEFT OUTER JOIN follow ON follow_following_id = user_id
                                WHERE follow_follower_id = :user_id
                                ORDER BY user_pseudo');
        $query->execute([
            'user_id' => $user_id
        ]);
        $followers = $query->fetchAll(PDO::FETCH_OBJ);

    }
} else {
    redirect('ProfileController.php?id='.get_session('user_id'));
}

require('../view/ListeAboView.php');