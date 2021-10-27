<!DOCTYPE html>
<?php
session_start();
?>


<html lang="fr" dir="ltr">


<?php
$title = 'Accueil';
include('includes/head.php'); ?>

<?php include('includes/header.php'); ?>
<?php include('config.php'); ?>

<body>
  <?php include('includes/tendances.php'); ?>
  <?php include('includes/trash.php'); ?>
  <?php include('includes/articles.php'); ?>









</body>

<?php include('includes/footer.php'); ?>

</html>
