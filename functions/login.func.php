<?php 
        //on traite le formulaire avant d'appeler les balise html a cause du coockie qui doit etre appelee 
        // avant sinon erreur! 
     // on traite le formulaire au cas ou c'est la premiere connexion
     if (isset($_POST['send'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        #on ne hash pas ici car la char est encore vide mais sha1 donne des results sur des chars vide
        $password = htmlspecialchars(trim($_POST['password']));
        $errors = [];

        if (empty($email || $password)) {
            $errors['empty'] = 'Tous les champs doivent etre remplis!'; 
        }else if(is_user($email,$password) == 0) { #si resultats null,alors:
            $errors['exist'] = "Cet utilisateur n'existe pas!";
        }

        #s'il ya des erreurs
        if (!empty($errors)) { 
        ?>
        <div class="alert alert-danger">
        <?php                   
            foreach($errors as $error){
                echo "<strong class='text-danger'>Erreur: </strong> ".$error."<br/>";
            }
        ?>
        </div>
        <?php

        }else{

            // gerer la remember feature
            if(isset($_POST['remember-me'])){ #si la checkbox est validé 
                setcookie('email',$email,time()+365*24*3600,null,null,false,true); //un an
                setcookie('password',sha1($password),time()+365*24*3600,null,null,false,true); //un an
                
            }

            #suite des opperations d'authenfication
            $req = $db->query("SELECT * FROM users WHERE users.email ='{$email}'");
            $user_info = $req->fetchObject();
            $_SESSION['pseudo'] = $user_info->pseudo;
            $_SESSION['auth'] = $email;
            $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
            
            //rediriger vers l'accueil:il y aura un pb car le header ne fonctionne pas si on a deja affiche du contenu
            ?>
            <script>
                document.location.href= "index.php?page=home";
            </script>
            <?php
        }
    }

    #verifier que l'utilisateur a un compte en base de donnees
    function is_user($email,$password)
    {
        global $db;
        $a = [
            'email'     => $email,
            'password'  => sha1($password)
        ];

        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $req = $db->prepare($sql);
        $req->execute($a);
        #compter le nombre de resultats
        $exist = $req->rowCount($sql);
        return $exist;
    }


    function coockiesConnect(){
        global $db; 

		if (!isset($_SESSION['auth']) AND isset($_COOKIE['email'],$_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password'])) {
            
            $req = $db->query("SELECT * FROM users WHERE users.email ='{$_COOKIE['email']}'");
            $user_info = $req->fetchObject();
            
            $_SESSION['auth'] = $_COOKIE['email'];
            $_SESSION['pseudo'] = $user_info->pseudo;
            // $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
            // on redirige vers le fil d'actu
            ?>
                <script> document.location.href= "index.php?page=home"; </script>            
            <?php
        }
	}