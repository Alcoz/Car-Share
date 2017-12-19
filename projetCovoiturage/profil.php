<?php
session_start();
?>
<!Doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles/stylesheet.css" />
  <title>Car-Share - Accueil</title>
</head>
<body>
  <nav>
    <ul id="menu">
      <a id="acc" href="accueil.php">  <li> Car-Share </li> </a>
      <?php
      if (isset($_SESSION['id'])) {
        echo "<a href=\"connexion.php\"> <li> Deconnexion</li> </a>";
        echo "<a href=\"proposertrajat.php\">  <li>Proposer un trajet  </li> </a>";
        echo "<a href=\"profil.php\">  <li>Mon profil  </li> </a>";
      }
      else {
        echo "<a href=\"inscription.php\">  <li> Inscription  </li> </a>";
        echo "<a href=\"connexion.php\">  <li> Connexion </li> </a>";
      }
      ?>
    </ul>
  </nav>
  <div id="profil">
    <h2> Votre profil </h2>
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
          echo "<li> Note : $tuple->NOTE </li>";
        }
        ?>
      </ul>
    </div>
    <div id="avis">
      <?php
      echo "<p> $id </p>";
      $query = $pdo->query("SELECT *
        FROM AVIS
        WHERE ID_CONDUCTEUR = $id ;");
        $tuples2= $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($tuples2 as $tuple2) {
          ?>
          <div id="avi">
            <h3> Utilisateur : <?php $tuple2->ID_PASSAGER ?> </h3>
            <p> Commentaire : <?php $tuple2->COMMENTAIRE ?> </p>
          </div>
          <?php
        }

        ?>
      </div>
    </body>
    </html>
