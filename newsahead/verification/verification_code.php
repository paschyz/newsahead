<?php
session_start();
$key='62=w:vuJ6obrkyo[lVc{*bEv<%{{EFNIv,grqJj$<((p5dE#G&*8Nx?{BgmSB05';
$key1='I love ESGI !';

if( ($_POST['code']) == $key1 ){
  header('location:../code.php?secret=Bravo!!&message=Mais où sont nos pizzas ?');
  exit;
}


  if( ($_POST['code']) != $key ){
    header('location:../code.php?message=Code invalide.');
    exit;
  }

  include('../config.php');

  $q = "UPDATE user SET user_admin = 1 WHERE user_username = :pseudo ";
  $req = $bdd->prepare($q);
  $reponse = $req->execute([
    'pseudo' => $_SESSION['pseudo'],
  ]);


  if($reponse){
    header('location:../code.php?message=Code valide ! Vous voilà administrateur !');
    exit;
  }else{header('location:creerarticle.php?message=Probleme.');}
  ?>
