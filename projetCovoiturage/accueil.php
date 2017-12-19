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
          }
          else {
            echo "<a href=\"inscription.php\">  <li> Inscription  </li> </a>";

            echo "<a href=\"connexion.php\">  <li> Connexion </li> </a>";
          }
           ?>
        </ul>
      </nav>
      <?php
      if (isset($_SESSION['id'])) {
              echo "VOUS ETES CONNECTÉ EN TANT QUE :".$_SESSION['id'];
      }
       ?>
      <img id="imagee" src="images/paysage.jpg"> </img>
      <h2> Monte dans la caisse putain </h2>


      <div id="formul">
        <form method="post" action = "resultat.php">
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


      <div id="toulétraj">

        <h2> Les trajet sont la !</h2>
        <?php
        foreach ($tuples as $tuple) {
          ?>
          <div class="trajets_classe">
            <div class="desc_cond">
              <img id="img_uti" src="images/annony.jpeg"> </img>
              <ul class="coord_uti">

            </div>
            <div class="part_droite">
              <ul>
                <li>  <?php echo $tuple->DATE_DEP ?> </li>
                <li> <?php echo $tuple->VILLE_DEP ?>  </li>
                <li>  <?php echo $tuple->VILLE_ARR ?> </li>
                <li>  <?php echo $tuple->ADRESSE_DEPART ?> </li>
                <li> <?php echo $tuple->ADRESSE_ARR?>  </li>
                <li>  <?php echo $tuple->PRIX ?> </li>
              </ul>

          </div>

        <?php }
        ?>
      </div>



    <footer>
    </footer>
  </body>
</html>
