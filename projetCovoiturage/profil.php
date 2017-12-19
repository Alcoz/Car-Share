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
      <div id="traj">
        <h3> Vos trajets en tant que conducteur </h3>
        <?php
        $query4 = $pdo->query("SELECT *
                              FROM TRAJET
                              WHERE ID_CONDUCTEUR = \"$id\" ;");
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




    </body>
    </html>
