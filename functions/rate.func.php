<?php

// recuperation des avis

#Methode pour recuperer les articles de la base de donnees et les retourner
function get_rates()
{
    global $db;
    $req = $db->query("SELECT * FROM rates");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

// recuperer la moyenne d'evaluation d'une ville
function get_stars_average($city){
    global $db;
    $sql = "SELECT note FROM rates WHERE ville ='{$city}' ";
    $req = $db->query($sql);
    #Stockons les resultats dans un tableau
    $notes = array();
    while($rows = $req->fetchObject()) {
        $notes[] = $rows;
    }
    $total_notes = count($notes);
    $average = 0;
    $somme_notes = 0;
    if(!empty($notes)){
        foreach($notes as $note){
            //somme_notes = somme_notes + current_note
            $somme_notes += $note->note;
        }
        $average = $somme_notes/$total_notes;
        return $average;
    }else{
        return $average;
    }
}