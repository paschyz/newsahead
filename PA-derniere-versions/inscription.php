<!DOCTYPE html>
<html lang="fr" dir="ltr">

<?php
$title = 'Inscription';
include('includes/head.php'); ?>

<?php include('includes/header.php'); ?>
<body>

  <section id="section-Inscription">
    <?php
    if(isset($_GET['message']) && !empty($_GET['message'])){
      echo '<div style="max-width:24em;"><h5>' . htmlspecialchars($_GET['message']) . '</h5></div>';
    }
    ?>
    <form action="verification/verification_inscription.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse mail<b>*</b></label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="votre_email@gmail.com" name="email">
        <div id="emailHelp" class="form-text">L'adresse mail doit faire entre 6 et 120 caractères.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Pseudo<b>*</b></label>
        <input type="text" class="form-control" id="exampleInputPseudo1" aria-describedby="pseudoHelp" name="pseudo">
        <div id="pseudoHelp" class="form-text">Le pseudo doit faire entre 4 et 20 caractères.</div>
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe<b>*</b></label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        <div id="pwdHelp" class="form-text">Le mot de passe doit faire entre 4 et 32 caractères.</div>
      </div>
      <div class="mb-3">
        <label for="formFile" class="form-label">Image d'illustration<b>*</b></label>
        <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
        <div id="imageHelp" class="form-text">L'image/GIF ne doit pas dépasser 2 Mo.</div>
      </div>
      <div class="mb-3">
        <label for="exampleCaptcha1" class="form-label">Captcha<b>*</b></label>
        <input disabled type="text" class="form-control" id="exampleCaptcha1" name="captcha" value="Captcha non validé">
      </div>

      <div class="col-12">
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label"><b>*</b> = Champs obligatoires</label>
          <p class="help"><a href="connexion.php">Vous avez déjà un compte ?</a></p>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
          <label class="form-check-label" for="invalidCheck">
            <a href="https://www.droitissimo.com/contrat/conditions-generales-dutilisation-cgu-dun-site-internet" target="_blank">Accepter les termes et les conditions générales d'utilisation<b>*</a></b>
          </label>

          <div class="invalid-feedback">
            Vous devez accepter les termes et les conditions générales d'utilisation avant de vous inscrire.
          </div>
        </div>
        <br>
        <button id="inscriptionSubmit" disabled class="btn btn-primary" type="submit">S'inscrire</button>
      </div>







    </form>


    <br>
    <div class="captcha-container">
      <div class="header">Vérification de sécurité</div>
      <div class="securityCode">
        <p id="code">aeza514</p>
        <div class="icons">
          <span class="readText">
            <i class="fas fa-headphones"></i>
          </span>
          <span class="changeText">
            <i class="fas fa-sync-alt"></i>
          </span>
        </div>
      </div>
      <div class="userInput">
        <input autocomplete="off" name="captcha" type="text" placeholder="Tapez le texte ici">
        <button id="btn" class="btn" type="submit">Soumettre</button>
      </div>
    </div>







  </section>
  <script src="https://code.responsivevoice.org/responsivevoice.js"></script>
  <script src="script.js"></script>
  <script>
  submitBtn.addEventListener('click', () => {
    let val = input.value ;
    if (val == '') {
      alert("Entrez du texte s'il vous plait");

    }else if (val === code.textContent) {
      alert('Code validé !') ;
      const el = document.getElementById("exampleCaptcha1");
      el.setAttribute("value", "Captcha validé ! Tu peux maintenant t'inscrire !");
      el.disabled= false;

      const check = document.getElementById("inscriptionSubmit");
      check.disabled=false;
    }else{
      alert('Code Invalide...');
    }
  })
  readTextBtn.addEventListener('click', () => {
    let text = code.textContent ;
    responsiveVoice.speak(text);
  })


  function openModal() {
    document.getElementById("backdrop").style.display = "block"
    document.getElementById("exampleModal").style.display = "block"
    document.getElementById("exampleModal").classList.add("show")
  }
  function closeModal() {
    document.getElementById("backdrop").style.display = "none"
    document.getElementById("exampleModal").style.display = "none"
    document.getElementById("exampleModal").classList.remove("show")
  }

  var modal = document.getElementById('exampleModal');

  window.onclick = function(event) {
    if (event.target == modal) {
      closeModal()
    }
  }

</script>
</body>

<?php include('includes/footer.php'); ?>

</html>
