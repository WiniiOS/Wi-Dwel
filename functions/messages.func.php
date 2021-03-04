<?php


function get_my_received_messages($targetUserId){
    global $db;
    $req = $db->query("SELECT * FROM messages WHERE targetUserId = '{$targetUserId}' ORDER BY createdDate DESC LIMIT 0,10");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

function get_read_messages($targetUserId){
    global $db;
    $req = $db->query("SELECT * FROM messages WHERE targetUserId = '{$targetUserId}' AND lu = 1 ORDER BY createdDate DESC LIMIT 0,10");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

function get_sent_messages($senderId){
    global $db;
    $req = $db->query("SELECT * FROM messages WHERE senderId = '{$senderId}' ORDER BY createdDate DESC LIMIT 0,10");
    #Stockons les resultats dans un tableau
    $results = array();
    while($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}


function set_to_read($messageid)
{
    global $db;
    
    $i = [
        'lu' => 1,
        'id'  => $messageid
    ];
     //'id'.'.ext' -> '25'.'.jpg' -> 25.jpg
    $sql = "UPDATE messages SET lu = :lu WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($i);
}