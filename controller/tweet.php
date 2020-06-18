<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

if(isset($_POST['tweet'])) {
    if(!empty($_POST['tweet_content'])) {
        extract($_POST);
        $comments = $_POST['tweet_content'];
        
        //insertion d'un tweet dans la base de données
        $query = $db->prepare('INSERT INTO tweet(tweet_content, tweet_user_id, tweet_date)
                                    VALUES(:tweet_content, :tweet_user_id, NOW())');

        $query->execute([
            'tweet_content' => $comments,
            'tweet_user_id' => get_session('user_id')
        ]);
    }
}

redirect('PrincipaleController.php?id='.get_session('user_id'));