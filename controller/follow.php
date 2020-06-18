<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');


if(isset($_POST['follow'])) {

    //si le follow n'existe pas déjà, on le crée dans la base de données, sinon on le détruit
    if(!isFollowing($_GET['id'])){
        $query = $db->prepare('INSERT INTO follow(follow_follower_id, follow_following_id)
                            VALUES(:follower_id, :following_id)');

        $query->execute([
            'follower_id' => $_GET['id'],
            'following_id' => get_session('user_id')
        ]);

        //on ajoute 1 au nombre d'abonnés et d'abonnements de la personne qui est suivie et de celle qui suit
        $query = $db->prepare('UPDATE user SET follower_count = follower_count + 1 WHERE user_id = :following_id');

        $query->execute([
            'following_id' => get_session('user_id')
        ]);

        $query = $db->prepare('UPDATE user SET following_count = following_count + 1 WHERE user_id = :follower_id');

        $query->execute([
            'follower_id' => $_GET['id']
        ]);

    } else {
        //si le follow existe déjà, l'inverse se produit
        $query = $db->prepare('DELETE FROM follow
                            WHERE follow_follower_id = :follower_id AND follow_following_id = :following_id');

        $query->execute([
            'follower_id' => $_GET['id'],
            'following_id' => get_session('user_id')
        ]);

        $query = $db->prepare('UPDATE user SET follower_count = follower_count - 1 WHERE user_id = :following_id');

        $query->execute([
            'following_id' => get_session('user_id')
        ]);

        $query = $db->prepare('UPDATE user SET following_count = following_count - 1 WHERE user_id = :follower_id');

        $query->execute([
            'follower_id' => $_GET['id']
        ]);
    }
}



redirect('ProfileController.php?id='.$_GET['id']);
