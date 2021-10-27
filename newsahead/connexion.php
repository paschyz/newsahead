<!DOCTYPE html>
<html lang="fr" dir="ltr">

<?php
$title = 'Connexion';
include('includes/head.php'); ?>

<?php include('includes/header.php'); ?>
<body>

  <section id="section-Connexion">
    <?php
    if(isset($_GET['message']) && !empty($_GET['message'])){
      echo '<div style="max-width:24em;"><h5>' . htmlspecialchars($_GET['message']) . '</h5></div>';
    }
    ?>
    <form action="verification/verification_connexion.php" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" >Adresse mail<b>*</b></label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="votre_email@gmail.com" >
      </div>
      <div class="mb-3">
        <label for="exampleInputPsuedo1" class="form-label">Pseudo<b>*</b></label>
        <input name="pseudo" type="text" class="form-control" id="exampleInputPsuedo1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe<b>*</b></label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label"><b>*</b> = Champs obligatoires</label>
        <p class="help"><a href="inscription.php">Vous n'avez pas de compte ?</a></p>
      </div>

      <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

  </section>

</body>

<?php include('includes/footer.php'); ?>

</html>
