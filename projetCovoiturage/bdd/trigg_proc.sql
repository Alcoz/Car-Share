DELIMITER |
CREATE PROCEDURES moyenne(IN id_util INTEGER)
BEGIN
  SELECT AVG(NOTES)
  FROM AVIS, UTILISATEUR
  WHERE ID_CONDUCTEUR = ID_UTILISATEUR;
END|



DELIMITER |
CREATE TRIGGER prix_abuse BEFORE INSERT
ON TRAJET FOR EACH ROW
BEGIN
    IF NEW.PRIX > (NEW.DISTANCE * 0.1)
      THEN
        SET NEW.PRIX = NEW.DISTANCE*0.1;
    END IF;
END |
DELIMITER ;


DELIMITER |
CREATE TRIGGER traj_complet BEFORE UPDATE
ON TRAJET FOR EACH ROW
BEGIN
    IF NEW.NB_PLACE = 0
      THEN
        SET NEW.DISPONIBLE = FALSE;
    END IF;
END |
DELIMITER ;
