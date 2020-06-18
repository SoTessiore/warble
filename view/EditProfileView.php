<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>Edition / Warble</title>
    <link rel="stylesheet" type="text/css" href="style/EditProfileStyle.css" />
    <link rel="shortcut icon" href="style/images/twitter3.png" type="image/x-icon">
</head>
<body>
<a class="LIENTOP" href="ProfileController.php"><img class="icon_return" src="style/images/back.png" alt="Back"/></a>
<img class = "logo" src="style/images/twitter3.png" alt="logo site">
<h1 id="title">Editer le profil</h1>

<div class="error">
    <?php
        if(isset($errors) && count($errors) != 0) {
            echo '<div>';
            foreach ($errors as $error) {
                echo $error.'</br></br>';
            }
            echo '</div>';
        }
    ?>
</div>

<div class= "success">
    <?php
        if(isset($success)){
            echo '<div>';
            echo $success.'</br></br>';
            echo '</div>';
        }
    ?>
</div>


<form class="formulaire" method="POST" autocomplete="off" enctype="multipart/form-data">
<div class="input-field">
    <?php if(!empty($user->user_avatar)): ?>
        <img class="imageprofil_tweet" src="style/images/avatars/<?php echo $user->user_avatar; ?>" alt="imageprofil">
    <?php else: ?>
        <img class="imageprofil_tweet" src="style/images/default_profile.png" alt="imageprofil"/>
    <?php endif; ?>
    <input class="eee" autofocus type="file" name="avatar" class="input-field-photo" value="<?= get_input('user_avatar') ? get_input('user_avatar') : e($user->user_avatar) ?>")>
</div>
    <input autofocus type="text" name="user_name" id="identifiant" value="<?= get_input('user_name') ? get_input('user_name') : e($user->user_name) ?>" class="input-field" placeholder="Nom" required>
    <input autofocus type="text" name="user_pseudo" id="pseudo" value="<?= get_input('user_pseudo') ? get_input('user_pseudo') : e($user->user_pseudo) ?>" class="input-field" placeholder="Pseudo" required>
    <input autofocus type="date" name="user_born" id="born" value="<?= get_input('user_born') ? get_input('user_born') : e($user->user_born) ?>" class="input-field" placeholder="Date de naissance">
    <textarea name="user_bio" id="comments" class="input-field" placeholder="Bio"><?= get_input('user_bio') ? get_input('user_bio') : e($user->user_bio) ?></textarea>
    <input class="Button" type="submit" value="Enregistrer" name="enregistrer">
</form>



</body>
</html>