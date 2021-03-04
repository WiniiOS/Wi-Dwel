<main>

    <?php
        $user = get_user_data();

        $curent_user_data = $user;
        $senderId = $curent_user_data->id;
        $my_name = $curent_user_data->fullName;
        $my_email = $curent_user_data->email;
        $target_user_id = $user->id;
        $default_msg = "Bonjour, je suis vivement intéressé(e) par cette annonce. Merci de me recontacter pour plus d'informations. Bien cordialement!";

    ?>

    <div class="page-header page-header-mini">
        <div class="container">
            <div class="mt-lg-5 text-left">
                <img alt="Avatar" src="./assets/avatars/<?= $user->avatar ?>" class="img-thumbnail" width="70" height="60" >
                <div class="media-footer">
                    <h3><b class='text-white'><?= $user->pseudo ?></b></h3>
                    <button id="userPhone" class="btn btn-sm btn-primary btn btn-secondary"><i class="bi bi-phone"></i><?= $user->telephone ?></button>
                    <a href="#contact" title="envoyer un message" class="btn btn-sm btn-success" id="userContact"><i class="bi bi-chat-dots"></i></a>
                    <a class="btn btn-sm btn-info" id="userProfile" href="#account/"><i class="bi bi-person"></i> <?= $user->email ?></a>
                </div>
            </div>
        </div>
    </div>
            
    <div class="container-fluid content">
        <div class="row">
            <div class="col-md-4">
                <div class='left-block'>
                    <h4>Rubriques de <span class='text-muted'><?= $user->pseudo ?></span></h4>
                    <hr class="featurette-divider">
                    <p><a href="#">Locations</a>  <span class='total'>0</span></p>
                    <p><a href="#">Ventes</a>   <span class='total'>0</span></p>
                </div>
                <!-- <div class='section-four four-left'>
                    <h6 class="text-dark">Contacter <?= $user->pseudo ?></h6>
                    <div class="row">
                        <div class="col-md-2">
                            <img class='img-thumbnail' src="./assets/avatars/<?= $user->avatar ?>" alt="avatar">
                        </div>
                        <div class="col-md-3">
                            <p><?= $user->pseudo ?> <br> <span class='text-muted date'>Membre depuis <?= date("d/m/Y à H:I",strtotime($user->signupDate)); ?></span> <br> 0 abonné | 0 abonnements</p>
                        </div>
                        
                        <div class="col-md-4">
                            <p><i class="bi bi-phone phone"></i></p>
                        </div>
                    </div>
                    <form action="" method="POST" >
                        <div class="form-group">
                            <input type="text" name='name' class="form-control" placeholder="Nom complet">
                        </div>
                        <div class="form-group">
                            <input type="email" name='email' class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="number" name='phone' class="form-control" placeholder="Télephone">
                        </div>
                        <div class="form-group">
                            <input type="text" name='objet' class="form-control" placeholder="Object">
                        </div>
                        <p class='last-note'>
                            Posez ici toutes vos questions!
                        </p>
                        <hr class='featurette-divider'>
                        <button class='telegram btn btn-danger'><i class="bi bi-envelope"></i> Envoyez</button>
                        
                    </form>
                </div> -->
            </div>
            <div class="col-md-8">
                <div class="right-block">
                    <div class="header">
                        <h3>Mini Description</h3>

                        
                        <p class='text-center m-3 text-muted'>
                        <?= $user->biographie ?>
                        </p>
                    </div>
                    <div class="header ">
                        
                        <p class='text-info text-left'><b class='text-dark'><?= $user->sex ?></b> : <?= $user->nom ?> <?= $user->prenom ?></p>
                        <hr class="featurette-divider">
                        <p class='text-info text-left'><b class='text-dark'>Ville:</b> <?= $user->city ?></p>
                        <hr class="featurette-divider">
                        <p class='text-info text-left'><b class='text-dark'>Adresse:</b> Anguissa</p>
                        <hr class="featurette-divider">
                        <p class='text-info text-left'><b class='text-dark'>Statut:</b> <?= $user->status ?></p>

                    </div>
                    <!-- contact  -->
                    <div class='section-four' id='contact'>
                        <h6 class="text-dark">Contacter <?= $user->pseudo ?></h6>
                        <div class="row mt-lg-5">
                            <div class="col-md-4">
                                <img class='p-1 img-thumbnail'  width="60" height="60" src="./assets/avatars/<?= $user->avatar ?>" alt="avatar">
                            </div>
                            <div class="col-md-4">
                                <p><?= $user->pseudo ?> <?= $user->fullName ?> <br> <span class='text-muted date'>Membre depuis <?= date("d/m/Y à H:I",strtotime($user->signupDate)); ?></span> <br> 0 abonné | 0 abonnements</p>
                            </div>
                            
                            <div class="col-md-4">
                                <p><i class="bi bi-phone phone"></i></p>
                            </div>
                        </div>

                        <?php

                            if(isset($_POST['send'])){

                                    $phone = htmlspecialchars(trim($_POST['phone']));
                                    $object = htmlspecialchars(trim($_POST['object']));
                                    $errors = [];
        
                                    if(empty($phone) || empty($object)){
                                        $errors['vide'] = "Veuillez renseigner votre numero de telephone et l'objet du message!";
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
                                                    <?= "Votre message a été envoyé avec success!"; ?>
                                                </div>
                                            </div>
                                        <?php
                                        }else{
        
                                            ?>
                                                <div class="card red">
                                                    <div class="card-content p-2 text-danger">
                                                        <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                                        <?= "Une erreur est survenue lors de l'envoi du message!"; ?>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
        
                                

                            }
                        ?>
                        <form  action="" method="POST" >
                            <div class="form-group">
                                <input disabled type="text" name='name' value='<?= $user->nom ?>' class="form-control" placeholder="Nom complet">
                            </div>
                            <div class="form-group">
                                <input disabled type="email" value='<?= $user->email ?>'' name='email' class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="number" name='phone' class="form-control" placeholder="Télephone">
                            </div>
                            <div class="form-group">
                                <input type="text" name='object' class="form-control" placeholder="Object">
                            </div>
                            <p class='last-note'>
                                Posez ici toutes vos questions!
                            </p>
                            <hr class='featurette-divider'>
                            <button name='send' class='telegram btn btn-danger'><i class="bi bi-envelope"></i> Envoyez</button>
                            
                        </form>
                    </div>

                    <!-- fin contact -->
                    <!-- start newsletters user -->
                    <!-- <div class="section-five">
                        <h4 class="text-dark text-center">Restez à l'écoute des dernières nouveautés !</h4>
                        <p class='text-muted text-center'>Abonnez vous à la newsletter de <span class='text-dark'><?= $user->pseudo ?></span> afin d'etre averti de ses activités</p>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="comment" class="form-control" placeholder="Entrez votre adresse E-mail">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="subscribe btn btn-subscribe">S'abonner</button>
                                </div>
                            </div>
                            
                            <hr class="featurette-divider">
                            <p class='last-text text-dark'>Nous ne partagerons pas vos informations avec une tier personne.</p>
                        </form>
                    </div> -->
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</main>