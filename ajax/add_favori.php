<?php 
    //connexion a la base de donnee
    require "../functions/main-function.php";

    // on recupere nos donnees envoyees en post
    $article_id = $_POST['article_id'];
    $user_id = $_POST['user_id'];

    $db->exec( "INSERT INTO favoris (article_id,user_id) VALUES ($article_id,$user_id) ");
    $id = $bd->lastInsertId;

    echo json_encode($id);