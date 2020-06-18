<?php

session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

//supprime un tweet que si la personne qui supprime est l'auteur du tweet

$query = $db->prepare('SELECT tweet_user_id FROM tweet WHERE tweet_id = :tweet_id');

$query->execute([
    'tweet_id' => $_GET['id']
]);

$tweet_user_id = $query->fetchAll(PDO::FETCH_OBJ);

$query = $db->prepare('DELETE FROM tlike
                        WHERE tlike_tweet_id = :tweet_id;
                        DELETE FROM retweet
                        WHERE retweet_tweet_id = :tweet_id;
                        DELETE FROM tweet
                        WHERE tweet_id = :tweet_id');

$query->execute([
    'tweet_id' => $_GET['id']
]);

redirect('ProfileController.php?id='.get_session('user_id'));