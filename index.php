<?php
    
    // Connexion a la base de donnees et session_start
    include "functions/main-function.php";

    

    #scan du contenu du dossier pages et recuperation du contenu sous forme de tableau
    $pages = scandir('pages/');
    #si la donnee d'url 'page' est valide et non vide:
    if (isset($_GET['page']) AND !empty($_GET['page'])) {
        #si le nom de page donné sur l'url correspond a un nom dans les scans du dossier pages
        if (in_array($_GET['page'].'.php', $pages)) {
            // on recupere le nom de la page
            $page = $_GET['page'];
        }else{
            $page = "404";
        }
    }else{
        #dans le cas l'internaute n'a rien mis,on le redirige vers la page home:
        $page = 'home';
    }

    // #Inclusion de la page de fonctionnalite du composant chargé
    #scan du dossier function 
    $pages_function = scandir('functions/');
    if (in_array($page.'.func.php', $pages_function)) {
        include "functions/".$page.".func.php";
    }


    // INCLUSION DES FICHIERS D'INITIALISATION GETTEXT
    require_once("./localization.php");
    

?>


<html lang="fr" >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">
    <meta name="author" content="Wi_Dwel Group">
    <meta name="keywords" content="immobilier,locations,services,annoces">
    <meta name="description" content="Trouvez une chambre un appartement ou une maison,chambre, bien  en vente ou en location. Plusieurs offre annonces immobilières et services selon la ville ou zone geographique au Cameroun.">
    <meta name="user-name" content="name">

    <meta property="og:type" name="og:type" content="site">
    <meta property="og:country" content="Cameroun">
    <meta property="og:url" name="og:url" content="https://wi-dwel.com/accueil">
    <meta property="og:title" name="og:title" content="Annonces immobilières ciblées | 1er Réseau social immobilier africain | services par entrepreneurs | 1er site pour trouver un logement en Afrique">
    <meta property="og:description" name="og:description" content="Trouvez une chambre un appartement ou une maison,chambre, bien  en vente ou en location. Plusieurs offre annonces immobilières et services selon la ville ou zone geographique au Cameroun.">

    <title>Accueil</title>

    <!-- Library bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" href="./assets/favicon.ico" />
    <!-- Inclusion des styles de la page -->
    <?php
        $pages_design = scandir('design/');
        if (in_array($page.'.css', $pages_design)) {
    ?>

    <link rel="stylesheet" type="text/css" href="./design/navbar.css">
	<link rel="stylesheet" type="text/css" href="./design/<?=$page?>.css">
    <link rel="stylesheet" type="text/css" href="./design/footer.css">
    
    <?php } ?>

    

    <!--Import Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        body{
            font-family: sans-serif;
            /* background-color: linear-gradient(rgb(21, 255, 234), #1d33c4); */
            background-color:#eee;
            padding-top: 40px;
            padding-bottom:0px;
        }
        /* notification */
        .close{
            text-shadow: 0 1px 0 #000;
        }
        .btn-danger,.btn-widwel{
            background-color: #f1051b !important;
        }

        /* google traduction */
        .goog-te-gadget-simple{
            position: absolute;
            z-index: 7;
            top: 15;
            left: 0;
            background-color: #002157;
            max-width: 100px;
            width: 100px;
        }

        <?php
        if($page == "login" || $page == "sign-up"){
        ?>
        body{
            background-image: url("assets/nature.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        <?php } ?>
    </style>
    <?php
        if($page == "rate"){ 
    ?>
    <!-- integration de la librairie font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <!--  -->
    <?php } ?>

  </head>

  <body>
  
    <?php 
        #restriction de la page des posts d'annonces
        // on redirige l'utilisateur non connecté
        if ($page == 'post' && !isset($_SESSION['auth']) ) {
            header("Location:index.php?page=login");
        }

        if ($page == 'sign-up' && isset($_SESSION['auth'])) {
            header("Location:index.php?page=home");
        }

        if($page == 'logout' && isset($_SESSION['auth'])){

            // desactiver les cookies // suppression de ce cookie.
            setcookie('email','',time() - 3600);
            setcookie('password','',time() - 3600);

            #defaire la session et rediriger vers l'acceuil administration
            unset($_SESSION['auth']);
            unset($_SESSION['pseudo']);
            // $_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
            header("Location:index.php?page=home");
        }
        
        // nav template inclusion
        include "body/navbar.php";
    ?>

    <?php
    if($page === 'home'){
    ?>
    <!-- notification toast -->
    <div class="toast show" id="toast1" data-delay="5000" style="position: top:6rem;right:30rem; z-index:2; min-width:250px;" aria-live="assertive" aria-atomic="true">
        <div class="alert alert-default p-4 text-center" style='font-style: italic;' role="alert">
            <button type="button" class="ml-2 mb-1 close " data-dismiss="toast" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
            Seul les bailleurs et agents immobiliers peuvent poster une annonce! <a href="index.php?page=edit&type=perso" style="color:red;" class="alert-link">Modifier mon profile</a>.
        </div>
    </div>

    <?php } ?>

    <?php
        #inclusion de la page qui se trouve dans le dossier pages et qui porte le nom de la var $page(template)
        include "pages/".$page.".php";
    ?>

    <?php include "body/footer.php"; ?>

    <?php
    if (isset($_SESSION['auth'])) {
        
        if (get_user_data()->status === 'locataire' && $page === 'home') {
            ?>
            <script>
                setTimeout(function(){document.querySelector('.toast').style.display = 'block'; }, 1500);
            </script>
            <?php
        }
    }
    ?>
    
    <!-- script pour desactiver la notification -->
    <script>
        
        document.querySelector('.toast').style.display = 'none';
        document.querySelector('.close').addEventListener("click",function(){
            document.querySelector('.toast').style.display = 'none';
        })
    </script>

    <!-- latest version 4.1.3 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script> -->

    <?php
        #scan du dossier js 
        $pages_js = scandir('js/');
        if (in_array($page.'.func.js', $pages_js)) {
            #si jamais je trouve la $page.func.js allors j'inclu 
    ?>

    <script type="text/javascript" src="js/<?= $page ?>.func.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq1w0NUDdxSbBOFf_G4TAF31H_1uFeHu8&callback=init" type="text/javascript"></script>
    
    <?php
        }
    ?>


    
	</body>
</html>