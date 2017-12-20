<?php
session_start();
 ?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/resultat.css" />
    <title>Car-Share - Information Trajet</title>
  </head>
  <body>
      <nav>
        <ul id="menu">
          <a id="acc" href="accueil.php">  <li> Car-Share </li> </a>
          <?php
          if (isset($_SESSION['id'])) {
            echo "<a href=\"connexion.php\"> <li> Deconnexion</li> </a>";
            echo "<a href=\"proposition.php\">  <li>Proposer un trajet  </li> </a>";
            echo "<a href=\"profil.php\">  <li>Mon profil  </li> </a>";
          }
          else {
            echo "<a href=\"inscription.php\">  <li> Inscription  </li> </a>";
            echo "<a href=\"connexion.php\">  <li> Connexion </li> </a>";
          }
           ?>
        </ul>
      </nav>
      <div id="corps_menu">
      </div>
      <?php

      $id_traj = $_POST['id_trajet'];
      $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $query = $pdo->query("SELECT *
                            FROM TRAJET
                            WHERE ID_TRAJET = \"$id_traj\";");

      $tuples= $query->fetchAll(PDO::FETCH_OBJ);

      if (isset($_POST['imin'])) {
        echo "LAAAAAAAAAAAAAAA";
        $id_final_uti = $_SESSION['id'];
        $id_final_traj = $_POST['trajprit'];
        $query3 = $pdo->exec("INSERT INTO FAIT_TRAJET (ID_TRAJET, ID_PASSAGER)
                VALUES ('$id_final_traj', '$id_final_uti');");
        $query4 = $pdo->exec("UPDATE TRAJET SET NB_PLACE = NB_PLACE - 1 WHERE ID_TRAJET = $id_final_traj;" );

        header('Location: accueil.php');
      }



      echo "<div id=\"desc\">";
      foreach ($tuples as $tuple) {
        $id_cond = $tuple->ID_CONDUCTEUR;

        $query2 = $pdo->query("SELECT *
                              FROM UTILISATEUR
                              WHERE ID_UTILISATEUR = \"$id_cond\";");

        $tuples2= $query2->fetchAll(PDO::FETCH_OBJ);
        foreach ($tuples2 as $tuple2) {

                  echo "<div>";
                  echo "<p> Trajet : ".$tuple->VILLE_DEP."  ----->  ".$tuple->VILLE_ARR."</p>";
                  echo "<p id=\"p2\"> Nombre de place restante : ".$tuple->NB_PLACE;
                  echo "</div>";

                  echo "<div>";
                  echo "<p> De : ".$tuple->ADRESSE_DEPART."</p>";
                  echo "</div>";

                  echo "<div>";
                  echo "<p> A : ".$tuple->ADRESSE_ARR."</p>";
                  echo "<p id=\"p2\"> le ".$tuple->DATE_DEP." </p>";
                  echo "</div>";

                  echo "<div>";
                  echo "<p> Conducteur : ".$tuple2->PRENOM." ".$tuple2->NOM."</p>";
                  echo "<p id=\"p2\">  Prix : ".$tuple->PRIX."€ </p>";
                  echo "</div>";

                  echo "<div id=\"inscription\">";
                  echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
                  echo "<input type=\"hidden\" value=\"".$id_traj."\" name=\"trajprit\"> <input type=\"submit\" value=\"M'inscrire\" name=\"imin\">";
                  echo "</div>";

        }


      }?>
    </div>

    </body>
    </html>
