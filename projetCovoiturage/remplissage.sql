DELETE FROM FAIT_TRAJET;
DELETE FROM TRAJET;
DELETE FROM AVIS;
DELETE FROM VOITURE;
DELETE FROM UTILISATEUR;

INSERT INTO UTILISATEUR VALUES (1, "Durand", "Martin", 27, "Homme", "M.dur@hotmail.fr", "mdpmartin", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (2, "Dumoulin", "Astrid", 41, "Femme", "Astrid.Dumoulin@gmail.com", "mdpastrid", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (3, "Delarue", "François", 56, "Homme", "f.delarue@bing.com", "mdpfrancois", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (4, "Dupont", "Cécile", 29, "Femme", "DupontC@hotmail.fr", "mdpcecile", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (5, "Michelet", "Cammile", 23, "Femme", "Mimille@gmail.com", "mdpcamille", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (6, "Diaz", "Anthony", 25, "Homme", "Adiaz@wanadoo.fr", "mdpantho", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (7, "Pourcher", "Axel", 32, "Homme", "Pourcher.axel@hotmail.fr", "mdpmartin", FALSE, NULL);

INSERT INTO VOITURE VALUES (1, 5, 1);
INSERT INTO VOITURE VALUES (2, 5, 2);
INSERT INTO VOITURE VALUES (3, 7, 3);
INSERT INTO VOITURE VALUES (4, 3, 4);
INSERT INTO VOITURE VALUES (5, 5, 5);
INSERT INTO VOITURE VALUES (6, 3, 6);
INSERT INTO VOITURE VALUES (7, 5, 7);

INSERT INTO AVIS VALUES (1, 2, "Très sympa");
INSERT INTO AVIS VALUES (1, 3, "Trahet agréable");
INSERT INTO AVIS VALUES (7, 4, "Aucun problème");
INSERT INTO AVIS VALUES (7, 6, "Très sympa");

INSERT INTO TRAJET VALUES (1, TRUE, "Montpellier", "52 avenue de la Justice", "Amsterdam", "256 avenue de Sframpfeyaa", 100 ,40, NULL, NULL, NULL);
INSERT INTO TRAJET VALUES (2, TRUE, "Bourg-en-Bresse", "Place des chevaliers", "Saint-Malo", "43 chemin de l'école", 200 ,20, NULL, NULL, NULL);
INSERT INTO TRAJET VALUES (3, TRUE, "Toulouse", "183 rue de l'église", "Narbonne", "Parc Anatole France", 300 ,30, NULL, NULL, NULL);
INSERT INTO TRAJET VALUES (4, FALSE, "Lyon", "63 rue des mouettes", "Paris", "12 boulevard lacazette", 250, 25, 15-12-2017, TRUE, 6);
INSERT INTO TRAJET VALUES (5, FALSE, "Montpellier", "26 rue de la Colombière", "Mendes", "17 rue du sablier", 250, 25, 25-12-2017, TRUE, 2);
INSERT INTO TRAJET VALUES (6, FALSE, "Marseille", "56 rue des pommierss", "Lourdes", "75 rue saint Vincent", 400, 25, 18-12-2017, TRUE, 3);
INSERT INTO TRAJET VALUES (7, FALSE, "Lyon", "63 rue des mouettes", "Paris", "12 boulevard lacazette", 150, 25, 27-12-2017, TRUE, 4);

INSERT INTO FAIT_TRAJET VALUES (4, 3);
INSERT INTO FAIT_TRAJET VALUES (5, 3);
INSERT INTO FAIT_TRAJET VALUES (4, 7);
INSERT INTO FAIT_TRAJET VALUES (5, 6);
INSERT INTO FAIT_TRAJET VALUES (6, 4);
