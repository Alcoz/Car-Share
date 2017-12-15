<!Doctype html>
<?php
session_start();

 ?>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylesheet.css" />
    <title>Page de connection</title>
  </head>
  <body>
    <div class="connect">
    <h2> Connection </h2>
      <?php
        try{
          $dsn = "mysql:host=prodpeda-venus;dbname=bdarnala";
          $pdo = new PDO($dsn,"bdarnala","mdp12345",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }catch(Exception $e){
          die('Erreur : '.$e->getMessage());
        }

        class Utilisateur{
          private $nom = "";
          private $prenom = "";

          public function __construct($mail){
            $query=$pdo->query("SELECT *
                                FROM UTILISATEUR
                                WHERE MAIL = $mail;");
            $tuple=$query->fetch();
            $this->nom = $tuple->nom;
            $this->prenom = $tuple->prenom;
          }
        }

        $utilisateur = 'NULL';

        if(isset($_POST['connection'])){
          $query=$pdo->query("SELECT MAIL,MDP
                              FROM UTILISATEUR
                              WHERE MAIL =\'$_POST['mail']\';");
          $tuple=$query->fetch();

          if(is_null($tuple) || $POST['mail']!=$tuple->MAIL || $POST['mdp']!=$tuple->MDP){
            echo "<h3>Le nom d'utilisateur ou le mot de passe est incorrect</h3>"
          } else {
            $utilisateur = new Utilisateur($POST['mail']);
          }
        }
        $_SESSION['Utilisateur'] = $utilisateur;

      ?>
    </div>
  </body>
</html>
