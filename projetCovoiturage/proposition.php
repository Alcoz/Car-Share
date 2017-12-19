<?php
session_start();
 ?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylesheet.css" />
    <title>Page de proposition</title>
  </head>
  <body>
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

          $pdo->exec("INSERT INTO TRAJET(TYPE, VILLE_DEP, ADRESSE_DEPART, VILLE_ARR, ADRESSE_ARR, DISTANCE, PRIX, DATE_DEP, DISPONIBLE, ID_VOITURE) VALUES(0,'".$ville_dep."','".$ad_dep."','".$ville_arr."','".$ad_arr."',".$distance.",'".$prix."','".$date_dep.", 0,".$id_voiture.");");
          header('Location: accueil.php');
        }

        echo "<h2>Inscription<h2>";
        echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
        echo "<input type='text' name='ville_dep' \>";
        echo "<input type='text' name='ad_dep' \>";
        echo "<input type='text' name='ville_arr' \>";
        echo "<input type='text' name='ad_arr' \>";
        echo "<input type='number' name='distance'/>";
        echo "<input type='number' name='prix'/>";
        echo "<input type='date' name='date_dep' \>";
        echo "<input type='number' name='id_voiture' \>";
        echo "<input type='submit' value='Propositon'/>";
      ?>
    </div>
  </body>
</html>
