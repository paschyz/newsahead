<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<?php
$title = 'Code';
include('includes/head.php');
include('includes/header.php'); ?>
<body>
  <section id="section-Code">
    <?php if(isset($_GET['message']) && !empty($_GET['message'])){
      echo '<p style="position:relative; left: 6em; color:hotpink; font-weight:bold; font-size:2em; font-family:Arial, sans-serif">' . htmlspecialchars($_GET['message']) . '</p>';
    }   ?>

    <?php if(isset($_GET['secret']) && !empty($_GET['secret'])){
      echo '<div style="position:relative; left: 4.5em;" class="col-md-4">
        <img src="images/components/image00.jpg" style="width: 650px; max-height:9999px;" alt="????">
      </div>';
    }   ?>




    <form action="verification/verification_code.php" method="post">

      <div class="mb-3">
        <label for="exampleInputCode1" class="form-label">Entrer un code</label>
        <input autocomplete="off" name="code" type="text" class="form-control" id="exampleInputCode1">
      </div>

      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

  </section>

</body>

<?php include('includes/footer.php'); ?>

</html>
