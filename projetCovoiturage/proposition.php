<?php
session_start();
 ?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/connexion.css" />
    <title>Car-Share - Accueil</title>
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
    <div class="proposition">
      <?php
        try{
          $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '');
        }catch(Exception $e){
          die('Erreur : '.$e->getMessage());
        }

        if(isset($_POST['ville_dep']) AND isset($_POST['ad_dep'])  AND isset($_POST['ville_arr']) AND isset($_POST['ad_arr']) AND isset($_POST['distance']) AND isset($_POST['prix']) AND isset($_POST['date_dep']) AND isset($_POST['id_voiture'])){
          $ville_dep = $_POST['ville_dep'];
          $ad_dep = $_POST['ad_dep'];
          $ville_arr = $_POST['ville_arr'];
          $ad_arr = $_POST['ad_arr'];
          $distance = $_POST['distance'];
          $prix = $_POST['prix'];
          $date_dep = $_POST['date_dep'];
          $id_voiture = $_POST['id_voiture'];
          $id_cond = $_SESSION['id'];


          $query = $pdo->exec("INSERT INTO TRAJET (TYPE, VILLE_DEP, ADRESSE_DEPART, VILLE_ARR, ADRESSE_ARR, DISTANCE, PRIX, DATE_DEP, DISPONIBLE, ID_VOITURE, ID_CONDUCTEUR)
                  VALUES ('1', '$ville_dep', '$ad_dep', '$ville_arr', '$ad_arr', '$distance', '$prix', '$date_dep', '1', '$id_voiture', '$id_cond');");
          header('Location: accueil.php');
        }
        else {
          echo "<h2>Inscription<h2>";
          echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
          echo "Ville de depart<input type='text' name='ville_dep' \></br>";
          echo "Adresse de depart<input type='text' name='ad_dep' \></br>";
          echo "Ville d'arrivée<input type='text' name='ville_arr' \></br>";
          echo "Adresse d'arrivée<input type='text' name='ad_arr' \></br>";
          echo "Distance<input type='number' name='distance'/></br>";
          echo "Prix<input type='number' name='prix'/></br>";
          echo "Date de depart<input type='date' name='date_dep' \></br>";
          echo "Voiture<input type='number' name='id_voiture' \></br>";
          echo "<input type='submit' value='Propositon'/>";
        }
      ?>
    </div>
  </body>
</html>
