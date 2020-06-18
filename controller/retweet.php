<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');


if(!has_already_retweeted($_GET['id'])){
    //si le retweet n'existe pas déjà, on le crée dans la base de données, sinon on le détruit
    $query = $db->prepare('INSERT INTO retweet(retweet_tweet_id, retweet_user_id)
                            VALUES(:tweet_id, :user_id)');

    $query->execute([
        'tweet_id' => $_GET['id'],
        'user_id' => get_session('user_id')
    ]);

    //on ajoute 1 au nombre de retweets du tweet
    $query = $db->prepare('UPDATE tweet SET retweet_count = retweet_count + 1 WHERE tweet_id = :tweet_id');

    $query->execute([
        'tweet_id' => $_GET['id']
    ]);
} else {
    //si le retweet existe déjà, l'inverse se produit
    $query = $db->prepare('DELETE FROM retweet
                            WHERE retweet_tweet_id = :tweet_id AND retweet_user_id = :user_id');

    $query->execute([
        'tweet_id' => $_GET['id'],
        'user_id' => get_session('user_id')
    ]);

    $query = $db->prepare('UPDATE tweet SET retweet_count = retweet_count - 1 WHERE tweet_id = :tweet_id');

    $query->execute([
        'tweet_id' => $_GET['id']
    ]);
}


redirect('PrincipaleController.php?id='.get_session('user_id').'#tweet'.$_GET['id']);