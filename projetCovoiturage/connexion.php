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
    <?php
    if (isset($_SESSION['id'])) {
      echo "VOUS ETES CONNECTÉ EN TANT QUE :".$_SESSION['id'];
    }
    ?>
    <div id="corps_menu">
    </div>
    <div class="connect">
      <?php

      try{
        $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '');
      }catch(Exception $e){
        die('Erreur : '.$e->getMessage());
      }

      if (!isset($_SESSION['id'])) {
        if(isset($_POST['mail']) AND isset($_POST['mdp'])){
          $mail = $_POST['mail'];
          $mdp = $_POST['mdp'];

          $query=$pdo->query("SELECT *
            FROM utilisateur
            WHERE MAIL = \"$mail\" AND MDP = \"$mdp\";");
            $rep=$query->fetch();
            if(!$rep)
            {
              echo "<h3>Le nom d'utilisateur ou le mot de passe est incorrect</h3>";
            }
            else
            {
              $_SESSION['id']=$rep['ID_UTILISATEUR'];
              header('Location: accueil.php');
            }
          }

          echo "<h2>Connection</h2>";
          echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
          echo "<label> Adresse mail </label> <input class=\"connex\" type='text' name='mail' \>";
          echo "<label> Mot de Passe </label> <input type='password' name='mdp'/>";
          echo "<input type='submit' value='Connexion'/>";

        }
        elseif (isset($_POST['deco'])) {
          $_SESSION = array();
          session_destroy();
          header("location: accueil.php");
        }
        else {
          echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
          echo "<input type='submit' name=\"deco\" value='Se Déconnecter'/>";
        }
        ?>

      </div>
    </body>
    </html>
