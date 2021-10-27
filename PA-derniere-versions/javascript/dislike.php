<?php

session_start();


include('../config.php');

$q = "SELECT COUNT(dislikes_id) AS total FROM dislikes WHERE article_fk = :id AND dislikes_username = :pseudo";
$req = $bdd->prepare($q);
$req->execute([
  'pseudo' => $_SESSION['pseudo'],
  'id' => $_SESSION['id']
]);
$resultat = $req->fetch(PDO::FETCH_ASSOC);

if($resultat['total'] != 0){


  $q = "UPDATE article1 SET article_dislikes = article_dislikes - 1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  $q = "SELECT article_dislikes FROM article1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  while ($donnees = $req->fetch()){
    echo $donnees['article_dislikes'];
  }
  $q = "DELETE FROM dislikes WHERE article_fk= :id AND dislikes_username = :pseudo";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
    'pseudo' => $_SESSION['pseudo']
  ]);
}else{
  $q = "UPDATE article1 SET article_dislikes = article_dislikes + 1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  $q = "SELECT article_dislikes FROM article1 WHERE id_article=:id";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
  ]);


  while ($donnees = $req->fetch()){
    echo $donnees['article_dislikes'];
  }

  $q = "INSERT INTO dislikes (article_fk, dislikes_username) VALUES (:id, :pseudo)";
  $req = $bdd->prepare($q);
  $req->execute([
    'id' => $_SESSION['id'],
    'pseudo' => $_SESSION['pseudo']
  ]);

}





?>
