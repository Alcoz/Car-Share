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
          <a id="acc" href="accueil.html">  <li> <b> Car-Share </li> </b> </a>
          <a href="blank">  <li>Proposer un trajet  </li> </a>
          <a href="blank">  <li> Inscription  </li> </a>
          <a href="blank">  <li> Connexion </li> </a>
        </ul>
      </nav>
      <img id="imagee" src="images/paysage.jpg"> </img>
      <h2> Monte dans la caisse putain </h2>

      <div id="formul">
        <form method="post" action = "traitement.php">
          <label>  Départ :</label> <input id="home" type="text" name = "depart"/>
          <label> Destination :</label> <input  id="curs" type="text" name = "destination"/>
          <label> Date : </label> <input  id="calen" type="date" name = "date"/>
          <input id="valider" type="submit" name = "recherche"/>
        </form>
      </div>
      <div id="toulétraj">

        <h2> Les trajet sont la !</h2>
        <?php
        for($i = 0; $i < 3; i++) {
          ?>
          <div class="trajets_classe">
            <div class="desc_cond">
              <img src="images/anno.jpeg"> </img>
              <p> Prénom </p>
              <p> Age </p>
              <p> Avis </p>
            </div>
            <div class="desc_traj">
              <ul>
                <li> Date </li>
                <li> VILLE_DEP </li>
                <li> VILLE_ARR </li>
                <li> ADRESSE_DEPART </li>
                <li> ADRESSE_ARR </li>
                <li> PRIX </li>
              </ul>
            </div>
          </div>

        <?php }
        ?>
      </div>



    <footer>
    </footer>
  </body>
</html>
