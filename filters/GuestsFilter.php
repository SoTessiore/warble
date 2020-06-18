<?php

//pour les pages dont l'accès est réservé aux utilisateurs
if(isset($_SESSION['user_id']) && isset($_SESSION['user_pseudo'])) {
    header('Location: ProfileController.php');
    exit();
}