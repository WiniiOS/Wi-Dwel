<?php

$user = get_user_data();



?>
<main style='height:100%;'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="left-block">
                    <h4 class='text-dark'>Modifier mon profil</h4>
                    <hr class="featurette-divider">
                    <p><a href="index.php?page=edit&type=perso" class='text-muted' ><i class='bi bi-person'></i> Mes Informations Personnelles</a></p>
                    <p><a href="index.php?page=edit&type=coord" class='text-muted' ><i class='bi bi-briefcase'></i> Mes Coordonnées</a></p>
                    <!--<p><a href="index.php?page=edit&type=pwd" class='text-muted'   ><i class='bi bi-key'></i> Changer mon mot de passe</a></p> -->
                </div>
            </div>
            <div class="col-md-8">

                <div class="right-block">

                    <?php
                        $type = $_GET['type'];
                        if( $type == 'perso' ){
                    ?>



                    <div class="user-img">
                        <img src="./assets/avatars/<?= $user->avatar ?>" class='img-thumbnail'  width="60" height="60" alt="avatar"><span class='text-dark name'> <?= $user->pseudo ?> <br> <span class='text-muted' style="font-size:0.6em;margin-left:11%;">Membre depuis <?= date("d/m/Y à H:I",strtotime($user->signupDate)) ?></span></span>
                    </div>
                    <hr class="featurette-divider">
                    
                    <!--  #gestion du formulaire  -->
                    <?php

                    if(isset($_POST['perso'])){

                        if(isset($_POST['status'])){
                            $status = htmlspecialchars(trim($_POST['status']));
                        }

                        $sex= htmlspecialchars(trim($_POST['sex']));
                        $name = htmlspecialchars(trim($_POST['name']));
                        $prenom = htmlspecialchars(trim($_POST['prenom']));
                        $pseudo = htmlspecialchars(trim($_POST['pseudo']));
                        $email = htmlspecialchars(trim($_POST['email']));
                        $telephone = htmlspecialchars(trim($_POST['telephone']));

                        $errors = [];

                        // Si l'un de ces champs obligatoires est vide on enregistre une erreur
                        if (empty($sex) || empty($name) || empty($prenom) || empty($pseudo) ||
                            empty($email) || empty($telephone) || empty($status)) {
                            $errors["empty"] = " Tous les champs étoilés doivent etre remplis !";
                        } 

                        #si le fichier image n'est pas vide,je recupere son nom
                        if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']) ){

                            $taille_maxi = 3000000; // 3 Mo taille maxi
                            //Taille du fichier
                            $taille = filesize($_FILES['avatar']['tmp_name']);
                            // extensions autorisees
                            $extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG','.GIF','.JPEG','.JPG');
                            // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                            $extension = strrchr($_FILES['avatar']['name'], '.'); 
                            //Début des vérifications de sécurité...
                            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                            {
                                $errors['avatar'] = "Cette image n'est pas valide";
                            }

                            if($taille>$taille_maxi){
                                $errors['taille'] = "La taille de fichier doit etre inferieure a 3 Mo...";
                            }
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

                            $currentUserId = get_user_data()->id;
                            //S'il n'y a pas d'erreur, on commence les enregistrement puis upload
                            edit_perso($status,$sex,$name,$prenom,$pseudo,$email,$telephone,$currentUserId);
                            // En fin on update et upload nos images

                            //On formate le nom du fichier ici...
                            $fichier = basename($_FILES['avatar']['name']);
                            // On remplace les caractères accentues du nom original du fichier par des caracteres sans accent
                            $fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                            // on traite le nom du fichier
                            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                            $dossier = 'assets/avatars/';

                            // ajouter l'image en base de donnee puis retourne l'id du post
                            post_avatar($fichier,$currentUserId);

                            //Si la fonction move_uploaded_file renvoie TRUE, c'est que ça a fonctionné...
                            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier.$currentUserId.$fichier)) {

                            ?>
                                <div class="card red">
                                    <div class="card-content p-2 text-success">
                                        <i style="color:green;" class="bi bi-check-square-fill"></i> 
                                        <?= " VOTRE ANNONCE A ETE POSTÉ AVEC SUCCESS !"; ?>
                                    </div>
                                </div>
                            <?php

                            } else { //Sinon (la fonction renvoie FALSE).
                            ?>
                                <div class="card red">
                                    <div class="card-content p-2 text-danger">
                                        <i style="color:red;" class="bi bi-exclamation-triangle-fill"></i> 
                                        <?= "Echec de l'upload !"; ?>
                                    </div>
                                </div>
                            <?php
                            }

                        }

                        
                    }
                    ?>

                    <form action="" method="POST" enctype="multipart/form-data" >
                        
                        <div class='status'>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="sta1" value="locataire">
                                <label class="form-check-label" for="sta1">Locataire</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="sta2" value="bailleur">
                                <label class="form-check-label" for="sta2">Bailleur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="sta3" value="agent-immobilier">
                                <label class="form-check-label" for="sta3">Agent immobilier</label>
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sex" class="text-dark">Sex <span class='star'>*</span></label>
                                    <select name="sex" class="form-control" id="sex">
                                        <option value='Mr' class='text-dark'>Mr</option>
                                        <option value='Mme' class='text-dark'>Mme</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="nom" class="text-dark">Nom <span class='star'>*</span></label>
                                    <input name="name" type="text" class="form-control" id="nom" placeholder="Votre nom">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prenom" class="text-dark">Prénom <span class='star'>*</span></label>
                                    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="votre prenom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pseudo" class="text-dark">Pseudo <span class='star'>*</span></label>
                                    <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="votre pseudo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="text-dark">Email <span class='star'>*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="votre email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone" class="text-dark">Telephone <span class='star'>*</span></label>
                                    <input name='telephone' type="text" class="form-control" id="telephone" placeholder="Numero de telephone">
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role" class="text-dark">Pourquoi êtes-vous sur Wi-Dwel ?</label>
                                    <select name="role" class="form-control" id="sex">
                                        <option value='pro' class='text-dark'>Je souhaite louer</option>
                                        <option value='louer' class='text-dark'>Je suis un professionel</option>
                                        <option value='louer' class='text-dark'>Autres</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <hr class="featurette-divider">
                        <div class="row">
                            <div style="border:4px dotted gray;" class="p-3 col-md-12">
                                <h5 class='text-center text-dark'>Ma photo de profil <span class='star'>*</span></h5>
                                <div class="form-group form-avatar">
                                    <input name='avatar' type="file" class="form-control-file">
                                </div>
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <div class="buttons">
                            <button name="perso" type="submit" class="btn btn-widwel"><i class="bi bi-check"></i> Enregistrer</button>
                        </div>
                    </form>

                    <?php } ?>

                    <!-- start section 2 -->

                    <?php
                        if( $type == 'coord' ){
                    ?>

                    <div class="user-img">
                        <img src="./assets/avatars/<?= $user->avatar ?>" class='img-thumbnail'  width="60" height="60" alt="avatar"><span class='text-dark name'><?= $user->pseudo; ?> <br> <span class='text-muted' style="font-size:0.6em;margin-left:11%;">
                        Membre depuis <?= date("d/m/Y à H:I",strtotime($user->signupDate)) ?>
                        </span></span>
                    </div>
                    <hr class="featurette-divider">

                    <?php
                    // Traitement du formulaire de coordonnees
                    if(isset($_POST['coord'])){
                        $adresse = htmlspecialchars(trim($_POST['adresse']));
                        $site = htmlspecialchars(trim($_POST['site']));
                        $city = htmlspecialchars(trim($_POST['city']));
                        $biographie = htmlspecialchars(trim($_POST['biographie']));

                        $errors = [];

                        if (empty($adresse) || empty($site) || empty($city) || empty($biographie)) {
                            $errors['empty'] = "veuillez remplir tous les champs!";
                        }

                        #s'il ya des erreurs
                        if (!empty($errors)) {
                            ?>
                                <div class="card red">
                                    <div class="card-content text-danger">
                                        <?php                   
                                            foreach($errors as $error){
                                                echo $error."<br/>";
                                            }
                                        ?>
                                    </div>
                                </div>

                            <?php
                        }else{
                            #inserer les differentes modifications
                            edit_coord($adresse,$site,$city,$biographie,$user->id);
                            #redirection impossible en php car on a deja affiche de contenu(meme s'il est preferable un redirect
                            #cote serveur),on le fait ici en js
                            ?>
                            <!-- code js -->
                            <script>
                                window.location.replace("index.php?page=profil");
                            </script>
                            <!-- fin de redirection -->
                            <?php
                        }

                    }

                    ?>

                    <form action="" method="POST" >
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adresse" class="text-dark">Adresse de résidence</label>
                                    <input type="text" name="adresse" class="form-control" id="adresse" placeholder="Entrez votre adresse de résidence">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site" class="text-dark">Site Internet</label>
                                    <input name="site" type="text" class="form-control" id="site" placeholder="https://www.wi-dwel.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="text-dark">Votre ville</label>
                                    <select name='city' class="form-control" id="city">
                                        <option value='douala' class='text-dark'>Douala</option>
                                        <option value='yaounde' class='text-dark'>Yaoundé</option>
                                        <option value='kribi' class='text-dark'>Kribi</option>
                                        <option value='bertoua' class='text-dark'>Bertoua</option>
                                        <option value='edea' class='text-dark'>Edéa</option>
                                        <option value='limbe' class='text-dark'>Limbé</option>
                                        <option value='bafoussam' class='text-dark'>Bafoussam</option>
                                        <option value='bamenda' class='text-dark'>Bamenda</option>
                                        <option value='dschang' class='text-dark'>Dschang</option>
                                        <option value='garoua' class='text-dark'>Garoua</option>
                                        <option value='ngaoundere' class='text-dark'>Ngaoundéré</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="text-dark">Biographie <span class='star'>*</span></label>
                                    <textarea name='biographie' class="form-control" placeholder='Mini description de vous...' id="description" rows="3"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        
                        <hr class="featurette-divider">
                        <div class="buttons">
                            <button type="submit" name="coord" class="btn btn-widwel"><i class="bi bi-check"></i> Enregistrer</button>
                        </div>
                    </form>

                    <?php } ?>
                    <!-- end section 2 -->

                    <!-- star session password -->
                    <?php
                        if( $type == 'pwd' ){
                    ?>

                    <!--<div class="user-img">
                        <img src="./assets/avatars/user.png" style="height: 50px; width: 90px;" alt="franck"><span class='text-dark name'>Daniel Frederic <br> <span class='text-muted' style="font-size:0.6em;margin-left:11%;">Membre depuis 4 janvier 2021</span></span>
                    </div>
                    <hr class="featurette-divider">

                    <form action="" method="POST" >
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current-pwd" class="text-dark">Mot de passe actuel</label>
                                    <input type="password" name="my-pwd" class="form-control" id="current-pwd" placeholder="Entrez votre mot de passe actuel">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="new-pwd" class="text-dark">Nouveau Mot de Passe</label>
                                    <input type="password" name="new-pwd" class="form-control" id="new-pwd" placeholder="Nouveau Mot de Passe">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="confirm-new-pwd" class="text-dark">Confirmation Mot de Passe</label>
                                    <input type="password" name="new-pwd-confirm" class="form-control" id="confirm-new-pwd" placeholder="Confirmation Mot de Passe">
                                </div>
                            </div>
                        </div>
                        
                        <hr class="featurette-divider">
                        <div class="buttons">
                            <button type="submit" name="pwd" class="btn btn-widwel"><i class="bi bi-check"></i> Enregistrer</button>
                        </div>
                    </form> -->

                    <?php } ?>

                    <!-- end -->

                </div>
            </div>
        </div>
    </div>
</main>