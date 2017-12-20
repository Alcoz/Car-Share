<?php
session_start();
 ?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/profil.css" />
    <title>Car-Share - Accueil</title>
  </head>
  <body>
      <nav>
        <ul id="menu">
          <a id="acc" href="accueil.php">  <li> Car-Share </li> </a>
          <?php
          if (isset($_SESSION['id'])) {
            $id_uti = $_SESSION['id'];
            echo "<a href=\"connexion.php\"> <li> Deconnexion</li> </a>";
            echo "<a href=\"proposition.php\">  <li>Proposer un trajet  </li> </a>";
            echo "<a href=\"profil.php\">  <li>Mon profil  </li> </a>";
            $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $query2 = $pdo->query("SELECT DISTINCT *
                                  FROM UTILISATEUR
                                  WHERE ID_UTILISATEUR = $id_uti;");

            $admin = $query2->fetch();
            if ($admin['ETAT'] ==  1) {
              echo "<a href=\"admin.php\">  <li> Administration  </li> </a>";
            }

          }
          else {
            $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            echo "<a href=\"inscription.php\">  <li> Inscription  </li> </a>";
            echo "<a href=\"connexion.php\">  <li> Connexion </li> </a>";
          }
          ?>

        </ul>
      </nav>
  <div id="corps_menu">
  </div>
  <div id="profil">
    <h2> <u> Votre profil </u>  :</h2>
    <ul>
      <?php
      $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $id = $_SESSION['id'];
      $query = $pdo->query("SELECT *
        FROM UTILISATEUR
        WHERE ID_UTILISATEUR = \"$id\"
        ;");
        $tuples= $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($tuples as $tuple) {
          echo "<li> Prenom : $tuple->PRENOM </li>";
          echo "<li> Nom :  $tuple->NOM </li>";
          echo "<li> Age:  $tuple->AGE </li>";
          echo "<li> Mail :  $tuple->MAIL </li>";
          echo "<li> Note : ";
          if ($tuple->NOTE == null) {
            echo "vous n'avez pas assez d'avis";
          }
          else {
            echo $tuple->NOTE." </li>";
          }
        }
        ?>
      </ul>
    </div>
    <div id="avis">
      <h3> Vos avis </h3>
      <?php
      $query2 = $pdo->query("SELECT *
        FROM AVIS
        WHERE ID_CONDUCTEUR = \"$id\" ;");
        $tuples2= $query2->fetchAll(PDO::FETCH_OBJ);

        foreach ($tuples2 as $tuple2){

          $query3 = $pdo->query("SELECT *
            FROM UTILISATEUR
            WHERE ID_UTILISATEUR = \"$tuple2->ID_PASSAGER\" ;");
            $tuples3= $query3->fetchAll(PDO::FETCH_OBJ);
            foreach ($tuples3 as $tuple3) {
              ?>
              <div class="label">
                <h3>  <?php echo "$tuple3->PRENOM"; ?> </h3>
                <p> Commentaire : <?php echo "$tuple2->COMMENTAIRE"; ?> </p>
              </div>
              <?php
            }
          }

          ?>
        </div>
        <div id="traj_futur_conducteur">
          <h3> Mes trajets futurs en tant que conducteur </h3>
          <?php
          $query4 = $pdo->query("SELECT *
            FROM TRAJET
            WHERE ID_CONDUCTEUR = \"$id\"
            AND DATE_DEP > NOW();");
            $tuples4= $query4->fetchAll(PDO::FETCH_OBJ);
            foreach ($tuples4 as $tuple4) {
              ?>

              <div class="label">
                <ul>
                  <li>  <?php echo $tuple4->DATE_DEP ?> </li>
                  <li>  <?php echo $tuple4->VILLE_DEP ?>  </li>
                  <li>  <?php echo $tuple4->VILLE_ARR ?> </li>
                  <li>  <?php echo $tuple4->ADRESSE_DEPART ?> </li>
                  <li>  <?php echo $tuple4->ADRESSE_ARR?>  </li>
                  <li>  <?php echo $tuple4->PRIX ?> </li>
                </ul>
                <?php

                echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
                echo "<input type=\"hidden\" value=\"".$tuple4->ID_TRAJET."\" name=\"supp_traj_cond\">";
                echo "<input type='submit' name=\"desinscrire_conducteur\" value='Se Désinscrire'/>";
                 ?>
              </div>
            <?php }
            if (isset($_POST['desinscrire_conducteur'])) {
              $id_traj = $_POST['supp_traj_cond'];
              $drop = $pdo->exec("DELETE FROM FAIT_TRAJET WHERE ID_TRAJET=$id_traj");
              $drop = $pdo->exec("DELETE FROM TRAJET WHERE ID_TRAJET=$id_traj");
            }?>
            </div>

            <div id="traj_futur_passager">
              <h3> Mes trajets futurs en tant que passager </h3>
              <?php
              $query4 = $pdo->query("SELECT *
                FROM TRAJET,FAIT_TRAJET
                WHERE TRAJET.ID_TRAJET=FAIT_TRAJET.ID_TRAJET
                AND ID_PASSAGER=\"$id\"
                AND ID_CONDUCTEUR!=\"$id\"
                AND DATE_DEP > CURDATE();");
                $tuples4= $query4->fetchAll(PDO::FETCH_OBJ);
                foreach ($tuples4 as $tuple4) {
                  ?>

                  <div class="label">
                    <ul>
                      <li>  <?php echo $tuple4->DATE_DEP ?> </li>
                      <li>  <?php echo $tuple4->VILLE_DEP ?>  </li>
                      <li>  <?php echo $tuple4->VILLE_ARR ?> </li>
                      <li>  <?php echo $tuple4->ADRESSE_DEPART ?> </li>
                      <li>  <?php echo $tuple4->ADRESSE_ARR?>  </li>
                      <li>  <?php echo $tuple4->PRIX ?> </li>
                    </ul>
                    <?php
                    echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
                    echo "<input type=\"hidden\" value=\"".$tuple4->ID_TRAJET."\" name=\"supp_traj_pass\">";
                    echo "<input type='submit' name=\"desinscrire_passager\" value='Se Désinscrire'/>";
                     ?>
                  </div>
                <?php }
                if (isset($_POST['desinscrire_passager']) AND isset($_POST['supp_traj_pass'])) {
                  $id_traj = $_POST['supp_traj_pass'];
                  $drop = $pdo->exec("DELETE FROM FAIT_TRAJET WHERE ID_TRAJET = $id_traj AND ID_PASSAGER = $id" );
              }
                ?>
              </div>

        <div id="traj_cond">
          <h3> Mes trajets passés en tant que conducteur</h3>
          <?php
          $query4 = $pdo->query("SELECT *
            FROM TRAJET
            WHERE ID_CONDUCTEUR = \"$id\"
            AND DATE_DEP < NOW();");
            $tuples4= $query4->fetchAll(PDO::FETCH_OBJ);
            foreach ($tuples4 as $tuple4) {
              ?>

              <div class="label">
                <ul>
                  <li>  <?php echo $tuple4->DATE_DEP ?> </li>
                  <li>  <?php echo $tuple4->VILLE_DEP ?>  </li>
                  <li>  <?php echo $tuple4->VILLE_ARR ?> </li>
                  <li>  <?php echo $tuple4->ADRESSE_DEPART ?> </li>
                  <li>  <?php echo $tuple4->ADRESSE_ARR?>  </li>
                  <li>  <?php echo $tuple4->PRIX ?> </li>
                </ul>
              </div>
            <?php } ?>
            </div>

            <div id="traj_pass">
              <h3> Mes trajets passés en tant que passager </h3>
              <?php
              $query4 = $pdo->query("SELECT *
                FROM TRAJET,FAIT_TRAJET,UTILISATEUR
                WHERE TRAJET.ID_TRAJET=FAIT_TRAJET.ID_TRAJET
                AND TRAJET.ID_CONDUCTEUR=UTILISATEUR.ID_UTILISATEUR
                AND ID_PASSAGER=\"$id\"
                AND ID_CONDUCTEUR!=\"$id\"
                AND DATE_DEP < NOW();");
                $tuples4= $query4->fetchAll(PDO::FETCH_OBJ);
                foreach ($tuples4 as $tuple4) {
                  $id_traj = $tuple4->ID_TRAJET;
                  echo "<div id=\"desc\">";

                    $id_cond = $tuple4->ID_CONDUCTEUR;

                    $query5 = $pdo->query("SELECT *
                                          FROM AVIS, TRAJET, FAIT_TRAJET
                                          WHERE AVIS.ID_PASSAGER = \"$id\"
                                          AND AVIS.ID_PASSAGER = FAIT_TRAJET.ID_PASSAGER
                                          AND FAIT_TRAJET.ID_TRAJET = TRAJET.ID_TRAJET
                                          AND AVIS.ID_CONDUCTEUR = TRAJET.ID_CONDUCTEUR
                                          AND TRAJET.ID_TRAJET = $id_traj
                                          AND TRAJET.ID_CONDUCTEUR = $id_cond
                                          AND AVIS.ID_PASSAGER = $id;");

                    $tuples5= $query5->fetch(PDO::FETCH_OBJ);

                    $query6 = $pdo->query("SELECT *
                                           FROM UTILISATEUR
                                           WHERE ID_UTILISATEUR = $id_cond");
                    $tuples6 = $query6->fetch(PDO::FETCH_OBJ);

                              echo "<div>";
                              echo "<p> Trajet : ".$tuple4->VILLE_DEP."  ----->  ".$tuple4->VILLE_ARR."</p>";
                              echo "<p id=\"p2\"> Nombre de place restante : ".$tuple4->NB_PLACE;
                              echo "</div>";

                              echo "<div>";
                              echo "<p> De : ".$tuple4->ADRESSE_DEPART."</p>";
                              echo "</div>";

                              echo "<div>";
                              echo "<p> A : ".$tuple4->ADRESSE_ARR."</p>";
                              echo "<p id=\"p2\"> le ".$tuple4->DATE_DEP." </p>";
                              echo "</div>";

                              echo "<div>";

                              echo "<p> Conducteur : ".$tuples6->PRENOM." ".$tuples6->NOM."</p>";
                              echo "<p id=\"p2\">  Prix : ".$tuple4->PRIX."€ </p>";
                              echo "</div>";

                              if(isset($_POST['commentaire'])){
                                $conducteur = $id_cond;
                                $passager = $id;
                                $note = $_POST['note'];
                                $comm = $_POST['commentaire'];
                                $pdo->exec("INSERT INTO AVIS(ID_CONDUCTEUR, ID_PASSAGER, NOTES, COMMENTAIRE) VALUES(".$conducteur.",".$passager.",".$note.",\"".$comm."\");");
                              }

                              if ($tuples5 != null) {
                                echo "<div id=\"inscription\">";
                                echo $tuples5->NOTES;
                                echo $tuples5->COMMENTAIRE;
                                echo "</div>";
                              }
                              else{
                                echo "<div id=\"inscription\">";
                                echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
                                echo "<label> Notes </label> <input type='number' name='note' \>";
                                echo "<label> Commentaire</label> <input type='text' name='commentaire'/>";
                                echo "<input type='submit' value='commentaire'/>";
                                echo "</div>";
                              }

                  echo "</div>";}
                  ?>
                  </div>

            </body>
            </html>
