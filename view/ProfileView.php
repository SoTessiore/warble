<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>Profil / Warble</title>
    <link rel="stylesheet" href="style/ProfilStyle.css">
    <link rel="shortcut icon" href="style/images/twitter3.png" type="image/x-icon">

</head>
<body>


    <div class="mainbody">
               
        <div class="col1">
            <div class="menu_footer">
                <ul>
                <li><div class="test5"><a href="PrincipaleController.php"><img class="icon_contact" src="style/images/twitter3.png" alt="Home"/></a></div></li>
                            <li> <div class="test"><a class="lien" href="PrincipaleController.php"><img class="icon_contact2" src="style/images/home.png" alt="Home"/>  Accueil</a> </div> </li>
                            <li> <div class="test"><img class="icon_contact2" src="style/images/user.png" alt="Profil"/> <a class="lien" href="ProfileController.php" >Profil</a> </div> </li>
                </ul>
                <?php if($user_id === get_session('user_id')): ?>
                    <form class="deconnexion" method="POST" action="deconnexion.php">
                        <input class="Button" type="submit"  value="Deconnexion" name="Deconnexion" >
                    </form>
                <?php endif ?>
            </div>
        </div>
        
        <div class="col2">
            <div class ="Accueil"><a class="LIENTOP" href="PrincipaleController.php"><img class="icon_return" src="style/images/back.png" alt="Home"/> </a> <a class="pseudo_topbar"><?= e($user->user_pseudo)?></a></div>
            <div class ="photoarriere">
                <?php if(!empty($user->user_avatar)): ?>
                    <img class="imageprofil" src="style/images/avatars/<?php echo $user->user_avatar; ?>" alt="imageprofil">
                <?php else: ?>
                    <img class="imageprofil" src="style/images/default_profile.png" alt="imageprofil"/>
                <?php endif ?>
            </div>

            <?php if($user_id === get_session('user_id')): ?>
                <a href="EditProfileController.php?id=<?= $user_id?>"><input class="Button" type="button"  value="Configurer le profil"></a>
            <?php elseif (!isFollowing($_GET['id'])): ?>
                <form  method="POST" action="follow.php?id=<?= $_GET['id']?>">
                    <input class="Button" type="submit" name="follow" value="Suivre">
                </form>
            <?php else: ?>
                <form  method="POST" action="follow.php?id=<?= $_GET['id']?>">
                    <input class="Button" type="submit" name="follow" value="Se désabonner">
                </form>
            <?php endif ?>
            <div class ="infoprofil">
                <div class="testaa">@<?= e($user->user_pseudo)?></div>
                <div class="testa"><?= e($user->user_name)?></div>
                    <div class="testa"><?= e($user->user_bio)?></div>
                    <div class="testa"> <a class="abo" href="ListeAboController.php?id=<?= $user_id?>"> <?= $user->follower_count?> abonnement(s) </a></div>
                    <div class="testa"> <a class="abo" href="ListeAboController.php?id=<?= $user_id?>"><?= $user->following_count?> abonné(s) </a></div>
            </div>

            <div class ="page_Tweet">
                <div class="titre_Tweet"><h3>TWEETS</h3></div>
                <?php if(count($tweets) != 0 && $user_id === get_session('user_id') || isFollowing($_GET['id'])): ?>
                    <?php foreach ($tweets as $tweet): ?>
                        <div class="Tweet" id="tweet<?= $tweet->tweet_id ?>">
                            <div class="pseudo"><a><?= e($tweet->user_pseudo) ?></a><a class="heure"><?= e($tweet->tweet_date) ?></a>
                            <?php if($tweet->tweet_user_id === get_session('user_id')): ?>
                                <a class="button_tweet1" onclick="return confirm('Etes vous sûr(e) de vouloir supprimer ce tweet ?')" href="delete.php?id=<?= $tweet->tweet_id ?>"><img class="iconprofil_tweet" src="style/images/trash.png" alt="delete"/></a>
                            <?php endif; ?>
                            </div>
                            <div class="contenu_tweet"> <?= e($tweet->tweet_content) ?> </div>
                            <div class="box_image">
                                <?php if(!empty($tweet->user_avatar)): ?>
                                    <img class="imageprofil_tweet" src="style/images/avatars/<?php echo $tweet->user_avatar; ?>" alt="imageprofil">
                                <?php else: ?>
                                    <img class="imageprofil_tweet" src="style/images/default_profile.png" alt="imageprofil"/>
                                <?php endif; ?>
                            </div>
                            <div class="bar_icon_tweet">
                                <?php if(has_already_retweeted($tweet->tweet_id)): ?>
                                    <a class="button_tweet" href="retweet.php?id=<?= $tweet->tweet_id ?>"><img class="iconprofil_tweet" src="style/images/retweeted.png" alt="retweet"/></a>
                                <?php else: ?>
                                    <a class="button_tweet" href="retweet.php?id=<?= $tweet->tweet_id ?>"><img class="iconprofil_tweet" src="style/images/retweet.png" alt="retweet"/></a>
                                <?php endif; ?>
                                <?= $tweet->retweet_count ?>

                                <?php if(has_already_liked($tweet->tweet_id)): ?>
                                    <a class="button_tweet" href="like.php?id=<?= $tweet->tweet_id ?>"><img class="iconprofil_tweet" src="style/images/liked.png" alt="like"/></a>
                                <?php else: ?>
                                    <a class="button_tweet" href="like.php?id=<?= $tweet->tweet_id ?>"><img class="iconprofil_tweet" src="style/images/like.png" alt="like"/></a>
                                <?php endif; ?>
                                <?= $tweet->tlike_count ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php elseif ($user_id !== get_session('user_id') && !isFollowing($_GET['id'])): ?>
                    <p class="error">Vous ne suivez pas cet utilisateur</p>
                <?php else: ?>
                    <p class="error">Cet utilisateur n'a encore rien posté</p>
                <?php endif; ?>
            </div>
        </div>

    </div>


 

    
   
</body>
</html>