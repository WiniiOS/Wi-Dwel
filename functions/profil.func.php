<?php 

function get_one_user(){
    global $db;
    $req = $db->query("SELECT * FROM users WHERE users.email ='{$_SESSION['auth']}'");
    $result = $req->fetchObject();
    return $result;
}