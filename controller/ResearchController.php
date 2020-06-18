<?php
session_start();
include('../filters/UserFilter.php');
require('../Model/WarbleModel.php');
require('../database/database.php');

if(isset($_POST['search']) && !empty($_POST['text'])){
    extract($_POST);
    $text = preg_replace("#[^a-zA-Z ?0-9]#i", "", $_POST['text']);

    //recherche des profils contenant la chaine de caractères entrée par l'utilisateur dans le pseudo ou le nom
    $q = $db->prepare("SELECT user_id, user_pseudo, user_avatar, user_bio FROM user 
                                WHERE user_pseudo like '%$text%' or user_name like '%$text%'
                                ORDER BY user_pseudo");
    $q->execute([
        'text' => $text
    ]);
    $usersFound = $q->fetchAll(PDO::FETCH_OBJ);
    $found = $q->rowCount();
    save_input_data();

} else {
    clear_input_data();
}

//affiche tous les autres utilisateurs
$query = $db->query("SELECT user_pseudo, user_id, user_avatar, user_bio FROM user ORDER BY user_pseudo");
$users = $query->fetchAll(PDO::FETCH_OBJ);

require('../view/ResearchView.php');