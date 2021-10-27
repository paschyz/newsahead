<!DOCTYPE html>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/index.php">
        <img alt="logo" src="/images/components/logo.jpg" width="50" height="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?php $class = $title == 'Accueil' ? 'active' : '';
          echo '<li class="nav-item"><a class="nav-link ' . $class . '"  href="index.php">Accueil</a></li>';
          ?>
          <?php
          if (isset($_SESSION['email'])){
            $class = $title == 'Mon profil'?'active':'';
            echo '<li class="nav-item"><a class="nav-link ' . $class . '"  href="profil.php">Mon profil</a></li>';
            $class = $title == 'Enregistrés' ? 'active' : '';
            echo '<li class="nav-item"><a class="nav-link ' . $class . '" href="enregistres.php">Enregistrés</a></li>';

            echo '<form class="d-flex">
            <input class="form-control me-2" autocomplete="off" id="searchBox" oninput=search(this.value) type="text" name="name" placeholder="Search">
            </form>';
            $class = $title == 'Créer' ? 'active' : '';
            echo '<li class="nav-item"><a class="nav-link ' . $class . '" href="creerarticle.php">Créer un article</a></li>';
            $class = $title == 'Code' ? 'active' : '';
            echo '<li class="nav-item"><a class="nav-link ' . $class . '" href="code.php">Entrer un code</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="deconnexion.php">Se déconnecter</a></li>';

          }else{
            $class = $title == 'Connexion' ? 'active' : '';
            echo '<li class="nav-item"><a class="nav-link ' . $class . '" href="connexion.php">Connexion</a></li>';
            $class = $title == 'Inscription' ? 'active' : '';
            echo '<li class="nav-item"><a class="nav-link ' . $class . '" href="inscription.php">Inscription</a></li>';
            echo '<form class="d-flex">
            <input class="form-control me-2" autocomplete="off" id="searchBox" oninput=search(this.value) type="text" name="name" placeholder="Search">
            </form>';

          }
          ?>
        </ul>

        </div>
      </div>
    </div>
  </nav>
  <div id="dataViewer" class="card" style="margin-left: 20rem; width:18rem; z-index: 1001;">
  </div>
</nav>
</header>
