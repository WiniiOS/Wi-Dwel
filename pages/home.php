<main role="main">
    <!-- header -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1" class=""></li>
          <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
        </ol>
        <div class="carousel-inner">

          <div class="carousel-item carousel-item-next carousel-item-left">
            <img class="responsive-img first-slide" src="./assets/bannerone.jpg" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-center">
                <h1>Postez vos annonces!</h1>
                <p>Bailleur ou agent immobilier,postez gratuitement vos annonces pour faire louer vos biens!</p>
                <!-- <p><a class="btn btn-lg btn-danger" href="#" role="button">POSTER UNE ANNONCE</a></p> -->
              </div>
            </div>
          </div>
          <div class="carousel-item active carousel-item-left">
            <img class="second-slide" src="./assets/bannertwo.jpg" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <h1 class="text-center">Location de biens</h1>
                <p>Touver une maison,un studio,une chambre,un appartement et bien d'autres biens en location</p>
                <!-- <p><a class="btn btn-lg btn-danger" href="#" role="button">SE CONNECTER</a></p> -->
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <!-- Fill d'actualites :locations -->

      <div class="container-fluid">
        <div class="row">
              
              <div class="col-md-8 ">
                <?php
                  if(isset($_GET['type'])){
                    if($_GET['type'] == 'appart'){
                      $posts = filter_by_category('appartement');
                    }
                    if($_GET['type'] == 'chambre'){
                      $posts = filter_by_category('chambre');
                    }
                    if($_GET['type'] == 'studio'){
                      $posts = filter_by_category('studio');
                    }
                    if($_GET['type'] == 'stand'){
                      $posts = filter_by_category('stand');
                    }
                    if($_GET['type'] == 'entrepot'){
                      $posts = filter_by_category('entrepot');
                    }
                    if($_GET['type'] == 'maison'){
                      $posts = filter_by_category('maison');
                    }
                  }else{
                    $posts = get_posts();
                  }
                  
                  foreach($posts as $post) {
                ?>
                <a style="display:block;text-decoration:none;" href="index.php?page=details&id=<?= $post->id ?>">
                    <div class="row featurette featurette-item">
                      <div class="col-md-7 order-md-2">
                        <h5 class="featurette-heading text-danger"><?= ucfirst($post->type) ?></h5>
                        <p class="price text-dark"><?= number_format($post->prix, 2, ',', ' '); ?> FCFA /<span class="text-dark"><?= $post->periode ?></span></p>
                        <div class="row">
                          <div class="col-md-6"><p class="details"><?= $post->qtePieces ?> Pieces.<?= $post->qteChambres ?> Chambre(s).<?= $post->surface ?> M2</p></div>
                          <div class="col-md-6"><p class="city text-dark"><?= $post->ville ?> - <span class="text-dark zone"><?= $post->quartier ?></span></p></div>
                        </div>
                        <h4 class="text-dark"><?= $post->title ?></h4>
                        <p class="desc"> <?= substr(nl2br($post->description), 0,200); ?>... </p>
                        <div id="<?= $post->posterId ?>" class="row">
                          <div class="col-md-3">
                            <img class="img-thumbnail" width="60" height="60" src="./assets/avatars/<?= get_user_by_id($post->posterId)->avatar  ?>" alt="user image">
                          </div>
                          <div class="col-md-8">
                            <h6 class="owner"><?= $post->posterName; ?></h6>
                            <p class="date">Le <?php setlocale(LC_TIME, "fr_FR","French"); echo utf8_encode(strftime("%d %B %Y A %H:%M", strtotime($post->timePost))); ?></p>
                          </div>
                        </div>
                        <a style='text-decoration:none;' class="btn btn-lg btn-default text-info">
                          <i class="text-danger bi bi-award"></i>
                          <?php 
                              $article_owner = get_user_by_id($post->posterId);
                              echo ucfirst($article_owner->status);
                          ?>  
                        </a>
                      </div>
                      <div class="col-md-5 order-md-1">
                        <img style="max-height:250px;min-width:100%;" class="featurette-image img-fluid mx-auto" src="./assets/annonces/<?php $tab = explode( "," , substr($post->images,1,-1));$value = substr($tab[0],1,-1); echo $value; ?>" alt="image">
                        
                        <p class="grey-bloc"> <i class="bi bi-images"></i> <?= ($number = get_qte($post->images)); ?> </p>
                      </div>
                    </div>
                </a>

                <?php
                  }
                ?>

            </div>
            
            <div class="col-md-4 text-dark">

                <div class="container aside">
                  <h3 class="title">De quoi avez vous besoin ?</h3>
                  <hr class="featurette-divider">
                  <div class="row">
                    <div class="col-md-7">
                        <p class="choices"><span class="type"><a href="index.php?page=home&type=appart">Appartements</a> </span></p>
                    </div>
                    <div class="col-md-5">
                      <p class="choices">annonces <?= get_type_number("appartement") ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7">
                        <p class="choices"><span class="type"><a href="index.php?page=home&type=chambre">Chambres</a></span></p>
                    </div>
                    <div class="col-md-5">
                      <p class="choices">annonces <?= get_type_number("chambre") ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7">
                        <p class="choices"> <span class="type"><a href="index.php?page=home&type=studio">Studios</a></span></p>
                    </div>
                    <div class="col-md-5">
                      <p class="choices">annonces <?= get_type_number("studio") ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7">
                        <p class="choices"><span class="type"><a href="index.php?page=home&type=entrepot">Entrepots</a></span></p>
                    </div>
                    <div class="col-md-5">
                      <p class="choices">annonces <?= get_type_number("entrepot") ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7">
                        <p class="choices"><span class="type"><a href="index.php?page=home&type=stand">Stands d'expositions</a></span> </p>
                    </div>
                    <div class="col-md-5">
                      <p class="choices">annonces <?= get_type_number("stand") ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7">
                        <p class="choices"> <span class="type"><a href="index.php?page=home&type=maison">Maisons</a></span></p>
                    </div>
                    <div class="col-md-5">
                      <p class="choices">annonces <?= get_type_number("maison") ?></p>
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
      </div>

 
</main>