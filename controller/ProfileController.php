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
        $query = $db->prepare('SELECT tweet_id, tweet_content, tweet_date, tweet_user_id, tlike_count, retweet_count, user_pseudo, user_avatar FROM tweet
                                left outer JOIN tlike ON tweet_id = tlike_tweet_id
                                left outer join user on user_id = tweet_user_id
                                WHERE tlike_user_id = 8

                                union distinct

                                SELECT tweet_id, tweet_content, tweet_date, tweet_user_id, tlike_count, retweet_count, user_pseudo, user_avatar FROM tweet
                                left outer JOIN retweet ON tweet_id = retweet_tweet_id
                                left outer join user on user_id = tweet_user_id
                                WHERE retweet_user_id = 8

                                union distinct

                                SELECT tweet_id, tweet_content, tweet_date, tweet_user_id, tlike_count, retweet_count, user_pseudo, user_avatar FROM tweet
                                left outer join user on user_id = tweet_user_id
                                WHERE tweet_user_id = 8
                                
                                ORDER BY tweet_date');
        $query->execute([
            'user_id' => $user_id
        ]);
        $tweets = $query->fetchAll(PDO::FETCH_OBJ);

    }
} else {
    redirect('ProfileController.php?id='.get_session('user_id'));
}

require('../view/ProfileView.php');