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
      <img id="imagee" src="images/paysage.jpg"> </img>
      <h2> Monte dans la caisse putain </h2>


      <div id="formul">
        <form method="post" action = "resultat.php">
          <label> Départ :</label> <input id="home" type="text" name = "depart"/>
          <label> Destination :</label> <input  id="curs" type="text" name = "destination"/>
          <label> Date : </label> <input  id="calen" type="date" name = "date"/>
          <input id="valider" type="submit" name = "recherche"/>
        </form>
      </div>

      <?php
      $query = $pdo->query("SELECT *
                            FROM TRAJET
                            WHERE TYPE = 1
                            ;"
                          );
      $tuples= $query->fetchAll(PDO::FETCH_OBJ);
      ?>


      <div id="toulétraj">

        <h2> Les trajets types  !</h2>
        <?php
        foreach ($tuples as $tuple) {
          ?>
            <div class="traj_type">
              <ul>
                <li> Ville de départ :  <?php echo $tuple->VILLE_DEP ?>  </li>
                <li id="mil"> Ville d'arrivée : <?php echo $tuple->VILLE_ARR ?> </li>
                <li id="drte"> Prix :  <?php echo $tuple->PRIX ?> </li>
              </ul>

          </div>

        <?php }
        ?>
      </div>



    <footer>
    </footer>
  </body>
</html>
