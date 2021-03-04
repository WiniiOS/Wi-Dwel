<?php 
    //connexion a la base de donnee
    require "../functions/main-function.php";

    // on recupere nos donnees envoyees en post
    $id_follower = $_POST['id_follower'];
    $id_followed = $_POST['id_followed'];

    // chantier cas ou il est deja suivi on supprime ce vendeur,on ne doit pas se suivre sinon on affiche un message
    // gerer le nombre d'abonnees



    $db->exec( "INSERT INTO follow (id_follower,id_followed) VALUES ($id_follower,$id_followed) ");
    $id = $bd->lastInsertId;

    echo json_encode($id);