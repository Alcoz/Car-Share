<?php
session_start();
?>
<!Doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles/admin.css" />
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
    <div id="corps_menu">
    </div>
    <div id="corps">

    <div class="carre">
      <h3> Proposer un trajet type </h3>
      <?php
      if (isset($_POST['prop_traj_type'])) {
        $vil_dep  = $_POST['ville_dep'];
        $vil_ar = $_POST['ville_arr'];
        $prix = $_POST['prix'];
        $pdo->exec("INSERT INTO TRAJET (TYPE, VILLE_DEP, VILLE_ARR, PRIX) VALUES (TRUE, \"$vil_dep\", \"$vil_ar\", \"$prix\");");
        echo "<p> Trajet type soumis </p>";


      }
      else {
        echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
        echo "Ville de depart<input type='text' name='ville_dep' \></br>";
        echo "Ville d'arrivée<input type='text' name='ville_arr' \></br>";
        echo "Prix<input type='number' name='prix'/></br>";
        echo "<input id=\"subm\" type='submit' name='prop_traj_type' value='Propositon'/>";

      }?>
    </div>
    <div class="carre" id="bite">
      <h3> Supprimer un Utilisateur </h3>
      <?php
      if (isset($_POST['username'])) {
        $hommme_a_abbattre = $_POST['username'];
        echo "<p> Nous nous en sommes chargé </p>";
        $pdo->exec("DELETE FROM UTILISATEUR
                    WHERE ID_UTILISATEUR = \"$hommme_a_abbattre\";");
      }
      else {



      $query3 = $pdo->query("SELECT *
        FROM UTILISATEUR;");

        $full_uti = $query3->fetchAll(PDO::FETCH_OBJ);
        ?>
        <form method="post" action="{$_SERVER['PHP_SELF']}" name="submit">
          <select name="username">
            <option>-----Utilisateurs------</option>

            <?php
            foreach ($full_uti as $tuple) {
              echo "<option value=\"$tuple->ID_UTILISATEUR\"> $tuple->PRENOM $tuple->NOM </option>";
            }
            ?>
          </select>

          <input id="subm"  type="submit" value="Anihiler" name="suprr_ut">
        </form>
      <?php } ?>
      </div>
    </div>
  </body>
  </html>
