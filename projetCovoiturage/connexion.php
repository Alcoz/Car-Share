<?php
session_start();
 ?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylesheet.css" />
    <title>Page de connection</title>
  </head>
  <body>
    <div class="connect">
      <?php
        try{
          $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '');
        }catch(Exception $e){
          die('Erreur : '.$e->getMessage());
        }

        if(isset($_POST['mail']) AND isset($_POST['mdp'])){
          $mail = $_POST['mail'];
          $mdp = $_POST['mdp'];

          $query=$pdo->query("SELECT *
                              FROM utilisateur
                              WHERE MAIL ='".$mail."' AND MDP='".$mdp."';");
          $rep=$query->fetch();
          if(!$rep)
          {
            echo "<h3>Le nom d'utilisateur ou le mot de passe est incorrect</h3>";
          }
          else
          {
            $_SESSION['id']=$rep['ID_UTILISATEUR'];
            header('Location: accueil.html');
          }
        }

        echo "<h2>Connection<h2>";
        echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">";
        echo "<input type='text' name='mail' \>";
        echo "<input type='password' name='mdp'/>";
        echo "<input type='submit' value='Connection'/>";
      ?>
    </div>
  </body>
</html>
