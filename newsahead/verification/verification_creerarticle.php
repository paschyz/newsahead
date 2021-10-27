<?php
session_start();

function starts_with_upper($str) {
  $chr = mb_substr ($str, 0, 1, "UTF-8");
  return mb_strtolower($chr, "UTF-8") != $chr;
}



if( !file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']) || !isset($_POST['titre']) || empty($_POST['titre']) || !isset($_POST['motcle']) || empty($_POST['motcle']) ){
  header('location:../creerarticle.php?message=Vous devez remplir les champs obligatoires.');
  exit;
}

if(strlen($_POST['titre']) > 64){
  header('location:../creerarticle.php?message=Titre trop long.');
  exit;
}

if(strlen($_POST['contenu']) > 1000 ){
  header('location:../creerarticle.php?message=Contenu trop long');
  exit;
}

if(strlen($_POST['motcle']) > 20){
  header('location:../creerarticle.php?message=Mot-clé trop long.');
  exit;
}

if(!starts_with_upper($_POST['motcle'])){
  header('location:../creerarticle.php?message=Format du mot-clé incorrect.');
  exit;
}



if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){


  $acceptable = ['gif','jpeg','jpg','gif','png', 'JPG'];
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  if(!in_array($ext, $acceptable)){

    header('location:../creerarticle.php?message=Le fichier n\'est pas du bon type.');
    exit;
  }



  $maxSize = 2 * 1024 * 1024;

  if($_FILES['image']['size'] > $maxSize){

    header('location:../creerarticle.php?message=Le fichier est trop lourd.');
    exit;
  }

  $path = '../images';


  if(!file_exists($path)){
    mkdir($path, 0777);
  }


  $destination = $path . '/' . $_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'], $destination);

}






include('../config.php');

$q = "SELECT COUNT(tendency_id) AS total FROM tendances WHERE tendency_name = :motcle";
$req = $bdd->prepare($q);
$req->execute([
  'motcle' => $_POST['motcle']
]);

$resultat = $req->fetch(PDO::FETCH_ASSOC);


if($resultat['total'] != 0){
  $q = "UPDATE tendances SET tendency_number = tendency_number + 1 WHERE tendency_name = :motcle";
  $req = $bdd->prepare($q);
  $req->execute([
    'motcle' => $_POST['motcle']
  ]);

}else{
  $q = "INSERT INTO tendances (tendency_name) VALUES (:motcle)";
  $req = $bdd->prepare($q);
  $reponse = $req->execute([
    'motcle' => $_POST['motcle']
  ]);
}



$rand = rand(1 , 4);

$q = "INSERT INTO article1 (article_column, article_title, article_content, article_image, article_writer_username, article_keyword) VALUES ($rand, :titre, :contenu, :image, :pseudo, :motcle)";
$req = $bdd->prepare($q);
$reponse = $req->execute([
  'titre' => $_POST['titre'],
  'contenu' => $_POST['contenu'],
  'image' => $_FILES['image']['name'],
  'pseudo' => $_SESSION['pseudo'],
  'motcle' => $_POST['motcle']
]);





if($reponse){
  header('location:../creerarticle.php?message=Article créé! Vous pouvez dès maintenant le consulter sur votre profil et il sera consultable sur l\'accueil.');
  exit;
}else{header('location:../creerarticle.php?message=Probleme.');}
?>
