<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">


<?php
$title = 'Enregistrés';
include('includes/head.php'); ?>

<?php include('includes/header.php'); ?>
<?php include('config.php'); ?>


<body>

  <?php
  $reponse = $bdd->query('SELECT * FROM tendances ');
  ?>

  <div class="card bg-dark text-white" style="position:absolute; top:150px; left:30px;">
    <img src="images/components/istockphoto.jpg" class="card-img" alt="...">
    <div class="card-img-overlay">
      <br>
      <h4 class="card-title" style="color:black">Enregistrés</h4>

      <br>
      <p class="card-text" style="color:black">Vous retrouverez ici tous les articles que vous avez liké.</p>
    </div>
  </div>

  <?php include('includes/trash.php'); ?>
  <?php include('includes/enregistres-article.php'); ?>






</body>

<?php include('includes/footer.php'); ?>

</html>
