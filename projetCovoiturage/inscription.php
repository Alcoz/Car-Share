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
    <div class="connect">
      <?php
        try{
          $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '');
        }catch(Exception $e){
          die('Erreur : '.$e->getMessage());
        }

        if(isset($_POST['nom']) AND isset($_POST['prenom'])  AND isset($_POST['age']) AND isset($_POST['SEXE']) AND isset($_POST['mail']) AND isset($_POST['mdp'])){
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $sexe = $_POST['SEXE'];
          $age = $_POST['age'];
          $mail = $_POST['mail'];
          $mdp = $_POST['mdp'];

          $query=$pdo->query("SELECT *
                              FROM utilisateur
                              WHERE MAIL ='".$mail."';");
          $rep=$query->fetch();
          if(!$rep)
          {
            $pdo->exec("INSERT INTO UTILISATEUR(NOM, PRENOM, AGE, SEXE, MAIL, MDP, ETAT, NOTE) VALUES('".$nom."','".$prenom."',".$age.",'".$sexe."','".$mail."','".$mdp."',FALSE,NULL);");
            header('Location: connexion.php');
          }
          else
          {
            echo "<h3>L'adresse mail rentrée est déjà utilisée </h3>";
          }
        }

        echo "<h2>Inscription</h2>";
        echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
        echo "<div id=\"gauche\">";
        echo "<label> Nom de famille : </label> <input type='text' name='nom' \>";
        echo "<label> Prenom : </label> <input type='text' name='prenom' \>";
        echo "<label> Age : </label> <input class=\"voila\" type='number' name='age' \>";


        echo "<label> Adresse mail : </label> <input class=\"voila\" type='mail' name='mail'/>";
        echo "<label> Mot de passe : </label> <input class=\"voila\"type='password' name='mdp'/>";
        echo "<input type='submit' value='Inscription'/>";
        echo "</div>";

        echo "<div id=\"droite\">";
        echo "<input type='radio' name='SEXE' value='HOMME' id='HOMME' /> <label id=\"pute\" for='HOMME'>Homme</label><br />";
        echo "<input type='radio' name='SEXE' value='FEMME' id='FEMME' /> <label id=\"pute\" for='FEMME'>Femme</label><br />";

        echo "</div>";
      ?>
    </div>
  </body>
</html>
