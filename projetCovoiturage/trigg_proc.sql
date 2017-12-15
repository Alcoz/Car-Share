--procedures de recherchez
DELIMITER |
CREATE PROCEDURES recherche(IN depart VARCHAR, IN arrivee VARCHAR,IN dateDep DATE)
BEGIN
  SELECT *
  FROM TRAJET
  WHERE VILLE_DEP = depart AND VILLE_ARR = arrivee AND DATE_DEP = dateDep;
END|

--renvoie la moyenne des notes
CREATE PROCEDURES(IN note INT, IN sommeNote INT, INOUT moyenne INT)
BEGIN
  SELECT
END|

--renvoie le nombre de personnes inscrit sur un trajet
CREATE PROCEDURES total_personnes_trajet(IN id_traj INT)
BEGIN
  SELECT count(*)
  FROM TRAJET, FAIT_TRAJET
  WHERE TRAJET.ID_TRAJET = FAIT_TRAJET.ID_TRAJET
  AND ID_TRAJET = id_traj;
END|

--trigger qui empeche de mettre des prix trop grands
CREATE TRIGGER prix_elevee BEFORE INSERT
ON TRAJET FOR EACH ROW
BEGIN
  IF NEW.PRIX > NEW.DISTANCE * 0.1
    THEN
      INSERT INTO Erreur (erreur) VALUES ('Erreur : Le prix est trop élevée');
  END IF;
END |

--trigger after insert qui modifie la disponibilte apres l'ajout d'un trajet
CREATE TRIGGER disponibilte AFTER INSERT
ON FAIT_TRAJET FOR EACH ROW
BEGIN
  IF (total_personnes_trajet(NEW.ID_TRAJET) > )
