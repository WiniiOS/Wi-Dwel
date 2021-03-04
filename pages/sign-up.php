<?php

    if(isset($_POST['send'])){

        $pseudo             = htmlspecialchars(trim($_POST['pseudo']));
        $fullName           = htmlspecialchars(trim($_POST['fullName']));
        $email              = htmlspecialchars(trim($_POST['email']));
        $telephone          = htmlspecialchars(trim($_POST['telephone']));
        $password           = htmlspecialchars(trim($_POST['password']));
        $retype_password    = htmlspecialchars(trim($_POST['retype_password']));
        $city               = htmlspecialchars(trim($_POST['city']));
        $status             = htmlspecialchars(trim($_POST['status']));
        $errors = [];

        if (empty($pseudo) || empty($fullName) || empty($email) || empty($telephone) || empty($password) || empty($retype_password) || empty($city) || empty($status)) {
            $errors['email'] = "Veuillez remplir tous les champs!";
        }

        if ($password != $retype_password){
            $errors['different'] = "Vos mots de passe ne correspondent pas!";
        }

        #verifions si l'email est deja pris
        if (email_taken($email)) {
            $errors['taken'] ="Un compte a deja ete crée avec cette adresse email !";
        }

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
            add_user($pseudo,$fullName,$email,$telephone,$password,$city,$status);
            ?>

            <div class="alert alert-danger">
                <strong class='text-success'>Success: </strong> Veuillez vous connecter!
            </div>

            <script>
                document.location.href= "index.php?page=login";
            </script>
            
            <?php
        }

    }

?>

<main style="" class="mt-5 mb-5">
    <h3 class="text-center my-4">S'INSCRIRE</h3>
    <form class="form-sign-up" method='POST'>
       
        <div class="form-row">
            <div class="form-group col-md-6 ">
            <label for="pseudo ">Pseudo</label>
            <input name='pseudo' type="text" class="form-control" id="pseudo" >
            </div>
            <div class="form-group col-md-6">
            <label for="name" >Nom Complet</label>
            <input name='fullName' type="text" class="form-control" id="name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email ">Email</label>
                <input name='email' type="email" class="form-control" id="email" >
            </div>
            <div class="form-group col-md-6">
                <label for="telephone ">Telephone</label>
                <input name='telephone' type="number" class="form-control" id="telephone" placeholder="+237">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="password ">Mot de passe</label>
                <input name='password' type="password" class="form-control" id="password">
            </div>
            <div class="form-group col-md-6">
                <label for="retype_password">Confirmez votre Mot de passe</label>
                <input type="password" class="form-control" name="retype_password" id="retype_password" >
            </div>
        </div>
        <div class="form-row">
   
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <select required name='city' class="form-control" id="inputCity">
                    <option value='Yaounde' class='text-dark'>Yaounde</option>
                    <option value='Douala' class='text-dark'>Douala</option>
                    <option value='Bertoua' class='text-dark'>Bertoua</option>
                    <option value='Kribi' class='text-dark'>Kribi</option>
                    <option value='Garoua' class='text-dark'>Garoua</option>
                    <option value='Bamenda' class='text-dark'>Bamenda</option>
                    <option value='Ngaoundere' class='text-dark'>Ngaoundere</option>
                    <option value='Bafoussam' class='text-dark'>Bafoussam</option>
                    <option value='Dschang' class='text-dark'>Dschang</option>
                    <option value='Limbe' class='text-dark'>Limbe</option>
                    <option value='Maroua' class='text-dark'>Maroua</option>
                    <option value='Ebolowa' class='text-dark'>Ebolowa</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputState">Statut</label>
                <select name='status' id="inputState" class="form-control">
                    <option value="locataire" class="text-dark">Locataire</option>
                    <option value="bailleur" class="text-dark">Bailleur</option>
                    <option value="agent-immobilier" class="text-dark">Agent Immobilier</option>
                </select>
            </div>

        </div>

        <button name='send' class="btn btn-lg btn-info btn-block" type="submit">Inscription</button>
        <p class="mb-4 mt-3 mb-3 text-dark text-center"><a class="mb-4 mt-3 mb-3 " href="index.php?page=login">VOUS AVEZ DEJA UN COMPTE</a></p>
    </form>
</main>