
<?php
$reponse = $bdd->query('SELECT * FROM tendances ORDER BY tendency_number DESC LIMIT 4');
?>

<div class="list-group col-md-2" id="tendances">
  <a class="list-group-item list-group-item-action d-flex w-100" style="background-color: #0673EF; color:white;"><h1>En tendance</h1></a>
  <?php

  while ($donnees = $reponse->fetch())
  {
    ?>

    <a href="#" class="list-group-item list-group-item-action ">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1"><?php echo $donnees['tendency_name']; ?></h5>
        <small>Il y a <?php dateDifference($date->format('Y-m-d H:i:s'),$donnees['tendency_time'] ); ?> </small>
      </div>
      <p class="mb-1"><?php echo $donnees['tendency_number']; ?>
        <?php  if($donnees['tendency_number']>1){
          echo " articles";
        }else{

          echo " article";
        }
        ?>


      </p>

    </a>




    <?php
  }
  ?>
</div>

<?php

$reponse->closeCursor();

?>
