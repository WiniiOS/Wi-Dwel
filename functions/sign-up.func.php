<?php

//check if email is already taken
function email_taken($email){
	global $db;
	$e = ["email" => $email];
	$sql ="SELECT * FROM users WHERE email = :email";
	$req = $db->prepare($sql);
	$req->execute($e);
	$free  = $req->rowCount($sql);
	return $free;
}

#generer un token aleatoire
function token($length){
	$chars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
	//reduction selon la longeur mise en parametre
	substr($chars,0,$length);
	//shuffle pour melanger les chars,repeat pour avoir autant de chars que l'on veut
	return substr(str_shuffle(str_repeat($chars,$length)),0,$length);
}

// recuperer tous nos utilisateurs
function get_users(){

	global $db;
	$req = $db->query("SELECT * FROM users");
	$results = [];
	while($rows = $req->fetchObject()) {
		$results[] = $rows;
	}
	return $results; 
}

//add a user
function add_user($pseudo,$fullName,$email,$telephone,$password,$city,$status){
	global $db;
	$t = [
		'pseudo'  => $pseudo,
		'fullName'    => $fullName,
		'email'   => $email,
		'telephone' => $telephone,
		'password'    => sha1($password),
		'city'   => $city ,
		'status' => $status
	];
	$sql = "INSERT INTO users(pseudo,fullName,email,telephone,password,city,status,signupDate) VALUES(:pseudo,:fullName,:email,:telephone,:password,:city,:status,NOW())";
	$req = $db->prepare($sql);
	$req->execute($t);

	//envoi d'email

	$to       = $email;
	$subject  = "Confirmez votre adresse email";
	$headers  ='From: wi-dwel.com<support@wi-dwel.com>' . "\r\n" .
				'MIME-Version: 1.0' . "\r\n" .
			'Content-Transfert-Encoding:8bits'."\r\n".
			'Content-type: text/html; charset=utf-8';
	$message  = "
	<html>
		<body>
			<div align='center'>
			<h1>Contact Wi-Dwel - Reseau social de bailleurs et locataire en afrique</h2>
			<p>
				Veuillez cliquer sur ce lien pour confirmer votre adresse e-mail <a href=\"http://appwidwel.apps-empire.com\">cette page</a>
				'<br/>Identifiant'.$email.'
				
			</p>
				<img alt='banniere xfreelance' src='../img/developpeur.png'>
			</div>
		</body>
	</html>";

	// sendMail($to,$subject, $message, $headers);
	
}

function sendMail($to,$subject, $message, $headers){
	if(mail($to, $subject, $message, $headers))
	{
		$errors['success'] = "<span color='green'>**Votre message a bien ete envoye!**</span> ";
	}
	else{
		$errors['echec'] ="<span color='red'>**Echec lors de l'envoi de l'e-mail**</span>";
	}
}

















// if(isset($_POST['send'])){
//     if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['retype_password']) && isset($_POST['name'])){
// 		if(isset($_POST['city']) && isset($_POST['status'])){

// 			// global $db;

// 			$pseudo = htmlspecialchars($_POST['pseudo']);
// 			$email  = htmlspecialchars($_POST['email']); 
// 			$password  = htmlspecialchars(password_hash($_POST['password']));
// 			$retype_password  = htmlspecialchars(password_hash($_POST['password']));
// 			$name   = htmlspecialchars($_POST['fullName']);
// 			$city   = htmlspecialchars($_POST['city']);
// 			$statut = htmlspecialchars($_POST['status']);

// 			$sql = "SELECT * FROM users WHERE email = ? ";
// 			$req = $db->prepare($sql);
// 			$req->excute(array($email));
// 			$data = $req->fetch();
// 			$row  = $check->rowCount();

// 			if($row == 0){
// 				// on peut l'inscrire
// 				if(strlen($pseudo) <= 100){
// 					if(filter_var($email,FILTER_VALIDATE_EMAIL)){
// 						if($password == $retype_password){

// 							$sql = "INSERT INTO users(pseudo,fullName,email,password,city,status) VALUES(:pseudo,:fullName,:email,:password,:city,:statut)";
// 							$req = $db->prepare($sql);
// 							$req->execute(
// 								array('pseudo'=>$pseudo,'fullName'=>$fullName,'email' =>$email,
// 								'password'=>$password,'city' => $city,'status'=> $statut 
// 							));
// 							header('Location:index.php?page=login');
// 						}else{
// 							$msg = "vos 2 mots de passe ne correspondent pas!";
// 						}
// 					}else{
// 						$msg = "Email non valide!";
// 					}
// 				}else{
// 					$msg = "Votre pseudo ne doit pas depasser 100 caracteres";
// 				}
// 			}else{
// 				// L'utilisateur existe deja
// 				$msg = "Un utilisateur existe deja avec cette adresse email";
// 			}
// 		}else{
// 			$msg = "veuillez definir votre statut ou votre ville";
// 		}
// 	}else{
// 		$msg = "veuillez renseigner toutes les informations obligatoires";
// 	}
// }