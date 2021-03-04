<?php

// fonction pour recuperer l'utilisateur courant
function get_one_user(){

    global $db;
    $req = $db->query("SELECT * FROM users WHERE users.email ='{$_SESSION['auth']}'");
    $result = $req->fetchObject();
    return $result;
}

function get_type_personal_number($type,$userId){
    global $db;
    $req = $db->query("SELECT * FROM articles WHERE type ='{$type}' AND posterId ='{$userId}' ");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return count($results);
}

#fonction qui upload un article sans image
function post($title,$description,$prix,$surface,$userPhone,$type,$periode,$qtePieces,$qteChambres,$ville,$quartier,$posterId,$posterName,$caution,$posterAvatar){
    global $db; 

    $p = [
        'title'         =>  $title,
        'description'   =>  $description,
        'prix'          =>  $prix,
        'surface'       =>  $surface,
        'userPhone'     =>  $userPhone,
        'type'          =>  $type,
        'periode'       =>  $periode,
        'qtePieces'     =>  $qtePieces,
        'qteChambres'   =>  $qteChambres,
        'ville'         =>  $ville,
        'quartier'      =>  $quartier,
        'posterId'      =>  $posterId,
        'posterName'    =>  $posterName,
        'caution'       =>  $caution,
        'posterAvatar'    => $posterAvatar
    ];

    $sql = "INSERT INTO articles(title,description,prix,surface,userPhone,type,periode,qtePieces,
            qteChambres,ville,quartier,posterId,posterName,caution,posterAvatar,timePost) 
            VALUES(:title,:description,:prix,:surface,:userPhone,:type,:periode,:qtePieces,
            :qteChambres,:ville,:quartier,:posterId,:posterName,:caution,:posterAvatar,NOW() )";
    $req = $db->prepare($sql);
    $req->execute($p);
}

// fonction qui update les avantages de l'article s'il sont definis
function post_advantages($advantages){
    global $db; 
    global $lastInsertedId;
    $id = $db->lastInsertId();
    $lastInsertedId = $id;

    $i = [
        'id'  => $id,
        'advantages' => $advantages
    ];
    $sql = "UPDATE articles SET advantages = :advantages WHERE id = :id ";
    $req = $db->prepare($sql);
    $req->execute($i);
    return $id;
}

#fonction qui ajoute l'image a l'article
function post_imgs($images,$id)
{
    global $db;
    
    $i = [
        'images' => $images,
        'id'  => $id
    ];
     //'id'.'.ext' -> '25'.'.jpg' -> 25.jpg
    $sql = "UPDATE articles SET images = :images WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($i);
}

#recuperer le nombre d'entree dans les differentes tables
function inTable($table)
{
    global $db;
    $req = $db->query("SELECT COUNT(id) FROM $table");
    #un fetch car il va just recuperer un nombre a afficher
    return $nombre = $req->fetch();
}
