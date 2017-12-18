<!Doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles/resultat.css" />
  <title>Car-Share - Accueil</title>
</head>
<body>
  <nav>
    <ul id="menu">
      <a id="acc" href="accueil.php">  <li> Car-Share </li> </a>
      <a href="blank">  <li>Proposer un trajet  </li> </a>
      <a href="blank">  <li> Inscription  </li> </a>
      <a href="blank">  <li> Connexion </li> </a>
    </ul>
  </nav>


  <?php
  $pdo = new PDO('mysql:host=localhost;dbname=carshare;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  $depart = $_POST["depart"];
  $arrive = $_POST["destination"];
  $date  = $_POST["date"];
  echo $_POST["depart"]. $_POST["destination"] . $_POST["date"];
  if ($_POST["date"] == null) {
    $query = $pdo->query("SELECT *
                          FROM TRAJET
                          WHERE VILLE_DEP = \"$depart\"
                          AND VILLE_ARR =  \"$arrive \";");
  $tuples= $query->fetchAll(PDO::FETCH_OBJ);
  }
  else {
    $query = $pdo->query("SELECT *
                          FROM TRAJET
                          WHERE VILLE_DEP = \"$depart\"
                          AND VILLE_ARR =  \"$arrive \"
                          AND DATE_DEP = \"$date\";");
  $tuples= $query->fetchAll(PDO::FETCH_OBJ);
  }
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
