<?php

//sécurise les inputs
if (!function_exists('e')) {
    function e($string) {
        if($string) {
            return htmlspecialchars($string);
        }
    }
}

//récupère les infos stockées dan la session
if (!function_exists('get_session')) {
    function get_session($key) {
        if($key) {
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
    }
}

//trouve l'utilisateur correspondant à l'id entré en paramètres
if (!function_exists('find_user_by_id')) {
    function find_user_by_id($id) {
        global $db;

        $query = $db->prepare('SELECT user_name, user_pseudo, user_bio, user_mail, user_born, follower_count, following_count, user_avatar
                                FROM user
                                WHERE user_id = ?');
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_OBJ);
        $query->closeCursor();
        return $data;
    }
}

//vérifie si les champs entrés en paramètres sont vides
if (!function_exists('not_empty')) {
    function not_empty($fields = []) {
        if(count($fields) != 0) {
            foreach($fields as $field) {
                if(empty($_POST[$field]) || trim($_POST[$field]) === "") {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}

//vérifie si la donnée entrée en paramètre existe déjà
if (!function_exists('is_already_in_use')){
    function is_already_in_use($field, $value, $table) {
        global $db;

        $query = $db->prepare("SELECT user_id FROM $table WHERE $field = ?");
        $query->execute([$value]);
        $count = $query->rowCount();
        $query->closeCursor();

        return $count;
    }
}

//vérifie si le tweet en paramètre a déjà été liké par l'utilisateur actuel
if (!function_exists('has_already_liked')){
    function has_already_liked($tweet_id) {
        global $db;

        $query = $db->prepare("SELECT tlike_tweet_id FROM tlike 
                                        WHERE tlike_user_id = :tlike_user_id AND tlike_tweet_id = :tweet_id");
        $query->execute([
            'tlike_user_id' =>get_session('user_id'),
            'tweet_id' => $tweet_id
        ]);

         return (bool) $query->rowCount();
    }
}

//vérifie si le tweet en paramètre a déjà été retweeté par l'utilisateur actuel
if (!function_exists('has_already_retweeted')){
    function has_already_retweeted($tweet_id) {
        global $db;

        $query = $db->prepare("SELECT retweet_tweet_id FROM retweet 
                                        WHERE retweet_user_id = :retweet_user_id AND retweet_tweet_id = :retweet_tweet_id");
        $query->execute([
            'retweet_user_id' =>get_session('user_id'),
            'retweet_tweet_id' => $tweet_id
        ]);

        return (bool) $query->rowCount();
    }
}

//vérifie si l'utilisateur en paramètre a déjà été follow par l'utilisateur actuel
if (!function_exists('isFollowing')){
    function isFollowing($user_id) {
        global $db;

        $query = $db->prepare("SELECT follow_id FROM follow 
                                        WHERE follow_follower_id = :follow_follower_id AND follow_following_id = :follow_following_id");
        $query->execute([
            'follow_follower_id' => $user_id,
            'follow_following_id' => get_session('user_id')
        ]);

        return (bool) $query->rowCount();
    }
}

//permet de garder en mémoire les données saisies
if (!function_exists('save_input_data')){
    function save_input_data() {
        foreach($_POST as $key => $value) {
            if (strpos($key, 'user_password') === false) {
                $_SESSION['input'][$key] = $value;
            }
        }
    }
}

//retoune les données gardées en mémoire
if (!function_exists('get_input')){
    function get_input($key) {
        if(!empty($_SESSION['input'][$key])) {
            return e($_SESSION['input'][$key]);
        } else {
            return null;
        }
    }
}

//permet de supprimer les données gardées en mémoire
if (!function_exists('clear_input_data')){
    function clear_input_data() {
        if(!empty($_SESSION['input'])) {
            return $_SESSION['input'] = [];
        }
    }
}

//permet de rediriger vers une page donnée
if (!function_exists('redirect')){
    function redirect($page) {
        header('Location: '.$page);
        exit();
    }
}


