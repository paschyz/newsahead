<?php
session_start();

if( !file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']) || !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['pseudo'])
|| empty($_POST['pseudo']) ){
  header('location:../profil.php?message=Vous devez remplir tous les champs.');
  exit;
}


if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  header('location:../profil.php?message=Format de l\'email invalide.');
  exit;
}

$em=trim($_POST['email']);

if(strpos($em, ' ') || $_POST['email'] != $em){
  header('location:../profil.php?message=L\'adresse mail ne doit pas contenir d\'espaces');
  exit;
}

if(strlen($_POST['email']) < 6 || strlen($_POST['email']) > 120){
  header('location:../profil.php?message=L\'adresse mail doit être comprise entre 6 et 120 caractères');
  exit;
}

$psd=trim($_POST['pseudo']);

if(strpos($psd, ' ') || $_POST['pseudo'] != $psd){
  header('location:../profil.php?message=Le pseudo ne doit pas contenir d\'espaces');
  exit;
}

if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){
  header('location:../profil.php?message=Le pseudo doit être compris entre 4 et 20 caractères');
  exit;
}

$pwd=trim($_POST['password']);

if(strpos($pwd, ' ') || $_POST['password'] != $pwd){
  header('location:../profil.php?message=Le mot de passe ne doit pas contenir d\'espaces');
  exit;
}

if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 32){
  header('location:../profil.php?message=Le mot de passe doit être compris entre 4 et 32 caractères');
  exit;
}

if(strlen($_POST['content']) > 50){
  header('location:../profil.php?message=La description doit être comprise entre 0 et 50 caractères');
  exit;
}

if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){


  $acceptable = ['gif','jpeg','jpg','gif','png', 'JPG'];
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  if(!in_array($ext, $acceptable)){

    header('location:../profil.php?message=Le fichier n\'est pas du bon type.');
    exit;
  }


  $maxSize = 2 * 1024 * 1024;

  if($_FILES['image']['size'] > $maxSize){

    header('location:../profil.php?message=Le fichier est trop lourd.');
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




$q = "UPDATE user SET user_username = :pseudo, user_email= :email, user_avatar = :image, user_password = :password, user_messagecontent = :content WHERE user_username = :pseudoc;";
$req = $bdd->prepare($q);
$reponse = $req->execute([
  'pseudo' => $_POST['pseudo'],
  'email' => $_POST['email'],
  'image' => $_FILES['image']['name'],
  'password' => $_POST['password'],
  'content' => $_POST['content'],
  'pseudoc' => $_SESSION['pseudo']
]);

if($reponse){
  header('location:../profil.php?message=Informations modifiées !');
  exit;
}else{
  header('location:../profil.php?message=Probleme.');
}

?>
