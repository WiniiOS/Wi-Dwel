
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
<a class="navbar-brand" href="#">Wi Dwel</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="../pages/home.html">Accueil <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">A Propos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#">Notifications</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-heart"></span> Settings</a>
      <div class="dropdown-menu" aria-labelledby="dropdown01">
        <a class="dropdown-item" href="#">Status</a>
        <a class="dropdown-item" href="#">Changer de numero</a>
        <a class="dropdown-item" href="#">Changer de quartier</a>
      </div>
    </li>
  </ul>
  <form class="form-inline mt-2 mt-md-0">
    <input class="form-control mr-sm-2" type="text" placeholder="Recherche" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
  </form>
</div>
</nav>


<script>
  /*Pour swiper la navbar */
  window.jQuery || document.write('<script src="../bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="../bootstrap/dist/js/bootstrap.min.js"></script>