<?php

//connexion a la base de donnee
require "../functions/main-function.php";

// On recupere les donnees envoyees en ajax!
$note = htmlspecialchars($_POST['note']);
$avis = htmlspecialchars($_POST['avis']);
$ville = htmlspecialchars($_POST['ville']);
$rater_id = htmlspecialchars($_POST['rater_id']);
// on traite la requete de notation d'une ville

$my_datas = array("ville"=> $ville,"avis"=> $avis,"note" => $note,"rater_id" => $rater_id);

$sql = "INSERT INTO rates (ville,avis,note,rater_id,time) VALUES (:ville,:avis,:note,:rater_id,NOW())";
$req = $db->prepare($sql);
$req->execute($my_datas);

$id = $db->lastInsertId();

// on renvoi l'identifiant de l'avis
echo json_encode($id);