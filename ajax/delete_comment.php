<?php

//connexion a la base de donnee
require "../functions/main-function.php";
//execute la suppression du commentaire
$db->exec("DELETE FROM comments WHERE id = '{$_POST['id']}'");
