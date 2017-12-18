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
          <a href="proposertrajat.php">  <li>Proposer un trajet  </li> </a>
          <a href="blank">  <li> Inscription  </li> </a>
          <a href="connexion.php">  <li> Connexion </li> </a>
        </ul>
      </nav>

      <div id="formul">
        <form method="post" action = "post_propose.php">
          <label>  Départ :</label> <input id="home" type="text" name = "depart"/>
          <label> Destination :</label> <input  id="curs" type="text" name = "destination"/>
          <label> Date : </label> <input  id="calen" type="date" name = "date"/>
          <input id="valider" type="submit" name = "recherche"/>
        </form>
      </div>

      <?php
      $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $query = $pdo->query("SELECT *
                            FROM TRAJET
                            WHERE TYPE = 1
                            ;"
                          );
      $tuples= $query->fetchAll(PDO::FETCH_OBJ);
      ?>
