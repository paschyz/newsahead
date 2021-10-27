<?php

session_start();


include('../config.php');

$q = "SELECT COUNT(likes_id) AS total FROM likes WHERE article_fk = :id AND likes_username = :pseudo";
$req = $bdd->prepare($q);
$req->execute([
  'pseudo' => $_SESSION['pseudo'],
  'id' => $_SESSION['id']
]);
$resultat = $req->fetch(PDO::FETCH_ASSOC);

if($resultat['total'] != 0){


  $q = "UPDATE article1 SET article_likes = article_likes - 1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  $q = "SELECT article_likes FROM article1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  while ($donnees = $req->fetch()){
    echo $donnees['article_likes'];
  }
  $q = "DELETE FROM likes WHERE article_fk= :id AND likes_username = :pseudo";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
    'pseudo' => $_SESSION['pseudo']
  ]);
}else{
  $q = "UPDATE article1 SET article_likes = article_likes + 1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  $q = "SELECT article_likes FROM article1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  while ($donnees = $req->fetch()){
    echo $donnees['article_likes'];
  }

  $q = "INSERT INTO likes (article_fk, likes_username) VALUES (:id, :pseudo)";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
    'pseudo' => $_SESSION['pseudo']
  ]);

}





?>
