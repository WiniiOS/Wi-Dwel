<?php

$favoris = get_favoris();

// var_dump($favoris);

?>

<main >
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-4">
                <div class='left-block'>
                    <h4>Sections</h4>
                    <hr class="featurette-divider">
                    <p><a href="index.php?page=favoris&type=appartement">Appartement(s)</a>  <span class='total'>0</span></p>
                    <p><a href="index.php?page=favoris&type=chambre">Chambre(s)</a>   <span class='total'>0</span></p>
                    <p><a href="index.php?page=favoris&type=studio">Studio(s)</a>  <span class='total'>0</span></p>
                    <p><a href="index.php?page=favoris&type=entrepot">Entrepot(s)</a>  <span class='total'>0</span></p>
                    <p><a href="index.php?page=favoris&type=stand">Stand d'exposition(s)</a>   <span class='total'>0</span></p>
                    <p><a href="index.php?page=favoris&type=maison">Maison(s)</a>  <span class='total'>0</span></p>
                </div>
            </div> -->
            <div class="col-md-10">
                <div class="right-block">
                    <div class="header">
                        <h3>MES FAVORIS</h3>
                    </div>
                    <div class='right-block-content'>
                        <?php 
                        if (empty($favoris)) {
                        ?>
                        <p class="text-dark text-center">Vous n'avez encore ajouté aucun favoris pour le moment!</p>
                        <p class='text-center back-btn'><i class="bi bi-chevron-left"></i><a class='back-btn text-center' href="index.php?page=home"> Retour à l'accueil</a></p>
                        <?php
                            }else{
                                foreach($favoris as $favori) {
                                    $item = post_in_favori($favori->article_id);

                        ?>
                        <!-- articles favoris -->



                        <a style="display:block;text-decoration:none;" href="index.php?page=details&id=<?= $favori->article_id ?>">
                            <div class="row featurette featurette-item">
                                <div class="col-md-7 order-md-2">
                                    <h5 class="featurette-heading text-danger"><?= ucfirst($item->type) ?></h5>
                                    <p class="price text-dark"><?= number_format($item->prix, 2, ',', ' '); ?> FCFA /<span class="text-dark"><?= $item->periode ?></span></p>
                                    <div class="row">
                                    <div class="col-md-6"><p class="details"><?= $item->qtePieces ?> Pieces.<?= $item->qteChambres ?> Chambre(s).<?= $item->surface ?> M2</p></div>
                                    <div class="col-md-6"><p class="city text-dark"><?= $item->ville ?> - <span class="text-dark zone"><?= $item->quartier ?></span></p></div>
                                    </div>
                                    <h4 class="text-dark"><?= $item->title ?></h4>
                                    <p class="desc"> <?= substr(nl2br($item->description), 0,200); ?>... </p>
                                    <div id="<?= $item->posterId ?>" class="row">
                                    <div class="col-md-3">
                                        <img class="img-thumbnail" width="60" height="60" src="./assets/avatars/<?= get_user_by_id($item->posterId)->avatar  ?>" alt="user image">
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="owner"><?= $item->posterName; ?></h6>
                                        <p class="date">Le <?php setlocale(LC_TIME, "fr_FR","French"); echo utf8_encode(strftime("%d %B %Y A %H:%M", strtotime($item->timePost))); ?></p>
                                    </div>
                                    </div>
                                    <a style='text-decoration:none;' class="btn btn-lg btn-default text-info">
                                    <i class="text-danger bi bi-award"></i>
                                    <?php 
                                        $article_owner = get_user_by_id($item->posterId);
                                        echo ucfirst($article_owner->status);
                                    ?>  
                                    </a>
                                </div>
                                <div class="col-md-5 order-md-1">
                                    <img style="max-height:250px;min-width:100%;" class="featurette-image img-fluid mx-auto" src="./assets/annonces/<?php $tab = explode( "," , substr($item->images,1,-1));$value = substr($tab[0],1,-1); echo $value; ?>" alt="image">
                                    
                                    <p class="grey-bloc"> <i class="bi bi-images"></i> <?= ($number = get_qte($item->images)); ?> </p>
                                </div>
                            </div>
                            <hr class="featurette-divider">
                        </a>


                        <?php
                                }
                            }
                        ?>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>