<?php
    // on redirige le user s'il n'est pas authentifié
    if(!isset($_SESSION['auth'])){
    ?>
    <script> window.location.href='index.php?page=login'; </script>
    <?php
    }


    global $post;
    $post = get_one_post();
	#au cas ou on met un id d'article qui n'existe pas
	if ($post == false) {
		header("Location:index.php?page=error");
	}else{
?>
<main role='main'>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-8">
                <p>
                    <a class="back" href="index.php?page=home" role="button"><span class='text-left back text-danger'><i class="bi bi-chevron-left"></i> Retour à vos annonces</span></a>
                </p>
                <div class="container-fluid myCarousel">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">

                        <?php
                        
                        // Gestion des images
                        $montableau = returnTab($post->images);
                        $nbre1 = count($montableau) - 1;
                        $endTableau = [];
                        for($i=0; $i <= $nbre1;$i++){
                        
                            $value = $montableau[$i];
                            $item = substr($value,1,-1);
                            array_push($endTableau, $item);
                        }
                        if($nbre1 == 0){
                            echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
                        }
                        if($nbre1 == 1){
                            echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                                  <li data-target='#myCarousel' data-slide-to='1'></li>";
                        }
                        
                        if($nbre1 == 2){
                            echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                            <li data-target='#myCarousel' data-slide-to='1'></li>
                            <li data-target='#myCarousel' data-slide-to='2'></li>";                        }
                        if($nbre1 == 3){
                            "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                            <li data-target='#myCarousel' data-slide-to='1'></li>
                            <li data-target='#myCarousel' data-slide-to='2'></li>
                            <li data-target='#myCarousel' data-slide-to='3'></li>";                        }
                     
                        ?>
                            
                        </ol>
                        <div class="carousel-inner">
                            
                            <?php 
                                if($nbre1 == 0){
                                    echo "<div class='carousel-item active'>
                                            <img class='first-slide' src='./assets/annonces/".$endTableau[0]."' alt='Second slide'>
                                          </div>";
                                }
                                if($nbre1 == 1){
                                    echo "
                                        <div class='carousel-item active'>
                                            <img class='first-slide' src='./assets/annonces/".$endTableau[0]."' alt='Second slide'>
                                        </div>
                                        <div class='carousel-item carousel-item-next carousel-item-left'>
                                            <img class='second-slide' src='./assets/annonces/".$endTableau[1]."' alt='Second slide'>
                                        </div>";
                                }
                                if($nbre1 == 2){
                                    echo "
                                        <div class='carousel-item active'>
                                            <img class='first-slide' src='./assets/annonces/".$endTableau[0]."' alt='Second slide'>
                                        </div>
                                        <div class='carousel-item carousel-item-next carousel-item-left'>
                                            <img class='second-slide' src='./assets/annonces/".$endTableau[1]."' alt='Second slide'>
                                        </div>
                                        
                                        <div class='carousel-item carousel-item-left'>
                                        <img class='third-slide' src='./assets/annonces/".$endTableau[2]."' alt='Second slide'>
                                    </div>";
                                }
                                if($nbre1 == 3){
                                    echo "
                                        <div class='carousel-item active'>
                                            <img class='first-slide' src='./assets/annonces/".$endTableau[0]."' alt='Second slide'>
                                        </div>
                                        <div class='carousel-item carousel-item-next carousel-item-left'>
                                            <img class='second-slide' src='./assets/annonces/".$endTableau[1]."' alt='Second slide'>
                                        </div>
                                        
                                        <div class='carousel-item carousel-item-next carousel-item-left'>
                                            <img class='third-slide' src='./assets/annonces/".$endTableau[2]."' alt='third slide'>
                                        </div>
                                        <div class='carousel-item carousel-item-next carousel-item-left'>
                                            <img class='four-slide' src='./assets/annonces/".$endTableau[3]."' alt='fourth slide'>
                                        </div>
                                        ";
                                }
                            
                            ?>
                            


                            <!-- boutons next et back -->
                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>


                <p class='first-details'>
                    <span class='text-left text-danger'><?= strtoupper($post->type);  ?></span><span class='text-center text-dark'><?= $post->qtePieces ?> P.<?= $post->qteChambres ?> CH.<?= $post->surface ?> M2</span>
                    <span class='text-right text-danger'><?= number_format($post->prix, 2, ',', ' '); ?> FCFA / <?= strtoupper($post->periode) ?></span>
                    <span id="<?= $post->id ?>" class='like-section'><i title='favoris' id="<?= get_user_data()->id ?>" class="bi bi-heart"></i> <?= _("J'aime") ?> </span>
                </p>
                <div class="section-two" id="<?= $post->posterId ?>" >
                    <h4><?= $post->qtePieces ?> <?= _('PIECES'); ?> - <?= $post->qteChambres ?> <?= _("CHAMBRE") ?> - <?= $post->surface ?> M2</h4>
                    
                   
                    <h5> 
                    
                    <?php
                        // Gestion des avantages

                        $mytab = returnTab($post->advantages);
                        $nbre = count($mytab) - 1;
                        $endTab = [];
                        for($i=0; $i <= $nbre;$i++){
                        
                            $value = $mytab[$i];
                            $item = substr($value,1,-1);
                            array_push($endTab, $item);
                            // $endTab[$i] = $item;
                        }
                        if($nbre == 0){
                            echo $endTab[0];
                        }
                        if($nbre == 1){
                            echo $endTab[0]." - ".$endTab[1];
                        }
                        
                        if($nbre == 2){
                            echo $endTab[0]." - ".$endTab[1]." - ".$endTab[2];
                        }
                        if($nbre == 3){
                            echo $endTab[0]." - ".$endTab[1]." - ".$endTab[2]." - ".$endTab[3];
                        }
                     
                     ?>  
                     </h5>

                    <p class='default-desc'>
                        <span class='text-muted'> <?= _("À propos de"); ?> </span> <?= _("cet(te)") ?> <?= $post->type ?> <?= $post->qtePieces ?> pieces à <?= $post->ville ?> - <?= $post->quartier ?>
                    </p>
                    <p class='desc'>
                        <?= $post->description ?>
                    </p>
                </div>
                <div class="section-three">
                    <section class='row'>
                        <div class="col-md-6">
                            <h5> <?= _('Ce studio revient à') ?> </h5>
                            <p class='text-danger'><?= number_format($post->prix + $post->caution, 2, ',', ' '); ?> FCFA / <?= $post->periode ?></p>
                        </div>
                        <div class="col-md-6 right-side">
                            <h5> <?= _('Informations supplémentaires') ?> </h5>
                            <p> <?= _("Caution") ?>: <span class='text-success'><?= number_format($post->caution, 2, ',', ' '); ?> FCFA</span> </p>
                        </div>
                    </section>
                </div>

                <div class='section-four'>
                    <h6 class="text-dark"> <?= _("Contacter l'agence") ?> </h6>
                    <div class="row" id="<?= $post->posterId ?>">
                        <div class="col-md-2">
                            <img class="img-thumbnail" width="60" height="60" src="./assets/avatars/<?= get_user_by_id($post->posterId)->avatar  ?>" alt="">
                        </div>
                        <div class="col-md-3">
                            <p><?= $post->posterName ?> <br> <span class='text-muted date'><?php setlocale(LC_TIME, "fr_FR","French"); echo utf8_encode(strftime("%d %B %Y", strtotime($post->timePost))); ?></span> <br> 0 abonné</p>
                        </div>
                    </div>
                    <p class='note'> <?= _("Consulter le profil de l'utilisateur") ?> </p>
                    <hr class='featurette-divider'>
                    <p class='visit'> <?= _("Envie de visiter ? Une question sur ce local ?") ?> </p>
                    <hr class='featurette-divider'>
                    
                    <?php

                            $curent_user_data = get_user_data();
                            $senderId = $curent_user_data->id;
                            $my_name = $curent_user_data->fullName;
                            $my_email = $curent_user_data->email;
                            $target_user_id = $post->posterId;
                            $default_msg = _("Bonjour, je suis vivement intéressé(e) par cette annonce. Merci de me recontacter pour plus d'informations. Bien cordialement!");

                            if(isset($_POST['message'])){
                                $phone = htmlspecialchars(trim($_POST['phone']));
                                $object = htmlspecialchars(trim($_POST['object']));
                                $errors = [];

                                if(empty($phone) || empty($object)){
                                    $errors['vide'] = _("Veuillez renseigner votre numero de telephone et l'objet du message!");
                                }

                                // affichons les erreurs captees
                                if (!empty($errors)) {
                                    ?>
                                        <div class="card red">
                                            <div class="card-content text-danger p-2">
                                                <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                                <?php
                                                foreach($errors as $error){
                                                    echo $error."<br/>" ;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php

                                }else{ 
                                    
                                    $response = send_message($default_msg,$target_user_id,$senderId,$phone,$object);
                                    if($response == true){

                                    ?>
                                        <div class="card red">
                                            <div class="card-content p-2 text-success">
                                                <i style="color:green;" class="bi bi-check-square-fill"></i> 
                                                <?= _("Message envoyé avec success!"); ?>
                                            </div>
                                        </div>
                                    <?php
                                    }else{

                                        ?>
                                            <div class="card red">
                                                <div class="card-content p-2 text-danger">
                                                    <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                                    <?= _("Une erreur est survenue lors de l'envoi du message!"); ?>
                                                </div>
                                            </div>
                                        <?php
                                    }

                                }

                            }


                    ?>

                    <form action="" method="POST" >
                        

                        <div class="form-group">
                            <input disabled type="text"  name='name' class="form-control" value="<?= $my_name; ?>"  placeholder="<?= $my_name; ?>">
                        </div>
                        <div class="form-group">
                            <input disabled type="email"  name='email' class="form-control" placeholder="<?= $my_email; ?>" value="<?= $my_email; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" required name='phone' class="form-control" placeholder= <?= _("Telephone sans indicatif") ?> : 658 654 322">
                        </div>
                        <div class="form-group">
                            <input type="text" required name='object' class="form-control" placeholder="Object">
                        </div>
                        <p class='last-note'>
                            <?= _("Bonjour, je suis vivement intéressé(e) par cette annonce. Merci de me recontacter pour plus d'informations.
                            Bien cordialement") ?>
                        </p>
                        <hr class='featurette-divider'>
                        <button type="submit" name="message" class='telegram btn btn-danger'><i class="bi bi-telegram"></i> <?= _('Contacter') ?> </button>
                        <p class='last-note'>
                            <?= _("Vos informations sont traitées avec sécurité et transmises au professionnel de l’annonce que vous souhaitez contacter afin de
                            gérer votre demande. Pour exercer vos droits conformément à la loi « Informatique et Libertés »,") ?> <a href="#details"><?= _('cliquez ici'); ?> </a> .
                        </p>
                    </form>
                    
                </div>

                <div class="section-five">

                    <h4 class="text-dark text-left"><?= _('Laissez un Commentaire!') ?> </h4>
                    
                    <?php
                        // Gestion des commentaires
                        if(isset($_POST['avis'])){
                            $comment = htmlspecialchars(trim($_POST['comment']));
                            $errors = [];

                            if (empty($comment)) {
                                $errors['vide'] = "Vous n'avez laissé aucun avis";
                            }

                            // affichons les erreurs captees
                            if (!empty($errors)) {
                                ?>
                                    <div class="card red">
                                        <div class="card-content text-danger p-2">
                                            <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                            <?php
                                            foreach($errors as $error){
                                                echo $error."<br/>" ;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php

                            }else{   

                                $response = send_comment($comment);
                                if($response == true){

                                ?>
                                    <div class="card red">
                                        <div class="card-content p-2 text-success">
                                            <i style="color:green;" class="bi bi-check-square-fill"></i> 
                                            <?= "Commentaire ajouté avec success!"; ?>
                                        </div>
                                    </div>
                                <?php
                                }else{

                                    ?>
                                        <div class="card red">
                                            <div class="card-content p-2 text-danger">
                                                <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                                <?= _("Une erreur est survenue lors de l'ajout du commentaire!"); ?>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }

                        }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" name="comment" class="form-control" required placeholder="<?= _('Laissez votre avis ou un commentaire') ?>">
                        </div>
                        <hr class="featurette-divider">
                        <div class="buttons">
                            <button type="submit" name="avis" onclick="handleComment(e);" class="comment btn btn-comment"> <?= _("COMMENTER") ?> </button>
                        </div>
                    </form>

                    <section id="show-avis-notes-per-user" class='my-3 p-3 bg-body rounded shadow-sm'>
                        <h4 class="border-bottom text-dark text-left pb-2 mb-0"><?= _('Derniers commentaires') ?>!</h4>
                        <?php 
                            $comments = get_comments($post->id);
                            if (!empty($comments)) {
                                
                                foreach($comments as $comment) {
                                $author = get_user_by_id($comment->posterId);
                        ?>
                
                        <div class="d-flex pt-3 avis-block">
                            
                            <img class="bd-placeholder-img flex-shrink-0 me-2 rounded mr-2" width="50" height="50" src="assets/avatars/<?= $author->avatar ?>" alt="pseudo">
                            <p class="pb-3 mb-0 small lh-sm border-bottom text-muted text-left">
                                <strong class="d-block text-left mb-1 text-muted"><?= $author->pseudo ?></strong>
                                <?= $comment->comment ?>
                            </p>
                        </div>

                        <?php
                                }
                            }else{
                                ?>
                                    <p class="pb-3 mb-0 small lh-sm border-bottom text-muted text-left">
                                        <?= _("Aucun commentaire n'a encore été laissé sur ce bien!"); ?>
                                    </p>
                                <?php
                            }
                        ?>

                    </section>

                </div>

                

            </div>
            <!-- 2ND SIDE -->
            <div class="col-md-4 col-sm-12">

                <div class="container">
                    <p class='post-container'>
                        <button onclick="window.location.href='index.php?page=post';" class='btn post pl-2 pr-3'><i class="bi bi-plus"></i> <?= _("Poster votre bien en location") ?></button>
                    </p>
                    <div class="container right-details">
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <img class='img-thumbnail' src="./assets/avatars/<?= get_user_by_id($post->posterId)->avatar  ?>" alt="user">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <p><?= $post->posterName ?> <br> <span class='text-muted date'>Le <?php setlocale(LC_TIME, "fr_FR","French"); echo utf8_encode(strftime("%d %B %Y", strtotime($post->timePost))); ?></span> <br> <!-- 0 abonné --></p> 
                            </div>
                            <div class="col-md-4 col-sm-6 ">
                                <button data-follower="<?= get_user_data()->id ?>"  id="<?= $post->posterId ?>" class='btn follow second'>Suivre</button>
                            </div>
                            <div class='container'>
                                <button type="button" class="btn btn-outline-success"><i class="my-contact bi bi-phone"></i><?= $post->userPhone ?></button>
                            </div>
                            <hr class='featurette-divider'>
                            <p class='text-center'> <?= _("Contacter") ?> <span class='text-muted'><?= $post->posterName ?></span> <?= _("pour ce bien!") ?> </p>
                            
                            <?php

                                if(isset($_POST['xender'])){

                                        $phone = htmlspecialchars(trim($_POST['phone']));
                                        $object = htmlspecialchars(trim($_POST['object']));
                                        $errors = [];
            
                                        if(empty($phone) || empty($object)){
                                            $errors['vide'] = _("Veuillez renseigner votre numero de telephone et l'objet du message!");
                                        }
            
                                        // affichons les erreurs captees
                                        if (!empty($errors)) {
                                            ?>
                                                <div class="card red">
                                                    <div class="card-content text-danger p-2">
                                                        <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                                        <?php
                                                        foreach($errors as $error){
                                                            echo $error."<br/>" ;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
            
                                        }else{ 
                                            
                                            $response = send_message($default_msg,$target_user_id,$senderId,$phone,$object);
                                            if($response == true){
            
                                            ?>
                                                <div class="card red">
                                                    <div class="card-content p-2 text-success">
                                                        <i style="color:green;" class="bi bi-check-square-fill"></i> 
                                                        <?= _("Votre message a été envoyé avec success!"); ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }else{
            
                                                ?>
                                                    <div class="card red">
                                                        <div class="card-content p-2 text-danger">
                                                            <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                                            <?= _("Une erreur est survenue lors de l'envoi du message!"); ?>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
            
                                    

                                }
                            ?>

                            <div >
                                <form action="" method="POST" >
                                    <div class="form-group">
                                        <input disabled type="text" name='name' value="<?= $my_name; ?>" class="form-control" placeholder="<?= $my_name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input disabled type="email" value="<?= $my_email; ?>" name='email' class="form-control" placeholder="<?= $my_email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input  type="number"  name='phone' required class="form-control" placeholder="Telephone sans indicatif : 658 654 322">
                                    </div>
                                    <div class="form-group">
                                        <input required type="text" name='object' class="form-control" placeholder="Object">
                                    </div>
                                    <p class='last-note'>
                                        <?= _('Bonjour, je suis vivement intéressé(e) par cette annonce. Merci de me recontacter pour plus d\'informations.
                                        Bien cordialement') ?>
                                    </p>
                                    <hr class='featurette-divider'>
                                    <button type="submit" name="xender" class='telegram-right btn btn-danger'><i class="bi bi-telegram"></i> <?= _("Contacter") ?> </button>
                                    <p class='last-note'>
                                        <?= _('Vos informations sont traitées avec sécurité et transmises au professionnel de l’annonce que vous souhaitez contacter afin de
                                        gérer votre demande. Pour exercer vos droits conformément à la loi « Informatique et Libertés »,<a href="#details">cliquez ici') ?> </a> .
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- --------------------------- -->

            
        </div>
    </div>

    <!-- LAST PART FOR RECOMMANDATIONS SECTION -->

    <div class="container">
        <?php
            $similars = get_recommended_posts($post->type);

            if (!empty($similars)) {
                
        ?>
        <div class="right-block zones">
            <h4 class='recommended text-center text-dark'><?= _('Annonces similaires') ?> </h4>
            <div class="row justify-content-center">
                <?php 
                foreach($similars as $item) {
                ?>
                <a style="display:block;text-decoration:none;" href="index.php?page=details&id=<?= $item->id ?>">
                    <div class="col-md-4 mb-4">
                        <div class="card" style="background-image:url('') !important; width: 18rem;">
                            <img style="max-height:200px;" class="card-img-top" src="./assets/annonces/<?= get_value_by_index($item->images,0) ?>" alt="cap">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?= $item->title ?></h5>
                                <p class='text-dark'><?= number_format($item->prix, 2, ',', ' '); ?> FCFA</p>
                                <p class="card-text text-dark">
                                    <?= substr(nl2br($item->description), 0,100); ?>...
                                </p>
                            </div>
                        </div>
                    </div> 
                </a> 
                <?php
                }
                ?>

            </div>
        </div>
        <?php
            }
        ?>

    </div>

</main>

<?php
	}
?>