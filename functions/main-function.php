<?php
	session_start();
	
	$dbhost = 'localhost';
	$dbname = 'wi-dwel';
	$dbuser = 'root';
	$dbpwd = '';

	try { $db = new PDO("mysql:host=".$dbhost.";dbname=".$dbname,$dbuser,$dbpwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING)); }
	catch (Exception $e) { die('Une erreur est survenue lors de la connexion a la base de donnee'); }

	// pour proposer des pages qui ne seront accessible qu'aux utilisateurs authentifiés
	// la vérification devra se faire dans plusieurs de nos pages ,on va donc placer ce code dans une fonction.


	function logged_only(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
		
		if(!isset($_SESSION['auth'])){
			$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
			header('Location: index.php?page=login');
			exit();
		}
	}

	// pour eviter les conflits avec get_one_user
	function get_user_data(){

		global $db;
		$req = $db->query("SELECT * FROM users WHERE users.email = '{$_SESSION['auth']}'");
		$result = $req->fetchObject();
		return $result;
	}

	


	function send_message($default_msg,$target_user_id,$senderId,$phone,$object){
		global $db;
		$lu = 0;
		$nonLu = 1;
		$data = [
			'message' => $default_msg,
			'targetUserId'=> $target_user_id,
			'senderId'    => $senderId,
			'senderPhone'  => $phone,
			'object' => $object,
			'lu'=> $lu,
			'nonLu'    => $nonLu
		];
	
		$sql = "INSERT INTO messages (message,targetUserId,senderId,senderPhone,object,lu,nonLu,createdDate) 
		VALUES (:message,:targetUserId,:senderId,:senderPhone,:object,:lu,:nonLu,NOW() )";
		$req = $db->prepare($sql);
		$req->execute($data);
	
		return true;
	}

	function get_user_by_id($id){

		global $db;
		$req = $db->query("SELECT * FROM users WHERE users.id ='{$id}'");
		$result = $req->fetchObject();
		return $result;
	}

	// fonction pour gerer les enregistrement sous forme de tableau dans la base de donnee
	function convert_to_real_data($data){
		// On enleve le 1er et dernier caractere de la data recu
		$string = substr($data,1,-1);
		// On retourne un tableau de chaînes de caractères créé en scindant 
		// la chaîne du paramètre string en plusieurs morceaux suivant un separateur (,).
		$tab = explode(",", $string);
		// On recupere un index du tableau de strings cree
		$index_zero_value = $tab[0]; // "valeur"
		// On retire encore les 2 guillemets de debut et fin 
		$original_value = substr($index_zero_value,1,-1);
		// Maintenant on retourne la vraie valeur ou on l'affiche
		return $original_value;
	}


	function get_value_by_index($data,$index){
		// On enleve le 1er et dernier caractere de la data recu
		$string = substr($data,1,-1);
		// On retourne un tableau de chaînes de caractères créé en scindant 
		// la chaîne du paramètre string en plusieurs morceaux suivant un separateur (,).
		$tab = explode(",", $string);
		
		// On recupere un index du tableau de strings cree
		$index_zero_value = $tab[$index]; // "valeur"
		// On retire encore les 2 guillemets de debut et fin 
		$original_value = substr($index_zero_value,1,-1);
		// Maintenant on retourne la vraie valeur ou on l'affiche
		return $original_value;
	}
	
	function get_qte($data){
		// On enleve le 1er et dernier caractere de la data recu
		$string = substr($data,1,-1);
		// On retourne un tableau de chaînes de caractères créé en scindant 
		// la chaîne du paramètre string en plusieurs morceaux suivant un separateur (,).
		$tab = explode(",", $string);
		// On compte les valeurs du tableau
		$qteValeurs = count($tab);
		return $qteValeurs;
	}

	function returnTab($data){
		$string = substr($data,1,-1);
		$tab = explode(",", $string);
		return $tab;
	}