<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<?php
$title = 'Mon profil';
include('includes/head.php'); ?>

<?php include('includes/header.php'); ?>
<?php include('config.php'); ?>
<body>
  <?php include('includes/profile-card.php'); ?>

  <div class="indication" style="position: absolute; top:100px; left:425px;"><h5>Articles crées par l'utilisateur:<h5></div>
    <?php
    if(isset($_GET['message']) && !empty($_GET['message'])){ echo '<div style="position: absolute; top:100px; left:725px;"><h5>' . htmlspecialchars($_GET['message']) . '</h5></div>';}
    ?>
    <?php include('includes/trash.php'); ?>

    <?php include('includes/profile-article.php'); ?>



    <script>

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
