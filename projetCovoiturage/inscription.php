<?php
session_start();
 ?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/connexion.css.css" />
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
    <div class="inscription">
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

        echo "<h2>Inscription<h2>";
        echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
        echo "<input type='text' name='nom' \>";
        echo "<input type='text' name='prenom' \>";
        echo "<input type='number' name='age' \>";
        echo "<input type='radio' name='SEXE' value='HOMME' id='HOMME' /> <label for='HOMME'>Homme</label><br />";
        echo "<input type='radio' name='SEXE' value='FEMME' id='FEMME' /> <label for='FEMME'>Femme</label><br />";
        echo "<input type='mail' name='mail'/>";
        echo "<input type='password' name='mdp'/>";
        echo "<input type='submit' value='Inscription'/>";
      ?>
    </div>
  </body>
</html>
