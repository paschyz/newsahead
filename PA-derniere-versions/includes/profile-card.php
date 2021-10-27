<?php
$reponse = $bdd->query("SELECT * FROM user WHERE user_username = '$_SESSION[pseudo]'");
$donnees = $reponse->fetch()
?>
<div class="profile-card">

<div class="card mb-3" style="max-width: 600px;">
  <div class="row g-5">
    <div class="col-md-4">
      <img src="images/<?php echo $donnees['user_avatar']; ?>" style="max-width: 125px;" style="max-height: 125px;" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">

    <?php  if(isset($_SESSION['pseudo'])){
      echo 'Bonjour, ' . '<strong>' .  $donnees['user_username'] . ' </strong> ' ;
    }else{
    echo 'Invité';
  } ?>

  <hr>
        <p class="profile-text"><?php echo $donnees['user_messagecontent']; ?></p>
<p class="profile-text">  <img alt="online" src="images/components/online.png" style="width:12px; height:12px;"><small class="text-muted">En ligne</small></p>
 <?php  if(isset($_SESSION['admin'])){
   echo '<p><strong>' .  $_SESSION['admin'] . ' </strong></p> ' ;
 }else{
 echo '<p>Non administrateur</p>';
 } ?>
<button class="btn btn-outline-secondary" onclick="openModal()">Modifier les informations</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
    role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier les informations</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeModal();window.location.hash = ''">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
              <form action="verification/verification_modifier_informations.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                <label for="formFile" class="form-label">Avatar<b>*</b></label>
                <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
                <div id="imageHelp" class="form-text">L'image/GIF ne doit pas dépasser 2 Mo.</div>
              </div>
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pseudo<b>*</b></label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Example" name="pseudo" value="<?php echo $donnees['user_username']; ?>">
                <div class="form-text">Le pseudo doit faire entre 4 et 20 caractères.</div>
              </div>

                <div class="mb-3">
                <label for="exampleFormControlInput" class="form-label">Adresse mail<b>*</b></label>
                <input type="text" class="form-control" id="exampleFormControlInput" placeholder="Example" name="email" value="<?php echo $donnees['user_email']; ?>">
                <div class="form-text">L'adresse mail doit faire entre 6 et 120 caractères.</div>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Example" name="content" ><?php echo $donnees['user_messagecontent']; ?></textarea>
                <div class="form-text">La description doit faire entre 0 et 40 caractères.</div>
              </div>
              <div class="mb-3">
              <label for="exampleFormControlInput2" class="form-label">Mot de passe<b>*</b></label>
              <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Example" name="password" value="<?php echo $donnees['user_password']; ?>">
              <div class="form-text">Le mot de passe doit faire entre 4 et 32 caractères.</div>
              </div>
              <div class="mb-3">
                <label  class="form-label"><b>*</b> = Champ obligatoire</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier l'article</button>
                </div>
              </form>
            </div>

        </div>
    </div>
</div>
<div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>
      </div>
    </div>
  </div>
</div>
</div>
