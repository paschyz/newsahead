<?php
session_start();

function starts_with_upper($str) {
  $chr = mb_substr ($str, 0, 1, "UTF-8");
  return mb_strtolower($chr, "UTF-8") != $chr;
}


if( !file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']) || !isset($_POST['titre']) || empty($_POST['titre']) || !isset($_POST['motcle']) || empty($_POST['motcle'])){
  header('location:../plus.php?message=Vous devez remplir les champs obligatoires&id='.$_SESSION['id']);
  exit;
}
if(strlen($_POST['titre']) < 1 || strlen($_POST['titre']) > 64){
  header('location:../plus.php?message=Le titre doit être compris entre 1 et 64 caractères.&id='.$_SESSION['id']);
  exit;
}
if(strlen($_POST['contenu']) > 1000 ){
  header('location:../plus.php?message=Contenu trop long.&id='.$_SESSION['id']);
  exit;
}
if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
  $acceptable = ['gif','jpeg','jpg','png'];
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

  if(!in_array($ext, $acceptable)){
    header('location:../plus.php?message=Le fichier n\'est pas du bon type.&id='.$_SESSION['id']);
    exit;
  }

  $maxSize = 2 * 1024 * 1024;

  if($_FILES['image']['size'] > $maxSize){
    header('location:../plus.php?message=Le fichier est trop lourd.&id='.$_SESSION['id']);
    exit;
  }

  $path = '../images';

  if(!file_exists($path)){
    mkdir($path, 0777);
  }

  $destination = $path . '/' . $_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'], $destination);
}

if(strlen($_POST['motcle']) > 20){
  header('location:../plus.php?message=Mot-clé trop long.&id='.$_SESSION['id']);
  exit;
}

if(!starts_with_upper($_POST['motcle'])){
  header('location:../plus.php?message=Format du mot-clé incorrect.&id='.$_SESSION['id']);
  exit;
}



include('../config.php');

$q = "SELECT COUNT(tendency_id) AS total FROM tendances WHERE tendency_name = :motcle";
$req = $bdd->prepare($q);
$req->execute([
  'motcle' => $_POST['motcle']
]);

$resultat = $req->fetch(PDO::FETCH_ASSOC);


if($resultat['total'] == 0){

  $q = "INSERT INTO tendances (tendency_name) VALUES (:motcle)";
  $req = $bdd->prepare($q);
  $reponse = $req->execute([
    'motcle' => $_POST['motcle']
  ]);
}



$rand = rand(1 , 4);

$q = "UPDATE article1 SET article_title = :titre, article_content= :contenu, article_image = :image, article_keyword = :motcle WHERE id_article = :id;";
$req = $bdd->prepare($q);
$reponse = $req->execute([
  'titre' => $_POST['titre'],
  'contenu' => $_POST['contenu'],
  'image' => $_FILES['image']['name'],
  'motcle' => $_POST['motcle'],
  'id' => $_SESSION['id']
]);


if($reponse){
  header('location:../plus.php?message=Article modifié! Vous pouvez dès maintenant le consulter sur votre profil et il sera consultable sur l\'accueil.&id='.$_SESSION['id']);
  exit;
}else{header('location:../plus.php?message=Probleme.&id='.$_SESSION['id']);}
?>
