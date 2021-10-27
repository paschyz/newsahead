<?php
session_start();
$_SESSION['id'] = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">


<?php
$title = 'Accueil';
include('includes/head.php');

include('includes/header.php');
include('config.php'); ?>

<body>
  <?php include('includes/tendances.php'); ?>
  <?php include('includes/trash.php'); ?>
  <?php



  $q = "SELECT * FROM article1 WHERE id_article= :id";
  $reponse1 = $bdd->prepare($q);
  $reponse1->execute([
    'id' => $_SESSION['id']
  ]);





  ?>


  <div class="group-cards">
    <div class="row row-cols-1 row-cols-md-1">

      <?php
      if(isset($_GET['message']) && !empty($_GET['message'])){
        echo '<div style="max-width:24em;"><h5>' . htmlspecialchars($_GET['message']) . '</h5></div>';
      }
      ?>

      <?php


      while ($donnees = $reponse1->fetch())
      {
        ?>

        <div class="col">
          <div class="draggable">
            <div class="card">
              <img src="images/<?php echo $donnees['article_image']; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $donnees['article_title']; ?></h5>
                <p  class="card-text"><?php echo $donnees['article_content']; ?></p>
                <h6>Mot-clé :<i>  <?php echo $donnees['article_keyword']; ?></i></h6>
                <p class="card-text"><small class="text-muted">Écrit <?php echo ' par <strong>' . $donnees['article_writer_username'] . '</strong>';echo ' il y a <i> ';  dateDifference($date->format('Y-m-d H:i:s'),$donnees['article_time'] );  echo'</i>';   ?></small></p>

                <div>
                  <h6>
                    <span id="<?php echo $donnees['id_article']; ?>like" class="card-like" ><?php echo $donnees['article_likes']; ?></span>
                    <img src="images/components/fav-icon.png" height="15px" width:"15px">
                    <span id="<?php echo $donnees['id_article']; ?>dislike"><?php echo $donnees['article_dislikes']; ?></span>
                    <img src="images/components/unlike.png" height="17px" width:"17px">
                  </h6>
                </div>
                <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="like(this.className)"
                  id="<?php
                  $q = "SELECT COUNT(likes_id) AS total FROM likes WHERE article_fk = :id AND likes_username = :pseudo";
                  $req = $bdd->prepare($q);
                  $req->execute([
                    'id' => $donnees['id_article'],
                    'pseudo' => $_SESSION['pseudo']
                  ]);
                  $resultat = $req->fetch(PDO::FETCH_ASSOC);

                  if($resultat['total'] != 0){
                    echo 'btn btn-outline-info '.$donnees['id_article'].'';
                  }else{
                    echo 'btn btn-info '.$donnees['id_article'].'';
                  }
                  ?>" class="<?php
                  $q = "SELECT COUNT(likes_id) AS total FROM likes WHERE article_fk = :id AND likes_username = :pseudo";
                  $req = $bdd->prepare($q);
                  $req->execute([
                    'id' => $donnees['id_article'],
                    'pseudo' => $_SESSION['pseudo']
                  ]);
                  $resultat = $req->fetch(PDO::FETCH_ASSOC);

                  if($resultat['total'] != 0){

                    echo 'btn btn-outline-info '.$donnees['id_article'].'';
                  }else{
                    echo 'btn btn-info '.$donnees['id_article'].'';
                  }
                  ?>">
                  <?php $q = "SELECT COUNT(likes_id) AS total FROM likes WHERE article_fk = :id AND likes_username = :pseudo";
                  $req = $bdd->prepare($q);
                  $req->execute([
                    'id' => $donnees['id_article'],
                    'pseudo' => $_SESSION['pseudo']
                  ]);
                  $resultat = $req->fetch(PDO::FETCH_ASSOC);

                  if($resultat['total'] != 0){
                    echo 'Liké !';
                  }else{
                    echo 'Like';
                  }
                  ?></button>

                  <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="dislike(this.className)"
                    id="<?php
                    $q = "SELECT COUNT(dislikes_id) AS total FROM dislikes WHERE article_fk = :id AND dislikes_username = :pseudo";
                    $req = $bdd->prepare($q);
                    $req->execute([
                      'id' => $donnees['id_article'],
                      'pseudo' => $_SESSION['pseudo']
                    ]);
                    $resultat = $req->fetch(PDO::FETCH_ASSOC);

                    if($resultat['total'] != 0){
                      echo 'btn btn-outline-danger '.$donnees['id_article'].'';
                    }else{
                      echo 'btn btn-danger '.$donnees['id_article'].'';
                    }
                    ?>" class="<?php
                    $q = "SELECT COUNT(dislikes_id) AS total FROM dislikes WHERE article_fk = :id AND dislikes_username = :pseudo";
                    $req = $bdd->prepare($q);
                    $req->execute([
                      'id' => $donnees['id_article'],
                      'pseudo' => $_SESSION['pseudo']
                    ]);
                    $resultat = $req->fetch(PDO::FETCH_ASSOC);

                    if($resultat['total'] != 0){

                      echo 'btn btn-outline-danger '.$donnees['id_article'].'';
                    }else{
                      echo 'btn btn-danger '.$donnees['id_article'].'';
                    }
                    ?>">
                    <?php $q = "SELECT COUNT(dislikes_id) AS total FROM dislikes WHERE article_fk = :id AND dislikes_username = :pseudo";
                    $req = $bdd->prepare($q);
                    $req->execute([
                      'id' => $donnees['id_article'],
                      'pseudo' => $_SESSION['pseudo']
                    ]);
                    $resultat = $req->fetch(PDO::FETCH_ASSOC);

                    if($resultat['total'] != 0){
                      echo 'Disliké !';
                    }else{
                      echo 'Dislike';
                    }
                    ?></button>

                    <?php
                    $q = "SELECT COUNT(id_article) AS total FROM article1 WHERE id_article = :id AND article_writer_username = :pseudo";
                    $req = $bdd->prepare($q);
                    $req->execute([
                      'id' => $_SESSION['id'],
                      'pseudo' => $_SESSION['pseudo']
                    ]);
                    $resultat = $req->fetch(PDO::FETCH_ASSOC);


                    if(isset($_SESSION['admin']) || $resultat['total'] != 0){
                      echo '<button class="btn btn-outline-dark" onclick="openModal();">Modifier</button>';
                    } ?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
                    role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modifier un article</h5>
                          <button type="button" class="close" aria-label="Close" onclick="closeModal();window.location.hash = ''">
                            <span aria-hidden="true">X</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="verification/verification_modifier.php" method="post" enctype="multipart/form-data">

                            <div class="mb-3">
                              <label for="formFile" class="form-label">Image d'illustration<b>*</b></label>
                              <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
                              <div class="form-text">L'image/GIF ne doit pas dépasser 2 Mo.</div>
                            </div>

                            <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Titre<b>*</b></label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Example" name="titre" value="<?php echo $donnees['article_title']; ?>">
                              <div class="form-text">Le titre doit faire entre 1 et 64 caractères.</div>
                            </div>
                            <div class="mb-3">
                              <label for="exampleFormControlTextarea1" class="form-label">Contenu de l'article</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Example" name="contenu" ><?php echo $donnees['article_content']; ?></textarea>
                              <div class="form-text">Le contenu doit faire entre 0 et 1000 caractères.</div>
                            </div>
                            <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Mot-clé<b>*</b></label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Example" name="motcle" value="<?php echo $donnees['article_keyword']; ?>">
                              <div class="form-text">Vous devez entrer un mot-clé avec une majuscule au début, et entre 1 et 20 caractères.</div>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label"><b>*</b> = Champ obligatoire</label>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" onclick="closeModal()">Fermer</button>
                              <button type="submit" class="btn btn-primary">Modifier l'article</button>
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>
                </div>
              </div>
            </div>
          </div>




          <?php
        }
        ?>

      </div>
    </div>


    <div style="position: absolute; top:8em; right:30em; width:25em;  ">
      <h5>Ecrire un commentaire:</h5>
      <form  action="verification/verification_commentaire.php" method="post">
        <textarea name="comment" cols="42" rows="3" placeholder="Réagir à cet article"></textarea>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
      <div class="row row-cols-1 row-cols-md-1 g-2">


        <?php
        $q = "SELECT * FROM comment WHERE comment_article_id= :id";
        $reponse = $bdd->prepare($q);
        $reponse->execute([
          'id' => $_SESSION['id']]);

          while ($donnees = $reponse->fetch())
          {
            ?>

            <div class="col">
              <div class="card">
                <div class="card-body">
                  <p class="card-text"><?php echo $donnees['comment_content']; ?></p>
                  <p class="card-text"><small class="text-muted">Écrit <?php echo ' par <strong>' . $donnees['comment_writer_username'] . '</strong>';echo ' il y a <i> ';  dateDifference($date->format('Y-m-d H:i:s'),$donnees['comment_time'] );  echo'</i>';   ?></small></p>
                </div>
              </div>
            </div>

            <?php
          }
          ?>
        </div>
      </div>




      <script src="javascript/like.js" charset="utf-8">  </script>
      <script>
      function openModal() {
        document.getElementById("backdrop").style.display = "block"
        document.getElementById("exampleModal").style.display = "block"
        document.getElementById("exampleModal").classList.add("show")
      }
      function closeModal() {
        document.getElementById("backdrop").style.display = "none"
        document.getElementById("exampleModal").style.display = "none"
        document.getElementById("exampleModal").classList.remove("show")
      }

      var modal = document.getElementById('exampleModal');


      window.onclick = function(event) {
        if (event.target == modal) {
          closeModal()
        }
      }


      </script>

    </body>

    <?php include('includes/footer.php'); ?>

    </html>
