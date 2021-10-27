<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<?php
$title = 'Créer';
include('includes/head.php'); ?>

<?php include('includes/header.php'); ?>
<body>

  <section id="section-Créer">
    <?php
    if(isset($_GET['message']) && !empty($_GET['message'])){
      echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
    }
    ?>
    <form action="verification/verification_creerarticle.php" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label  class="form-label">Image d'illustration<b>*</b></label>
        <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
        <div id="imageHelp" class="form-text">L'image/GIF ne doit pas dépasser 2 Mo.</div>
      </div>

      <div class="mb-3">
        <label  class="form-label">Titre de l'article<b>*</b></label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Example" name="titre">
        <div id="titleHelp" class="form-text">Le titre doit faire entre 1 et 64 caractères.</div>
      </div>
      <div class="mb-3">
        <label  class="form-label">Contenu de l'article</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="contenu"></textarea>
        <div id="contentHelp" class="form-text">Le contenu doit faire entre 0 et 1000 caractères.</div>
      </div>

      <div class="mb-3">
        <label  class="form-label">Mot-clé<b>*</b></label>
        <input type="text" class="form-control" id="exampleFormControlInput" placeholder="Example" name="motcle">
        <div id="motcleHelp" class="form-text">Le mot-clé doit commencer avec une majuscule au début, et faire entre 1 et 20 caractères.</div>
      </div>
      <div class="mb-3">
        <label  class="form-label"><b>*</b> = Champ obligatoire</label>
      </div>
      <button type="submit" class="btn btn-primary">Créer</button>
    </form>
  </section>

</body>

<?php include('includes/footer.php'); ?>

</html>
