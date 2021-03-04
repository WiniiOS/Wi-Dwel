<?php 

    // on fait la connexion automatique au cas ou le user avait deja defini ses coockies
    coockiesConnect();
?>
<main > 
    <form class="form-signin" method='POST'>
        <div class="container text-center">
            <img class="mb-4 mt-5" src="assets/logo-white.png" alt="LOGO" width="200" height="150">
            <h1 class="mb-3 h3 font-weight-normal">Connectez vous!</h1>

            <!-- <label for="inputEmail" class="sr-only">Addresse email ou pseudo</label> -->
            <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Votre adresse email" autofocus>
            <!-- <label for="inputPassword" class="sr-only">Password</label> -->
            <input type="password" id="inputPassword" class="form-control" name='password' placeholder="Votre mot de passe">
            <div class="checkbox mb-3">
            <br><br>
            <input id='remember-me' name='remember-me' type="checkbox"  value="remember-me"><label for='remember-me'>Se souvenir de moi</label>
            </div>
            <button name="send" id="send" class="btn btn-lg btn-info btn-block" type="submit">Connexion</button>
            <p class="mb-5 mt-4 mb-3 text-dark"><a class="mb-4 mt-3 mb-3" href="index.php?page=sign-up">CREER UN COMPTE</a></p>
        </div>
    </form>
</main>