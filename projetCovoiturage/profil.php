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
          }

          
           ?>
