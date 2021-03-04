<main>

    <?php 
        if(!isset($_GET['city'])){
    ?>

    <div class="container services">
        <div class="row">
            <div class="col-md-3">
                <a style='display:block;' href="index.php?page=services&city=yaounde">
                    <div class="card" >
                        <h3 class="text-white">Yaoundé</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a style='display:block;' href="index.php?page=services&city=douala">
                    <div class="card" >
                        <h3 class="text-white">Douala</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ">
                <a style='display:block;' href="index.php?page=services&city=kribi">
                    <div class="card" >
                        <h3 class="text-white">Kribi</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a style='display:block;' href="index.php?page=services&city=bertoua">
                    <div class="card" >
                        <h3 class="text-white">Bertoua</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <!-- Content  -->

    <?php if(isset($_GET['city'])){ ?>

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3 text-center text-white"><?= $_GET['city']; ?> </h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="left-block">
                    <h3 class='text-dark'>Ne rien rater sur <?= $_GET['city']; ?> </h3>
                    <hr class="featurette-divider">
                    <p>Locations à <?= $_GET['city']; ?> </p>
                    <p>Services à <?= $_GET['city']; ?></p>
                    <p>Loisirs</p>
                    <p>Lieux populaires à <?= $_GET['city']; ?></p>
                </div>
            </div>
            <div class="col-md-8">
                <div >
                    <h3>Bon a savoir sur <?= $_GET['city']; ?> </h3>
                </div>
                <div class="right-block">
                    <p class='text-dark text-center'>
                    <b class='text-dark'>Yaoundé</b> surnommée <b class='text-dark'>"la ville au sept collines"</b> chef lieu de la
                    region du Centre et du département du Mfoundi est la capitale politique de la république
                    du Cameroun et représente la deuxième ville du pays en terme de démographie après <b class='text-dark'>Douala</b>.
                    Elle à été créée dans les années 1886 par des colons allemand de passage sur le territoire
                    durant l'aire coloniale juste avant l'arrivée des français et anglais. Son nom 'Yaoundé' 
                    provient du mot <b class='text-dark'>'jouande'</b> en allemand qui signifie <b class='text-dark'>"semeurs d'arachides" </b> car les colons de
                    leurs passage aperçut des aucthotonnes en plein travaux champètres et ils décidèrent de 
                    batiser la ville ainsi. Aujourd'hui, la ville est très bien développée et peuplée de plus 4
                    million d'habitants selon le dernier recensement de 2019 sur une superficie habité de 302 km2
                    soi une densité moyenne de 5,691 habitants par m2. Elle abrite la plupart des institutions 
                    Camerounaise les plus importantes notamment les ministères ambassade et bien d'autres.
                    </p>
                    <h2 class='text-dark'>Architecture</h2>
                    <p class='text-dark text-center'>
                    La majorité des bâtiments publics de Yaoundé date de plusieurs décennies. Parmi les bâtiments les plus 
                    imposants, on peut citer le siège de la <b class='text-dark'>BEAC</b>, la tour de la SNI (Société Nationale d'Investissements),
                    <b class='text-dark'>l'hôtel Hilton, le Palais de l'unité</b> qui abrite la présidence de la république,<b class='text-dark'> 
                    le palais des congrès,l'hôtel Mont-Fébé, le Palais des sport</b> ou les bâtiments ministériels. Un grand nombre de bâtiments 
                    contemporains dont l'architecture a été fortement influencée par le mouvement moderne brutaliste 
                    pendant la période des années 1950 à 1980, puis par le style international avec ses immeubles en verre 
                    et acier.
                    </p>
                    <h2 class='text-dark text-left'>Transport</h2>
                    <p class='text-dark text-center'>
                    La ville est reliée par le transport aérien avec <b class='text-dark'>l'aéroport international de Yaounde-Nsimalen</b> 
                    situé un peu en périphérie de la ville. Le moyen de déplacement le plus utilisé est le <b class='text-dark'> taxis 
                    collectif </b> cependant Il existe aussi des <b class='text-dark'>motos-taxis </b>qui ne prennent qu'un ou deux passagers à 
                    la fois et sont plus rapides et pratique pour entrer dans les quartiers de la ville. Il existe
                    enfin quelques lignes de bus desservant les principales artères de la ville. Plusieurs compagnies 
                    de transport privées relient Yaoundé aux autres régions du Cameroun au moyen d'autocars et trains 
                    passant principalement par Douala.
                    </p>
                    <h2 class='text-dark text-left'>Loisirs</h2>
                    <p class='text-dark text-center'>
                    Régulièrement la commune organise le <b class='text-dark'>"YA-FE"</b> abréviation pour dire Yaoundé en fetes chaque mois de 
                    décembre sur le boulevard du 20 mai pour le bien de tout Camerounais. Comme autres lieu de divertissement,
                    nous avons le <b class='text-dark'>centre culturel français</b> situé sur l'avenue Kennedy et le<b class='text-dark'> Goethe-Institut Kamerun</b> situé à 
                    Bastos projettent toutes les semaines des films ou assurent des spectacles (théâtres, concert) ou 
                    conférences. 
                    <br><br>
                    L'on peut aussi faire un tour au <b class='text-dark'>centre culturel camerounais</b> situé au quartier Nlongkak.
                    Yaoundé compte aussi beaucoup de restaurants et de boîtes de nuit. Quelque un connues sont <b class='text-dark'>le Katios, 
                    la Sanza, le Safari, le Mvet, le Balafon Olympique</b>. Il existe aussi des cabarets : la terre battue, 
                    El pachinko, Carossel et Le Club Bantou ou l'on peut voir des artistes de la place en live sur scène.
                    Chaque année, se déroule à Yaoundé la célèbre "chasse au sanglier". Un grand nombre de danses 
                    traditionnelles sont exécutées autour du sacrifice.
                    <br>
                    Yaoundé possède aussi beaucoup d'espaces verts. En outre, il existe quelques parcs et jardins publics. 
                    Il s'agit entre autres du petit jardin public entourant le monument Charles Atangana au centre-ville, 
                    le jardin public à proximité de l'Hôtel de ville, le jardin public du quartier Fébé et tout autour du
                    Palais des Congrès.
                    <br>
                    Il existe aussi quelques parcs d'attraction : le parc d'attraction de Djoungolo (parc Kiriakides), le <b class='text-dark'>bois Sainte-Anastasie </b>situé au carrefour Warda.
                    </p>
                </div>
                <div class="right-block">
                    <h2><?= $_GET['city']; ?> - Guide en vidéo</h2>
                    <iframe border="2px solid #ccc" width="100%" height="315" src="https://www.youtube.com/embed/vRJCGJr2a9Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                    </iframe>
                </div>

                <div class="right-block zones">
                    <h2><?= $_GET['city']; ?> – Quelques endroits populaires à visiter</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="background-image:url('') !important; width: 18rem;">
                                <img class="card-img-top" src="./assets/monument.jpeg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">MONUMENT CHARLES ATANGANA TSAMA</h5>
                                    <p class="card-text">
                                        Né vers 1883 a Yaoundé et mort le 1er septembre 1943 de suite courte maladie, sa statut à été...
                                    </p>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="right-block">
                    <h2>Avis sur <?= $_GET['city']; ?></h2>
                    <div class='container-fluid'>
                        <form action="" method="POST">
                            <a class='pull-left' href="index.php?page=profil">
                                <div class="author">
                                    <img width="50" height="50" class="avatar" alt="Franck ndi" src="./assets/blurredimage.jpg">
                                </div>
                            </a>
                            <div class="form-group media-body">
                                <textarea id="avis" name="avis" placeholder="Laisser votre avis ou un commentaire..." class="form-control"></textarea>
                                
                                <button type="submit" class="pull-right btn btn-secondary btn-sm "><b>POSTER MON AVIS</b></button>
                            
                            </div>
                            <br><br>
                        </form>
                        <hr class="featurette-divider">
                        <h2>Avis</h2>
                        <div class="container">
                            <div style='padding:5px;box-shadow: 5px 3px 5px 2px rgb(0 0 0 / 12%), 0px 0px 2px 0px rgb(0 0 0 / 24%);border-radius:4px;'>
                                <h6 style='font-weight:bold;padding:0;text-align:left;' class='text-dark'>Daniel frederic</h6>
                                <p style='padding:0;text-align:left;' class='text-muted'>C'est une super ville</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <!-- end right side -->
            <div class="col-md-12">
                <h2 class='text-dark text-left'>Ville similaires à <?= $_GET['city'];?></h2>
                <div class="row">
                    <div class="col-md-3">
                        <a height="60" style='display:block;' href="index.php?page=services&city=yaounde">
                            <div class="card-recommend" >
                                <h3 class="text-white">Douala</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a height="60" style='display:block;' href="index.php?page=services&city=kribi">
                            <div class="card-recommend" >
                                <h3 class="text-white">Kribi</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a height="60" style='display:block;' href="index.php?page=services&city=dschang">
                            <div class="card-recommend" >
                                <h3 class="text-white">Dschang</h3>
                            </div>
                        </a>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>


    <?php } ?>

</main>