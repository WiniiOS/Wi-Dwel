<?php

#Methode pour recuperer les articles de la base de donnees et les retourner
function get_posts()
{
    global $db;
    $req = $db->query("SELECT * FROM articles ORDER BY timePost DESC LIMIT 0,10");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

function filter_by_category($type){
    global $db;
    $req = $db->query("SELECT * FROM articles WHERE type = '{$type}' ORDER BY timePost DESC LIMIT 0,20");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

// recuperer un article selon sa categorie
function get_type_number($type){
    global $db;
    $req = $db->query("SELECT * FROM articles WHERE type ='{$type}' ");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return count($results);
}