<?php

// fonction de setter avec des arguments
function edit_perso($status,$sex,$name,$prenom,$pseudo,$email,$telephone,$id){
    global $db;
    $e = [
        'status'    => $status,
        'sex'       => $sex,
        'name'      => $name,
        'prenom'    => $prenom,
        'pseudo'    => $pseudo,
        'email'     => $email,
        'telephone' => $telephone,
        'id'        => $id
    ];
    $sql = "UPDATE users SET status = :status, sex= :sex, nom = :name, prenom = :prenom,prenom = :pseudo,email = :email,telephone = :telephone WHERE id= :id";
    $req = $db->prepare($sql);
    $req->execute($e);
}

#fonction de setter avec des arguments  
function edit_coord($adresse,$site,$city,$biographie,$id){

    global $db;

    $e = [
        'adresse'     => $adresse,
        'site'   => $site,
        'city'    => $city,
        'biographie'        => $biographie,
        'id'  => $id
    ];

    $sql = "UPDATE users SET adresse = :adresse, webSite= :site, city = :city, biographie = :biographie WHERE id= :id";
    $req = $db->prepare($sql);
    $req->execute($e);
}

#fonction qui ajoute l'image a l'article
function post_avatar($fichier,$id)
{
    global $db;
    
    $i = [
        'image' => $id.$fichier,
        'id'  => $id
    ];
     //'id'.'.ext' -> '25'.'.jpg' -> 25.jpg
    $sql = "UPDATE users SET avatar = :image WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($i);
}