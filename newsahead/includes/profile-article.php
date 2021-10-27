<?php


$reponse1 = $bdd->query("SELECT * FROM article1 WHERE article_column=1 AND article_writer_username='$_SESSION[pseudo]'");
$reponse2 = $bdd->query("SELECT * FROM article1 WHERE article_column=2 AND article_writer_username='$_SESSION[pseudo]'");
$reponse3 = $bdd->query("SELECT * FROM article1 WHERE article_column=3 AND article_writer_username='$_SESSION[pseudo]'");
$reponse4 = $bdd->query("SELECT * FROM article1 WHERE article_column=4 AND article_writer_username='$_SESSION[pseudo]'");
?>




<body>


  <div class="group-cards1">
    <div class="row row-cols-1 row-cols-md-1">



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
                <div>
                  <h6>
                    <span id="<?php echo $donnees['id_article']; ?>" class="card-like" ><?php echo $donnees['article_likes']; ?></span>
                    <img alt="fav" src="images/components/fav-icon.png" height="15" width="15">
                    <span><?php echo $donnees['article_dislikes']; ?></span>
                    <img alt="dislike" src="images/components/unlike.png" height="17" width="17">
                  </h6>
                  <h6>Mot-clé :<i>  <?php echo $donnees['article_keyword']; ?></i></h6>
                  <p class="card-text"><small class="text-muted">Écrit <?php echo ' par <strong>' . $donnees['article_writer_username'] . '</strong>';echo ' il y a <i> ';  dateDifference($date->format('Y-m-d H:i:s'),$donnees['article_time'] );  echo'</i>';   ?></small></p>
                </div>
                <br>
                <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                  <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                    <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"  class="btn btn-success">Comment</button>
                    <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"    class="btn btn-secondary">+</button>
                  </div>
                </div>
              </div>
            </div>







            <?php
          }
          ?>

        </div>
      </div>

      <div class="group-cards2">
        <div class="row  row-cols-md-1">
          <?php


          while ($donnees = $reponse2->fetch())
          {
            ?>

            <div class="col">
              <div class="draggable">
                <div class="card">
                  <img src="images/<?php echo $donnees['article_image']; ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $donnees['article_title']; ?></h5>
                    <p  class="card-text"><?php echo $donnees['article_content']; ?></p>
                    <div>
                      <h6>
                        <span id="<?php echo $donnees['id_article']; ?>" class="card-like" ><?php echo $donnees['article_likes']; ?></span>
                        <img alt="fav" src="images/components/fav-icon.png" height="15" width="15">
                        <span><?php echo $donnees['article_dislikes']; ?></span>
                        <img alt="dislike" src="images/components/unlike.png" height="17" width="17">
                      </h6>
                      <h6>Mot-clé :<i>  <?php echo $donnees['article_keyword']; ?></i></h6>
                      <p class="card-text"><small class="text-muted">Écrit <?php echo ' par <strong>' . $donnees['article_writer_username'] . '</strong>';echo ' il y a <i> ';  dateDifference($date->format('Y-m-d H:i:s'),$donnees['article_time'] );  echo'</i>';   ?></small></p>
                    </div>
                    <br>
                    <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                      <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                        <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"  class="btn btn-success">Comment</button>
                        <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"    class="btn btn-secondary">+</button>
                      </div>
                    </div>
                  </div>
                </div>







                <?php
              }
              ?>

            </div>
          </div>

          <div class="group-cards3">
            <div class="row row-cols-1 row-cols-md-1">



              <?php


              while ($donnees = $reponse3->fetch())
              {
                ?>

                <div class="col">
                  <div class="draggable">
                    <div class="card">
                      <img src="images/<?php echo $donnees['article_image']; ?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $donnees['article_title']; ?></h5>
                        <p  class="card-text"><?php echo $donnees['article_content']; ?></p>
                        <div>
                          <h6>
                            <span id="<?php echo $donnees['id_article']; ?>" class="card-like" ><?php echo $donnees['article_likes']; ?></span>
                            <img alt="fav" src="images/components/fav-icon.png" height="15" width="15">
                            <span><?php echo $donnees['article_dislikes']; ?></span>
                            <img alt="dislike" src="images/components/unlike.png" height="17" width="17">
                          </h6>
                          <h6>Mot-clé :<i>  <?php echo $donnees['article_keyword']; ?></i></h6>
                          <p class="card-text"><small class="text-muted">Écrit <?php echo ' par <strong>' . $donnees['article_writer_username'] . '</strong>';echo ' il y a <i> ';  dateDifference($date->format('Y-m-d H:i:s'),$donnees['article_time'] );  echo'</i>';   ?></small></p>
                        </div>
                        <br>
                        <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                          <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                            <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"  class="btn btn-success">Comment</button>
                            <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"    class="btn btn-secondary">+</button>
                          </div>
                        </div>
                      </div>
                    </div>







                    <?php
                  }
                  ?>

                </div>
              </div>

              <div class="group-cards4">
                <div class="row row-cols-1 row-cols-md-1">



                  <?php


                  while ($donnees = $reponse4->fetch())
                  {
                    ?>

                    <div class="col">
                      <div class="draggable">
                        <div class="card">
                          <img src="images/<?php echo $donnees['article_image']; ?>" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $donnees['article_title']; ?></h5>
                            <p  class="card-text"><?php echo $donnees['article_content']; ?></p>
                            <div>
                              <h6>
                                <span id="<?php echo $donnees['id_article']; ?>" class="card-like" ><?php echo $donnees['article_likes']; ?></span>
                                <img alt="fav" src="images/components/fav-icon.png" height="15" width="15">
                                <span><?php echo $donnees['article_dislikes']; ?></span>
                                <img alt="dislike" src="images/components/unlike.png" height="17" width="17">
                              </h6>
                              <h6>Mot-clé :<i>  <?php echo $donnees['article_keyword']; ?></i></h6>
                              <p class="card-text"><small class="text-muted">Écrit <?php echo ' par <strong>' . $donnees['article_writer_username'] . '</strong>';echo ' il y a <i> ';  dateDifference($date->format('Y-m-d H:i:s'),$donnees['article_time'] );  echo'</i>';   ?></small></p>
                            </div>
                            <br>
                            <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                              <button name="id" value="<?php echo $donnees['id_article'] ?>" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"
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
                                <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"  class="btn btn-success">Comment</button>
                                <button type="button" onclick="location.href = 'plus.php?id=<?php echo $donnees['id_article']?>'"    class="btn btn-secondary">+</button>

                              </div>
                            </div>
                          </div>
                        </div>







                        <?php
                      }
                      ?>

                    </div>
                  </div>
                  <?php

                  $reponse1->closeCursor();

                  ?>
