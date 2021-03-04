<?php

// recuperer les articles similaires selon categorie
function get_recommended_posts($type)
{
    global $db;
    $req = $db->query("SELECT * FROM articles WHERE type = '{$type}' ORDER BY timePost DESC LIMIT 3");
    $results = [];
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

// recuperer les commentaires d'un article
function get_comments($articleId){
    global $db;
    $req = $db->query("SELECT * FROM comments WHERE articleId = '{$articleId}' ORDER BY postTime DESC LIMIT 8");
    $results = [];
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

//contient une fonction pour afficher les details d'un article
function get_one_post(){
    global $db;
    $req = $db->query("SELECT * FROM articles WHERE articles.id ='{$_GET['id']}'");
    $result = $req->fetchObject();
    return $result;
}

function send_comment($comment){
    global $db;
    global $post;
    global $curentUser;
    $curentUser = get_user_data();
    $curentUserId = $curentUser->id;
    $articleId = $post->id;
    $data = [
        'curentUserId'=> $curentUserId,
        'comment'    => $comment,
        'articleId'  => $articleId
    ];
    $sql = "INSERT INTO comments (posterId,comment,articleId,postTime) VALUES (:curentUserId,:comment,:articleId,NOW() )";
    $req = $db->prepare($sql);
    $req->execute($data);

    return true;
}

