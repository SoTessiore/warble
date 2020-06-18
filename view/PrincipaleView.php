<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accueil / Warble</title>
        <link rel="stylesheet" href="style/PrincipaleStyle.css">
        <link rel="shortcut icon" href="style/images/twitter3.png" type="image/x-icon">
    </head>

    <body>
        <div class="mainbody">
            <div class="box">
                    <a href="ResearchController.php"><input class="Button_recherche"  type="button"  value="Recherche"></a>
                </div>
                
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
                <h2>Accueil</h2>
                <form  method="POST" action="tweet.php">
                    <textarea name="tweet_content" id="comments"  class="input-field" placeholder="Quoi de neuf ?" cols="57" rows="5" maxlength="140"></textarea>
                    <input class="Button" type="submit" value="Tweeter" name="tweet">
                    <div class="place_button"></div>
                </form>

                <div class ="page_Tweet">
                    <div class="titre_Tweet"><h3>TWEETS</h3> </div>
                    <?php if(count($tweets) != 0): ?>
                        <?php foreach ($tweets as $tweet): ?>
                        <div class="Tweet" id="tweet<?= $tweet->tweet_id ?>">
                            <div class="pseudo"><a><?= e($tweet->user_pseudo) ?></a><a class="heure"><?= e($tweet->tweet_date) ?></a>
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
                                    <a class="button_tweet" href="retweet.php?id=<?= e($tweet->tweet_id) ?>"><img class="iconprofil_tweet" src="style/images/retweeted.png" alt="retweet"/></a>
                                <?php else: ?>
                                    <a class="button_tweet" href="retweet.php?id=<?= e($tweet->tweet_id) ?>"><img class="iconprofil_tweet" src="style/images/retweet.png" alt="retweet"/></a>
                                <?php endif; ?>
                                <?= $tweet->retweet_count ?>

                                <?php if(has_already_liked($tweet->tweet_id)): ?>
                                    <a class="button_tweet" href="like.php?id=<?= e($tweet->tweet_id) ?>"><img class="iconprofil_tweet" src="style/images/liked.png" alt="like"/></a>
                                <?php else: ?>
                                    <a class="button_tweet" href="like.php?id=<?= e($tweet->tweet_id) ?>"><img class="iconprofil_tweet" src="style/images/like.png" alt="like"/></a>
                                <?php endif; ?>
                                <?= $tweet->tlike_count ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <?php else: ?>
                        <p class="error">Aucune activité pour le moment</p>
                    <?php endif; ?>

                </div>
                </div>
            </div>
        </div>
    </body>
</html>