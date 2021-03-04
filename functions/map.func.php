<?php


    // Programme de geo-localisation/
	// systeme permettant d'avoir un tas d'info avec une simple IP Lien de l'API : http://ip-api.com

	// L'api va renvoyer des variables :
	// Region : $query['region']
	// Ville : $query['city']
	// Organisation : $query['org']
	// Identifiant AS : $query['as']
	// Longitude : $query['lon']
	// Lattitude : $query['lat']
	// ISP : $query['isp']
	// ZIP : $query['zip']
	// Timezone : $query['timezone']
	// Pays : $query['country']
	// Code du pays : $query['countryCode']
	// Nom de la region : $query['regionName']

function getGeoData(){

	$ip = $_SERVER['REMOTE_ADDR']; // Recuperation de l'IP du visiteur
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip)); //connection au serveur de ip-api.com et recuperation des données
	if($query && $query['status'] == 'success') 
	{
        //code avec les variables
        return $query;
        // echo "Bonjour visiteur de " . $query['country'] . "," . $query['city'];
        
	}
}