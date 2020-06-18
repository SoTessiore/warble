<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) {
    $user = find_user_by_id($_GET['id']);
    $user_id = $_GET['id'];

    //vérifie si l'utilisateur est connecté
    if(!$user){
        redirect('ConnexionController.php');
    } else {
        //on affiche dans la timeline les tweets de l'utilisateur et des personnes qu'il suit par ordre chronologique
        $query = $db->prepare('SELECT t.tweet_id, t.tweet_content,  t.tweet_date, t.tlike_count, t.retweet_count, t.tweet_user_id, user_pseudo, user_avatar FROM tweet AS t
                                LEFT OUTER JOIN user ON user_id = tweet_user_id
                                where tweet_user_id = :user_id

                                UNION DISTINCT SELECT tweet_id, tweet_content,  tweet_date, tlike_count, retweet_count, tweet_user_id, user_pseudo, user_avatar FROM tweet
                                LEFT OUTER JOIN follow ON tweet_user_id = follow_following_id
                                LEFT OUTER JOIN user ON user_id = tweet_user_id
                                WHERE follow_follower_id = :user_id
                                ORDER BY tweet_date DESC');
        $query->execute([
            'user_id' => $user_id
        ]);
        $tweets = $query->fetchAll(PDO::FETCH_OBJ);
    }
} else {
    redirect('PrincipaleController.php?id='.get_session('user_id'));
}

require('../view/PrincipaleView.php');