/*
  21503877 Darnala Baptiste
  20140442 Eliott Duverger
*/
DELIMITER |
DROP PROCEDURE IF EXISTS moyenne|
CREATE PROCEDURE moyenne (IN ID_UTIL INT)
BEGIN
SELECT AVG(NOTES) as MOY
  FROM AVIS, UTILISATEUR
  WHERE ID_CONDUCTEUR = ID_UTIL;
END |

DROP PROCEDURE IF EXISTS nb_traj_dispo |
CREATE PROCEDURE nb_traj_dispo (OUT nb_traj INT)
BEGIN
    SELECT COUNT(*) INTO nb_traj
    FROM TRAJET
    WHERE DISPONIBLE = TRUE
    AND DATE_DEP > NOW();
END |

DROP TRIGGER IF EXISTS prix_abuse |
CREATE TRIGGER prix_abuse BEFORE INSERT
ON TRAJET FOR EACH ROW
BEGIN
    IF NEW.PRIX > (NEW.DISTANCE * 0.1)
      THEN
        SET NEW.PRIX = NEW.DISTANCE*0.1;
    END IF;
END |

DROP TRIGGER IF EXISTS traj_complet |
CREATE TRIGGER traj_complet BEFORE UPDATE
ON TRAJET FOR EACH ROW
BEGIN

    IF NEW.NB_PLACE = 0
      THEN
        SET NEW.DISPONIBLE = FALSE;
    END IF;
END |
DELIMITER;
