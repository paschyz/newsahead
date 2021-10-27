<?php
session_start();
if( !isset($_POST['comment']) || empty($_POST['comment']) ){
  header('location:../plus.php?message=Commentaire vide.&id='.$_SESSION['id']);
  exit;
}

if( strlen($_POST['comment']) > 1000){
  header('location:../plus.php?message=Commentaire trop long !&id='.$_SESSION['id']);
  exit;
}

include('../config.php');

$q = "INSERT INTO comment (comment_content, comment_writer_username, comment_article_id) VALUES (:contenu, :pseudo, :id)";
$req = $bdd->prepare($q);
$reponse = $req->execute([
  'contenu' => $_POST['comment'],
  'pseudo' => $_SESSION['pseudo'],
  'id' => $_SESSION['id']

]);

if($reponse){

  header('location:../plus.php?message=Commentaire posté ! &id='.$_SESSION['id']);
  exit;
}

?>
