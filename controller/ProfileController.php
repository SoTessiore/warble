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
        $query = $db->prepare('SELECT tweet_id, tweet_content, tweet_date, user_pseudo, tweet_user_id, user_avatar, tlike_tweet_id, retweet_tweet_id, tlike_count, retweet_count FROM tweet
                                        LEFT OUTER JOIN tlike ON tweet_id = tlike_tweet_id
                                        LEFT OUTER JOIN retweet ON tweet_id = retweet_tweet_id
                                        LEFT OUTER JOIN user ON tweet_user_id = user_id
                                        WHERE tweet_user_id = :user_id OR tlike_user_id = :user_id OR retweet_user_id = :user_id
                                        ORDER BY tweet_date DESC');
        $query->execute([
            'user_id' => $user_id
        ]);
        $tweets = $query->fetchAll(PDO::FETCH_OBJ);

    }
} else {
    redirect('ProfileController.php?id='.get_session('user_id'));
}

require('../view/ProfileView.php');