--procedures de recherche
DELIMITER |
CREATE PROCEDURES recherche(IN depart VARCHAR, IN arrivee VARCHAR,IN dateDep DATE)
BEGIN
  SELECT *
  FROM TRAJET
  WHERE VILLE_DEP = depart AND VILLE_ARR = arrivee AND DATE_DEP = dateDep;
END|
