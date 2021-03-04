
<main style="height:100%;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class='left-block'>
                    <h4>Mes Messages</h4>
                    <hr class="featurette-divider">
                    <p><a href="index.php?page=messages&type=recu">Recus</a>  <span class='total'>0</span></p>
                    <!-- <p><a href="index.php?page=messages&type=lu">Lu</a>   <span class='total'>0</span></p> -->
                    <p><a href="index.php?page=messages&type=envoyes">Envoyes</a>  <span class='total'>0</span></p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="right-block">
                    <div class="header">
                        <h3>BOITE DE RECEPTION</h3>
                    </div>

                    <?php
                        // on recupere les infos du user
                        $currentUser = get_user_data();
                        $myId = get_user_data()->id;
                        echo $myId;
                        
                        $received = get_my_received_messages($myId); //message recu par myId
                        $sent = get_sent_messages($myId); //tous les messages envoyes par myId

                        if(!empty($received)){  //!== null
                            if($_GET['type'] == 'recu'){
                        
                    ?>

                    <div class='right-block-content'>
                        <!-- content -->

                        <?php

                            foreach($received as $msg) {
                                $senderData = get_user_by_id($msg->senderId);
                        ?>

                        <a style="display:block;" data-toggle="collapse" href="#<?= $senderData->pseudo ?><?= $msg->id ?>lapse" role="button" aria-expanded="false" aria-controls="<?= $senderData->pseudo ?><?= $msg->id ?>lapse" >
                            <div id="user" class="mb-2 msg">
                                <img src="./assets/avatars/<?= $senderData->avatar;?>" style="width: 40px; height: 40px;">
                                <strong class='text-dark'><?= $senderData->pseudo;?></strong><br>
                                <span class='pl-5 text-dark'><?= substr(nl2br( $msg->message), 0,60); ?>...</span>
                                <strong class='text-dark'><?= date("d/m/Y à H:I",strtotime($msg->createdDate));?></strong><br>
                                <strong class='pl-5 text-dark'><?= $msg->senderPhone;?></strong><br>

                                <i style='float:rigth;' class="bi bi-caret-down text-danger"></i>
                            </div>
                        </a>

                        <div class="collapse mb-3" id="<?= $senderData->pseudo ?><?= $msg->id ?>lapse">
                            <div class="card card-body text-muted">
                                <p class="text-muted">
                                <?= nl2br( $msg->message); ?>
                                </p>
                                <!-- Traitement du formulaire de reponse -->
                                <?php


                                    if(isset($_POST["send".$msg->id])){
                                        $message =htmlspecialchars($_POST['message']);
                                        $phone = $currentUser->telephone;
                                        $object = "Negociation";
                                        $errors = [];

                                        if(empty($message)){
                                            $errors['vide'] = "Le message est vide!";
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
                                            $target_user_id = $senderData->id;
                                            $response = send_message($message,$target_user_id,$myId,$phone,$object);
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
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <input class='form-control' type="text" name="message">
                                        </div>
                                        <div class="col-md-4">
                                            <button class='btn btn-info' type="submit" name="send<?= $msg->id ?>" >Envoyer</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <?php } ?>
                        <!-- content -->

                    </div>

                    <?php
                        }else{
                    ?>

                            <div class='right-block-content'>
                            <!-- content -->
                            <?php
                            foreach($sent as $msg) {
                                $senderData = get_user_by_id($msg->senderId);
                            ?>
                            <a style="display:block;" data-toggle="collapse" href="#<?= $senderData->pseudo ?>lapse" role="button" aria-expanded="false" aria-controls="<?= $senderData->pseudo ?>lapse" >
                                <div id="user" class="mb-2 msg">
                                    <img src="./assets/avatars/<?= $senderData->avatar;?>" style="width: 40px; height: 40px;">
                                    <strong class='text-dark'><?= $senderData->pseudo;?></strong><br>
                                    <span class='pl-5 text-dark'><?= substr(nl2br( $msg->message), 0,60); ?>...</span>
                                    <strong class='text-dark'><?= date("d/m/Y à H:I",strtotime($msg->createdDate));?></strong><br>
                                    <strong class='pl-5 text-dark'><?= $msg->senderPhone;?></strong><br>

                                    <i style='float:rigth;' class="bi bi-caret-down text-danger"></i>
                                </div>
                            </a>
                            <div class="collapse mb-3" id="<?= $senderData->pseudo ?>lapse">
                                <div class="card card-body text-muted">
                                    <p class="text-muted">
                                    <?= nl2br( $msg->message); ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- content -->
                        </div>

                    <?php
                            }
                        }
                    ?>

                    <?php
                     
                     if(isset(get_my_received_messages($myId)[0]) === null ){   ?>
                        <div class='right-block-content'>
                            <p class="text-dark text-center">
                                Pas de messages <?= $_GET['type'] ?> disponible pour le moment
                            </p>
                            <p class='text-center back-btn'><i class="bi bi-chevron-left"></i><a class='back-btn text-center' href="index.php?page=home"> Retour à l'accueil</a></p>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</main>