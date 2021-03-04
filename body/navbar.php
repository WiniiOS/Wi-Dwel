<nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?page=home">
    <img width="62" height="45" src="assets/logo-white.png" alt="LOGO">
    <!-- <img width="90" height="90" src="assets/logo-white.png" alt="logo"> -->
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#widwel-navbar" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse right"  id="widwel-navbar">
	  <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="annonce">
        <a class="nav-link <?php echo ($page =='post')? "active" : ""; ?>" href="index.php?page=post"><i class="bi bi-plus"></i> <?= gettext('POSTER VOTRE ANNONCE') ?> </a>
      </li>

      <?php
        if(!isset($_SESSION['auth'])){
      ?>

      <li class="nav-item">
        <a class="nav-link <?php echo ($page=='login')?"active" : ""; ?>" href="index.php?page=login"><i class="bi bi-person-circle"></i> <?= _('CONNEXION') ?> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo ($page=='sign-up')?"active" : ""; ?>" href="index.php?page=sign-up"><i class="bi bi-door-closed"></i> <?= _('INSCRIPTION') ?> </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FR</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="index.php?lang=fr_FR"><?= _('Francais') ?></a>
          <a class="dropdown-item" href="index.php?lang=en_US"> <?= _('Anglais') ?></a>
        </div>
      </li>
      <?php } ?>

      <?php
        if(isset($_SESSION['auth'])){
          $profil = get_user_data();
      ?>
      <li class='nav-item'>
        <a class="nav-link <?php echo ($page=='messages')?"active" : ""; ?>" href="index.php?page=messages&type=recu"><i class="bi bi-envelope"></i></a>
      </li>
		  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-filter-left"></i> <?= _('MENU') ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item <?php echo ($page=='rate')?"active" : ""; ?>" href="index.php?page=rate"><i class="bi bi-star"></i> <?= _('Annotations') ?> </a>
          <!-- <a class="dropdown-item <?php echo ($page=='services')?"active" : ""; ?>" href="index.php?page=services"><i class="bi bi-exclude"></i> Facilités</a> -->
          <a class="dropdown-item <?php echo ($page=='map')?"active" : ""; ?>" href="index.php?page=map"><i class="bi bi-geo"></i> <?= _('Cartes') ?> </a>
        </div>
      </li>
      
      <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-fill"></i> <?= $profil->pseudo ;?>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item <?php echo ($page=='favoris')?"active" : ""; ?>" href="index.php?page=favoris&type=all"><i class="bi bi-heart-fill"></i> <?= _('Favoris') ?> </a>
          <a class="dropdown-item <?php echo ($page=='profil')?"active" : ""; ?>" href="index.php?page=profil"><i class="bi bi-person"></i> Profil</a>
          <a class="dropdown-item <?php echo ($page=='edit')?"active" : ""; ?>" href="index.php?page=edit&type=perso"><i class="bi bi-person-circle"></i> <?= _('Editer mon profil') ?> </a>
          <a class="dropdown-item " href="index.php?page=logout"><i class="bi bi-power"></i> <?= _('Déconnexion') ?> </a>
        </div>
      </li>

      <?php } ?>

    </ul>

  </div>

</nav>