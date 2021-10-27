<?php






if( !file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']) || !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) ||
!isset($_POST['pseudo']) || empty($_POST['pseudo']) ){
  header('location:../inscription.php?message=Vous devez remplir tous les champs.');
  exit;
}

if(isset($_POST['email']) && !empty($_POST['email'])){
  setcookie('email', $_POST['email'], time() + 3600);
}




if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  header('location:../inscription.php?message=Format de l\'email invalide.');
  exit;
}

$em=trim($_POST['email']);

if(strpos($em, ' ') || $_POST['email'] != $em){
  header('location:../inscription.php?message=L\'adresse mail ne doit pas contenir d\'espaces');
  exit;
}

if(strlen($_POST['email']) < 6 || strlen($_POST['email']) > 120){
  header('location:../inscription.php?message=L\'adresse mail doit être comprise entre 6 et 120 caractères');
  exit;
}

$psd=trim($_POST['pseudo']);

if(strpos($psd, ' ') || $_POST['pseudo'] != $psd){
  header('location:../inscription.php?message=Le pseudo ne doit pas contenir d\'espaces');
  exit;
}

if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){
  header('location:../inscription.php?message=Le pseudo doit être compris entre 4 et 20 caractères');
  exit;
}

$pwd=trim($_POST['password']);

if(strpos($pwd, ' ') || $_POST['password'] != $pwd){
  header('location:../inscription.php?message=Le mot de passe ne doit pas contenir d\'espaces');
  exit;
}

if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 32){
  header('location:../inscription.php?message=Le mot de passe doit être compris entre 4 et 32 caractères');
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

$q = "SELECT COUNT(id_user) AS total FROM user WHERE user_email = :email";
$req = $bdd->prepare($q);
$req->execute([
  'email' => $_POST['email']
]);
$resultat = $req->fetch(PDO::FETCH_ASSOC);
if($resultat['total'] != 0){

  header('location:../inscription.php?message=Cet email est déjà utilisé.');
  exit;}

  $q = "SELECT COUNT(id_user) AS totalpseudo FROM user WHERE user_username = :pseudo";
  $req = $bdd->prepare($q);
  $req->execute([
    'pseudo' => $_POST['pseudo']
  ]);
  $resultat = $req->fetch(PDO::FETCH_ASSOC);
  if($resultat['totalpseudo'] != 0){

    header('location:../inscription.php?message=Ce pseudo est déjà utilisé.');
    exit;}



    $q = "INSERT INTO user (user_email, user_username, user_password, user_avatar) VALUES (:email, :pseudo, :password, :avatar)";
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
      'email' => $_POST['email'],
      'pseudo' => $_POST['pseudo'],
      'password' => $_POST['password'],
      'avatar' => $_FILES['image']['name']
    ]);


    if($reponse){

      header('location:../inscription.php?message=Compte créé. Bienvenue !');
      exit;
    }
    ?>
