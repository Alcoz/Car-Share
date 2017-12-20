<?php
session_start();
?>
<!Doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles/resultat.css" />
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
  if (isset($_POST['in_traj'])) {

  } ?>
  <div id="toutraj">
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $depart = $_POST["depart"];
    $arrive = $_POST["destination"];
    $date  = $_POST["date"];
    if ($_POST["date"] == null) {
      $query = $pdo->query("SELECT *
        FROM TRAJET
        WHERE VILLE_DEP = \"$depart\"
        AND VILLE_ARR =  \"$arrive \"
        AND DISPONIBLE = 1;");
        $tuples= $query->fetchAll(PDO::FETCH_OBJ);
      }
      else {
        $query = $pdo->query("SELECT *
          FROM TRAJET
          WHERE VILLE_DEP = \"$depart\"
          AND VILLE_ARR =  \"$arrive \"
          AND DATE_DEP = \"$date\"
          AND DISPONIBLE = 1;");
          $tuples= $query->fetchAll(PDO::FETCH_OBJ);
        }

        foreach ($tuples as $tuple) {
          $id_cond = $tuple->ID_CONDUCTEUR;
          $query2 = $pdo->query("SELECT *
            FROM UTILISATEUR
            WHERE ID_UTILISATEUR = \"$id_cond\";");

          $tuples2 = $query2->fetchAll(PDO::FETCH_OBJ);
          echo "<div class=\"label\">";
          ?>
          <div class="gauche">
            <img class="imguti" src="images/annony.jpeg"> </img>
            <?php foreach ($tuples2 as $tuple2){
              if (isset($_SESSION['id'])) {
                echo "<p>".$tuple2->NOTE."</p>";
              }
             ?>
          </div>
          <div class="mil">
            <?php
            echo "<p> Prénom : ".$tuple2->PRENOM."</p>";
            if (isset($_SESSION['id'])) {
              echo "<p> Nom : ".$tuple2->NOM."</p>";
              echo "<p> Age : ".$tuple2->AGE."</p>";
            }
             }?>
          </div>
          <div class="drt">
            <?php
            echo "<p> Ville de départ : ".$tuple->VILLE_DEP."</p>";
            echo "<p> Ville d'arrivée : ".$tuple->VILLE_ARR."</p>";
            echo "<p id=\"test\"> Prix : ".$tuple->PRIX."</p>";
            if (isset($_SESSION['id'])) {
              echo "<form id=\"voir_plus\" method=\"post\" action = \"trajet.php\">";
              echo "<input id=\"voir_plus\" type=\"hidden\" name=\"id_trajet\" value=\"$tuple->ID_TRAJET\">";
              echo "<input id=\"voir_plus\" type=\"submit\" name=\"in_traj\" value=\"Voir plus\">";
              echo "</form>";
            } ?>
          </div>

        <?php
      echo "</div>"; }?>
  </div>

</body>
</html>
