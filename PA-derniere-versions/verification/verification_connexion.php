<?php
if(isset($_POST['email']) && !empty($_POST['email'])){
  setcookie('email', $_POST['email'], time() + 3600);
}

if( !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['pseudo']) || empty($_POST['pseudo'])){
  header('location:../connexion.php?message=Vous devez remplir tous les champs.');
  exit;
}

$log = fopen('log.txt', 'a+');
$line = date("Y/m/d - H:i:s") . ' - Tentative de connexion de : ' . $_POST['email'] . "\n";

fputs($log, $line);
fclose($log);



if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  header('location:../connexion.php?message=Email invalide.');
  exit;
}

include('../config.php');

$q = "SELECT * FROM user WHERE user_email = :email AND user_password = :password AND user_username = :pseudo";
$req = $bdd->prepare($q);
$req->execute([
  'email' => $_POST['email'],
  'password' => $_POST['password'],
  'pseudo' => $_POST['pseudo']
]);



$user = $req->fetch(PDO::FETCH_ASSOC);

if($user){
  session_start();
  $_SESSION['pseudo'] = $_POST['pseudo'];
  $_SESSION['email'] = $_POST['email'];

  $q = " SELECT COUNT(id_user) AS total FROM user WHERE user_username = :pseudo AND user_admin = '1' ";
  $req = $bdd->prepare($q);
  $reponse = $req->execute([
    'pseudo' => $_SESSION['pseudo']
  ]);
  $resultat = $req->fetch(PDO::FETCH_ASSOC);

  if($resultat['total'] != 0){
    $_SESSION['admin'] = 'Administrateur du site';
    header('location:../profil.php');
    exit;
  }else{
    header('location:../profil.php?message=NON ADMIN !');
  }


  exit;
}else{
  header('location:../connexion.php?message=Identifiants incorrects.');
  exit;
}







?>
