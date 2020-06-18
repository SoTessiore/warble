<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>Recherche / Warble</title>
    <link rel="stylesheet" href="style/ListeAboStyle.css">
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
                    
                    </div>
                </div>
                    <div class="col2">
                        
                            <div class="titre_Tweet"><h3>Vos Abonnement(s)</h3> </div>
                            <?php if(count($followings) != 0): ?>
                                <?php foreach($followings as $user): ?>
                                    <div class="Tweet">
                                        <div class="pseudo"><a href="ProfileController.php?id=<?= $user->user_id ?>"><?=e($user->user_pseudo)?></a></div>
                                        <div class="contenu_tweet"> 
                                            <a class="bio"><?= e($user->user_bio) ?></a>
                                            <div class="box_image">
                                            <?php if(!empty($user->user_avatar)): ?>
                                                <img class="imageprofil_tweet" src="style/images/avatars/<?php echo $user->user_avatar; ?>" alt="imageprofil">
                                            <?php else: ?>
                                                <img class="imageprofil_tweet" src="style/images/default_profile.png" alt="imageprofil"/>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="error">Vous n'avez aucun abonnement</p>
                            <?php endif; ?>
                        
                        <div class="titre_Tweet"><h3>Vos Abonné(s)</h3> </div>
                        <?php if(count($followers) != 0): ?>
                            <?php foreach($followers as $user): ?>
                                <div class="Tweet">
                                    <div class="pseudo"><a href="ProfileController.php?id=<?= $user->user_id ?>"><?=e($user->user_pseudo)?></a></div>
                                    <div class="contenu_tweet"> 
                                        <a class="bio"><?= e($user->user_bio) ?></a>
                                        <div class="box_image">
                                        <?php if(!empty($user->user_avatar)): ?>
                                            <img class="imageprofil_tweet" src="style/images/avatars/<?php echo $user->user_avatar; ?>" alt="imageprofil">
                                        <?php else: ?>
                                            <img class="imageprofil_tweet" src="style/images/default_profile.png" alt="imageprofil"/>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="error">Vous n'avez aucun abonné</p>
                        <?php endif; ?>

                    </div>
                    
            </div>


 

    
   
</body>
</html>