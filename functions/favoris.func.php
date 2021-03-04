<?php

#recuperer les favoris du user
function get_favoris()
{
    global $db;
    $user = get_user_data();
    $req = $db->query("SELECT * FROM favoris WHERE user_id = $user->id ");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}



function post_in_favori($id){
    global $db;
    $req = $db->query("SELECT * FROM articles WHERE id = $id");
    $result = $req->fetchObject();
    return $result;
}