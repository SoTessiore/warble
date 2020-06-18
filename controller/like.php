<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

if(!has_already_liked($_GET['id'])){
    //si le like n'existe pas déjà, on le crée dans la base de données, sinon on le détruit
    $query = $db->prepare('INSERT INTO tlike(tlike_tweet_id, tlike_user_id)
                            VALUES(:tlike_tweet_id, :tlike_user_id)');

    $query->execute([
        'tlike_tweet_id' => $_GET['id'],
        'tlike_user_id' => get_session('user_id')
    ]);

    //on ajoute 1 au nombre de likes du tweet
    $query = $db->prepare('UPDATE tweet SET tlike_count = tlike_count + 1 WHERE tweet_id = :tweet_id');

    $query->execute([
        'tweet_id' => $_GET['id']
    ]);
} else {
    //si le like existe déjà, l'inverse se produit
    $query = $db->prepare('DELETE FROM tlike
                            WHERE tlike_tweet_id = :tweet_id AND tlike_user_id = :user_id');

    $query->execute([
        'tweet_id' => $_GET['id'],
        'user_id' => get_session('user_id')
    ]);

    $query = $db->prepare('UPDATE tweet SET tlike_count = tlike_count - 1 WHERE tweet_id = :tweet_id');

    $query->execute([
        'tweet_id' => $_GET['id']
    ]);
}

redirect('PrincipaleController.php?id='.get_session('user_id').'#tweet'.$_GET['id']);