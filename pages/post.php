<?php 
    if (!isset($_SESSION['auth'])) {
        header("Location:index.php?page=home");
    }

    // on restreint l'acces des annonces aux particuliers
    if (isset($_SESSION['auth'])) {
        $user = get_one_user();
        $user_statut = $user->status;
        if ($user_statut === "locataire" ) {
            ?>
            <script>
            window.location.href="index.php?page=home"//edit&type=perso
            </script>
            <?php
        }
    }

?>

<main role='main'>
    <div class="container">
        <div class="row">
            <!-- start left side -->
            <div class="col-md-4">
                <div class="container aside">
                    <h3 class="title text-dark">Rubriques connexes</h3>
                    <hr class="featurette-divider">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="choices">Appartement</p>
                        </div>
                        <div class="col-md-6">
                            <p class="total">annonces <?= get_type_personal_number("appartement",$user->id) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="choices">Chambre</p>
                        </div>
                        <div class="col-md-6">
                        <p class="total">annonces <?= get_type_personal_number("chambre",$user->id) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="choices">Studio</p>
                        </div>
                        <div class="col-md-6">
                            <p class="total">annonces <?= get_type_personal_number("studio",$user->id) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="choices">Entrepots</p>
                        </div>
                        <div class="col-md-6">
                            <p class="total">annonces <?= get_type_personal_number("entrepot",$user->id) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="choices">Stand d'exposition</p>
                        </div>
                        <div class="col-md-6">
                            <p class="total">annonces <?= get_type_personal_number("stand",$user->id) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="choices">Maison</p>
                        </div>
                        <div class="col-md-6">
                            <p class="total">annonces <?= get_type_personal_number("maison",$user->id) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->
            <!-- start right side -->

            

            <div class="col-md-8">
                <p>
                    <a class="back" href="index.php?page=home" role="button"><span class='text-left back'><i class="bi bi-chevron-left"></i> Retour à vos annonces</span></a>
                </p>
                <!-- start user informations -->
                <?php
                    
                    // $_SESSION['profil'] = $user;
                    #au cas ou l'utilisateur n'existe pas
                    if ($user == false) {
                        header("Location:index.php?page=error");
                    }else{
                ?>
                <div class="container right-side">
                    <div class='row p-1'>
                        <img style="max-height:60px;" class='img-thumbnail' src="./assets/avatars/<?= $user->avatar ?>" width='50' height='50' alt="avatar">
                        <div class='col-md-8'>
                            <span class='pseudo text-dark'><?= $user->pseudo ?></span><br>
                            <span class='date text-secondary'><?= date("d/m/Y à H:I",strtotime($user->signupDate)); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <!-- end user informations -->

                <!--  #gestion du formulaire  -->
                <?php

                if(isset($_POST['post'])){

                    $title = htmlspecialchars(trim($_POST['title']));
                    $description= htmlspecialchars(trim($_POST['description']));
                    $prix = htmlspecialchars(trim($_POST['prix']));
                    $surface = htmlspecialchars(trim($_POST['surface']));
                    $userPhone = htmlspecialchars(trim($user->telephone));
                    $posterAvatar = htmlspecialchars(trim($user->avatar));
                    $type = htmlspecialchars(trim($_POST['type']));
                    $periode = htmlspecialchars(trim($_POST['periode']));
                    if(isset($_POST['qtePieces'])){
                        $qtePieces = htmlspecialchars(trim($_POST['qtePieces']));
                    }
                    if(isset($_POST['qteChambres'])){
                        $qteChambres = htmlspecialchars(trim($_POST['qteChambres']));
                    }
                    $ville = htmlspecialchars(trim($_POST['ville']));
                    $quartier = htmlspecialchars(trim($_POST['quartier']));
                    $posterId = htmlspecialchars(trim($user->id));
                    $posterName = htmlspecialchars(trim($user->pseudo));
                    $caution = htmlspecialchars(trim($_POST['caution']));

                    $errors = [];

                    // Si l'un de ces champs obligatoires est vide on enregistre une erreur
                    if (empty($title) || empty($description) || empty($prix) || empty($type) || empty($periode) || empty($surface) ||
                        empty($ville) || empty($quartier) || empty($caution) || empty($qteChambres) || empty($qtePieces) ) {
                        $errors["empty"] = " Tous les champs étoilés doivent etre remplis !";
                    }

                    #si le fichier image n'est pas vide,je recupere son nom
                    if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0]) ){

                        $imagesCount = count($_FILES['images']['name']);

                        for($i=0; $i < $imagesCount;$i++){
                            $imageName = $_FILES['images']['name'][$i];
                            $taille_maxi = 6000000; // 6 Mo taille maxi
                            //Taille du fichier
                            $taille = filesize($_FILES['images']['tmp_name'][$i]);
                            // extensions autorisees
                            $extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG','.GIF','.JPEG','.JPG','.svg','.SVG');
                            // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                            $extension = strrchr($_FILES['images']['name'][$i], '.'); 
                            //Début des vérifications de sécurité...
                            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                            {
                                $errors['image'] = "Cette image n'est pas valide";
                            }
                            if($taille>$taille_maxi){
                                $errors['taille'] = "La taille de fichier doit etre inferieure a 3 Mo...";
                            }

                            $max_to_upload = 4;
                            $set_files_number = $imagesCount;
                            if($set_files_number >= 5){
                                $errors['max'] = "Vous ne pouvez pas telecharger plus de 4 Images!";
                            }

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
                        //S'il n'y a pas d'erreur, on commence les enregistrement puis upload
                        post($title,$description,$prix,$surface,$userPhone,$type,$periode,$qtePieces,$qteChambres,$ville,$quartier,$posterId,$posterName,$caution,$posterAvatar);
                        
                        global $id;
                        // on recupere le tableau qui contient les avantages du local
                        if(isset($_POST['advantages'])){
                            $advantages = json_encode($_POST["advantages"]);
                            // maintenant on update les advantages
                            $id = post_advantages($advantages);
                        }

                        
                        // En fin on update et upload nos images
                        $success;

                        for($i=0; $i < count($_FILES['images']['name']); $i++){
                            //On formate le nom du fichier ici...

                            $fichier = basename($_FILES['images']['name'][$i]);
                            // On remplace les caractères accentues du nom original du fichier par des caracteres sans accent
                            // $fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            // 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                            // on traite le nom du fichier
                            // $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                            // on remplace les slash par -
                            // $fichier = str_replace("/", "-", $fichier);


                            $dossier = 'assets/annonces/';

                            post_imgs(json_encode($_FILES['images']['name']),$id);

                            //Si la fonction move_uploaded_file renvoie TRUE, c'est que ça a fonctionné...
                            if(move_uploaded_file($_FILES['images']['tmp_name'][$i], $dossier.$fichier)) {
                                
                                $success = "Votre bien a été ajouté avec success !";

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

                        if($success !== ""){
                            ?>
                                <div class="card red">
                                    <div class="card-content p-2 text-success">
                                        <i style="color:green;" class="bi bi-check"></i> 
                                        <?= $success ?>
                                    </div>
                                </div>
                            <?php
                        }

                    }
                }
                ?>


                    <hr class="featurette-divider">
                    <h4 class="text-dark type-header">Type de bien</h4>
                    <hr class="featurette-divider">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="form-label text-dark">Donner un titre a ce bien <span class='star'>*</span></label>
                            <input type="text" name='title' required class="form-control" id="title" placeholder="Appartement meublé">
                        </div>
                        <hr class="featurette-divider">
                        <div class="row">
                            <div style="border:4px dotted gray;" class=" p-4  col-md-12">
                                <h5 class='text-center text-info'>Ajouter des images ( 4 maximum)</h5>
                                <div class="form-group form-avatar">
                                    <!-- <input type="file" name="image" class="form-control-file"> -->
                                    <input required type="file" name="images[]" multiple class="form-control-file">
                                </div>
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prix" class="text-dark">Prix de ce bien ?<span class='star'>*</span></label>
                                    <input required type="number" name='prix' class="form-control" id="prix" placeholder="Montant de votre bien">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="caution" class="text-dark">Caution ?<span class='star'>*</span></label>
                                    <input required type="number" name='caution' class="form-control" id="caution" placeholder="Garantie">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="periode" class="text-dark">Période ?<span class='star'>*</span></label>
                                    <select required name='periode' class="form-control" id="periode">
                                        <option value='mois' class='text-dark'>Mois</option>
                                        <option value='jour' class='text-dark'>Jour</option>
                                        <option value='week-end' class='text-dark'>Week-end</option>
                                        <option value='semaine' class='text-dark'>semaine</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="text-dark">Type de bien ?<span class='star'>*</span></label>
                                    <select required name='type' class="form-control" id="type">
                                        <option value='chambre' class='text-dark'>Chambre</option>
                                        <option value='maison' class='text-dark'>Maison</option>
                                        <option value='appartement' class='text-dark'>Appartement</option>
                                        <option value='stand' class='text-dark'>Stands d'exposition</option>
                                        <option value='entrepot' class='text-dark'>Entrepot</option>
                                        <option value='studio' class='text-dark'>Studio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ville" class="text-dark">Ville du bien ?<span class='star'>*</span></label>
                                    <select required name='ville' class="form-control" id="ville">
                                        <option value='Yaounde' class='text-dark'>Yaounde</option>
                                        <option value='Douala' class='text-dark'>Douala</option>
                                        <option value='Bertoua' class='text-dark'>Bertoua</option>
                                        <option value='Kribi' class='text-dark'>Kribi</option>
                                        <option value='Garoua' class='text-dark'>Garoua</option>
                                        <option value='Bamenda' class='text-dark'>Bamenda</option>
                                        <option value='Ngaoundere' class='text-dark'>Ngaoundere</option>
                                        <option value='Bafoussam' class='text-dark'>Bafoussam</option>
                                        <option value='Dschang' class='text-dark'>Dschang</option>
                                        <option value='Limbe' class='text-dark'>Limbe</option>
                                        <option value='Maroua' class='text-dark'>Maroua</option>
                                        <option value='Ebolowa' class='text-dark'>Ebolowa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quartier" class="text-dark">Quartier ?<span class='star'>*</span></label>
                                    <input required type="text" name="quartier" class="form-control" id="quartier" placeholder="Quartier ou lieu">
                                </div>
                            </div>
                        </div>

                        <!-- <h4 class="text-dark">Caracteristiques du bien uniquement pour(Appartement et maison)</h4> -->
                        <hr class="featurette-divider">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surface" class="text-dark">Surface <span class='star'>*</span></label>
                                    <input name="surface" required type="number" class="form-control" id="surface" placeholder="En mettre carree" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pieces" class="text-dark">Pieces <span class='star'>*</span></label>
                                    <input name='qtePieces' required type="number" class="form-control" id="pieces" placeholder="Nombre de pieces">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="chambres" class="text-dark">Chambres <span class='star'>*</span></label>
                                    <input type="number" required name="qteChambres" class="form-control" id="chambres" placeholder="Nombre de chambres">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-dark"><span class='star'>*</span> optionnel: Seul les champs avec une etoile sont obligatoires !</p>
                            </div>
                        </div>

                        <h4 class="text-dark">Les avantages de mon bien</h4>
                        <hr class="featurette-divider">

                        <div class="form-check form-check-inline">
                            <input name="advantages[]"  class="form-check-input" type="checkbox" id="one" value="MEUBLE">
                            <label class="form-check-label text-dark" for="one">Meublé</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="advantages[]"  class="form-check-input" type="checkbox" id="two" value="TERRASSE">
                            <label class="form-check-label text-dark" for="two">Terrasse</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="advantages[]"  class="form-check-input" type="checkbox" id="three" value="BALCON">
                            <label class="form-check-label text-dark" for="three">Balcon</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="advantages[]"  class="form-check-input" type="checkbox" id="four" value="ASCENSSEUR">
                            <label class="form-check-label text-dark" for="four">Ascenceur</label>
                        </div>

                        <h4 class="text-dark desc">Description de l'annonce</h4>
                        <hr class="featurette-divider">
                        <div class="form-group">
                            <label for="description" class="text-dark">Décrivez votre annonce! <span class='star'>*</span></label>
                            <textarea required type="description" name="description" class="form-control" id="description"></textarea>
                        </div>
                        <div class="buttons">
                            <button type="submit" name="post" class="btn btn-widwel">Publier</button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- end -->
        </div>
    </div>
</main>