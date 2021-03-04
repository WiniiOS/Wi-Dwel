<?php
    $all_rates = get_rates();
?>
<main>

    <div class="container">

        <div class="container mb-5">
            <div class="row">
                <div class="card">
                    <h3 class="text-white">Cliquez pour noter votre ville</h3>
                    <h4 class='text-white'>Total Avis (<?= count($all_rates) ?>)</h4>
                    <button type="button" class="btn btn-danger mb-5 ml-4 mr-4" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-check-square"></i> Noter</button>
                </div>
            </div>
        </div>


        <section id="show-avis-notes-per-user" class='my-3 p-3 bg-body rounded shadow-sm'>
            <!-- <h2 class='text-info p-3'></h2> -->
            <h6 class="border-bottom text-dark pb-2 mb-0">Recentes Notes & Avis!</h6>

            <?php 
            foreach($all_rates as $avis) {
            ?>
    
            <div class="d-flex pt-3 avis-block">
                
                <img class="bd-placeholder-img flex-shrink-0 me-2 rounded mr-2" width="50" height="50" src="assets/avatars/<?= get_user_by_id($avis->rater_id)->avatar; ?>" alt="pseudo">
                <p class="pb-3 mb-0 small lh-sm border-bottom text-muted text-left">
                    <strong class="d-block text-left mb-1 text-muted">
                    <?php //recuperer les donnees du rater
                        $rater = get_user_by_id($avis->rater_id);
                        echo $rater->pseudo;
                    ?> | Note sur <span class='mynote'><?= $avis->ville ?>  <?= $avis->note ?> étoiles</span> </strong>
                    <?= $avis->avis?>
                </p>
            </div>

            <?php
            }
            ?>

            <small class="d-block text-end mt-3">
                <a href="#" class='text-dark'>Toutes les mises a jour</a>
            </small>

        </section>


        <section class='classement my-3 p-3 bg-body rounded shadow-sm'>
            <div class="card-list">
                <h3>Yaounde</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Yaounde') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Douala</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Douala') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Bertoua</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Bertoua') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Bamenda</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Bamenda') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Ngaoundere</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Ngaoundere') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Bafoussam</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Bafoussam') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Dschang</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Dschang') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Maroua</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Maroua') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Garoua</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Garoua') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Ebolowa</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Ebolowa') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Kribi</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Kribi') ?> ETOILES</p>
            </div>
            <div class="card-list">
                <h3>Limbe</h3>
                <p style='color:yellow;'>VILLE <?= get_stars_average('Limbe') ?> ETOILES</p>
            </div>
        </section>

    </div>









    <!-- Modal  to note & comment-->
    <div style='background-color:#eee;' class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info text-center" id="exampleModalLabel">Entrez une note (de 0 à 5) et commenter cette ville.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!--  -->
                    <h6 class='text-dark'>**Laisssez une note**</h6>      
                    <div class='text-info p-3' style="background-color:#1f1e1e24;border-radius:2px;">
                        <!-- on insere une meta donnee () dans chaque span -->
                        <span class="fas fa-star" data-star="1"></span>
                        <span class="fas fa-star" data-star="2"></span>
                        <span class="fas fa-star" data-star="3"></span>
                        <span class="fas fa-star" data-star="4"></span>
                        <span class="fas fa-star" data-star="5"></span>
                        &nbsp; note: <span class="rating text-info">-</span>
                    </div>
                    <!--  -->
                    <form class="form col-md-12" id="contact" action='ajax/note.php' method="post">
                        <input hidden="" name="rater_id" type="number" value="<?= get_user_data()->id ?>" class="form-control" id="rater_id"> 
                        <input hidden="" name="note" type="number" value='' class="form-control note" id="note"> 
                        <div class="form-group">
                            <label for="ville" class="text-dark">Ville ?<span class='star'>*</span></label>
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

                        <div class="form-group">
                            <label for="message-text" class="text-info col-form-label">Avis</label>
                            <textarea required class="form-control" name='avis' id="message-text"></textarea>
                        </div>
                        <div style="width:300px;margin:auto; margin-bottom:5px;height:40px;" class="alert alert-success" role="alert">
                            Merci d'avoir laissé une note!
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>