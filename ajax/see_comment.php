<?php 
    //connexion a la base de donnee
    require "../functions/main-function.php";
    //execute la mise a jour du commentaire
    $db->exec("UPDATE comments SET seen = 1 WHERE id = '{$_POST['id']}'");