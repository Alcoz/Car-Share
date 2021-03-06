/*
  21503877 Darnala Baptiste
  20140442 Eliott Duverger
*/

DELETE FROM FAIT_TRAJET;
DELETE FROM TRAJET;
DELETE FROM AVIS;
DELETE FROM UTILISATEUR;

INSERT INTO UTILISATEUR VALUES (1, "Durand", "Martin", 27, "Homme", "M.dur@hotmail.fr", "mdpmartin", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (2, "Dumoulin", "Astrid", 41, "Femme", "Astrid.Dumoulin@gmail.com", "mdpastrid", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (3, "Delarue", "François", 56, "Homme", "f.delarue@bing.com", "mdpfrancois", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (4, "Dupont", "Cécile", 29, "Femme", "DupontC@hotmail.fr", "mdpcecile", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (5, "Michelet", "Cammile", 23, "Femme", "Mimille@gmail.com", "mdpcamille", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (6, "Diaz", "Anthony", 25, "Homme", "Adiaz@wanadoo.fr", "mdpantho", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (7, "Pourcher", "Axel", 32, "Homme", "Pourcher.axel@hotmail.fr", "mdpmartin", FALSE, NULL);
INSERT INTO UTILISATEUR VALUES (8, "admin", "admin", 150, "Homme", "no_reply@gouv.fr", "admin", TRUE, 5);


INSERT INTO AVIS VALUES (1, 2, 5,"Très sympa");
INSERT INTO AVIS VALUES (1, 3, 4,"Trajet agréable");
INSERT INTO AVIS VALUES (7, 4, 5,"Aucun problème");
INSERT INTO AVIS VALUES (7, 6, 5,"Très sympa");
INSERT INTO AVIS VALUES (7, 3, 3,"Très beaux paysages");
INSERT INTO AVIS VALUES (5, 7, 1,"Vegan");
INSERT INTO AVIS VALUES (5, 4, 2,"Parle beacoup trop");
INSERT INTO AVIS VALUES (5, 1, 4,"Elle m'a attaqué quand j'ai ouvert mon sandwich au jambon");

INSERT INTO TRAJET VALUES (1, TRUE, "Montpellier", NULL, "Amsterdam", NULL, 100 ,40, NULL, NULL, NULL, NULL);
INSERT INTO TRAJET VALUES (2, TRUE, "Bourg-en-Bresse", NULL, "Saint-Malo", NULL, 200 ,20, NULL, NULL, NULL, NULL);
INSERT INTO TRAJET VALUES (3, TRUE, "Toulouse", NULL, "Narbonne", NULL, 300 ,30, NULL, NULL, NULL, NULL);
INSERT INTO TRAJET VALUES (4, FALSE, "Lyon", "63 rue des mouettes", "Paris", "12 boulevard lacazette", 250, 22, '2017-12-22', TRUE, 1, 2);
INSERT INTO TRAJET VALUES (5, FALSE, "Montpellier", "26 rue de la Colombière", "Mendes", "17 rue du sablier", 250, 23, '2017-12-25', TRUE, 7, 1);
INSERT INTO TRAJET VALUES (6, FALSE, "Marseille", "56 rue des pommierss", "Lourdes", "75 rue saint Vincent", 400, 24, '2017-12-18', TRUE, 5, 2);
INSERT INTO TRAJET VALUES (7, FALSE, "Lyon", "63 rue des mouettes", "Paris", "12 boulevard lacazette", 150, 25, '2017-12-24', TRUE, 1, 3);
INSERT INTO TRAJET VALUES (8, FALSE, "Montpellier", "Clinique St Roq", "Paris", "l'Elysé", 250, 25, '2017-12-25', TRUE, 3, 6);
INSERT INTO TRAJET VALUES (9, FALSE, "Montpellier", "13 avenue du pic saint loup","Paris", "56 rue de la Paix", 410, 25, '2017-12-25', TRUE, 2, 3);
INSERT INTO TRAJET VALUES (10, FALSE, "Montpellier", "Arret de tram : Les Sabines", "Paris", "Chatelet", 430, 25, '2017-12-25', TRUE, 1, 3);
INSERT INTO TRAJET VALUES (11, FALSE, "Montpellier", "Place de la comédie", "Paris", "Montmartre", 428, 25, '2017-12-25', TRUE, 4, 1);
INSERT INTO TRAJET VALUES (12, FALSE, "Perols", "12 rue du mas rouge", "Barcelone", "35 calle de la libertad", 256, 36.5, '2016-12-25', FALSE, 6, 2);


INSERT INTO FAIT_TRAJET VALUES (4, 1);
INSERT INTO FAIT_TRAJET VALUES (4, 2);
INSERT INTO FAIT_TRAJET VALUES (4, 3);
INSERT INTO FAIT_TRAJET VALUES (5, 7);
INSERT INTO FAIT_TRAJET VALUES (5, 4);
INSERT INTO FAIT_TRAJET VALUES (5, 6);
INSERT INTO FAIT_TRAJET VALUES (5, 3);
INSERT INTO FAIT_TRAJET VALUES (6, 5);
INSERT INTO FAIT_TRAJET VALUES (6, 4);
INSERT INTO FAIT_TRAJET VALUES (6, 1);
INSERT INTO FAIT_TRAJET VALUES (7, 1);
INSERT INTO FAIT_TRAJET VALUES (7, 6);
INSERT INTO FAIT_TRAJET VALUES (7, 5);
INSERT INTO FAIT_TRAJET VALUES (8, 3);
INSERT INTO FAIT_TRAJET VALUES (8, 1);
INSERT INTO FAIT_TRAJET VALUES (9, 2);
INSERT INTO FAIT_TRAJET VALUES (9, 7);
INSERT INTO FAIT_TRAJET VALUES (10, 1);
INSERT INTO FAIT_TRAJET VALUES (10, 3);
INSERT INTO FAIT_TRAJET VALUES (11, 4);
INSERT INTO FAIT_TRAJET VALUES (11, 5);
INSERT INTO FAIT_TRAJET VALUES (12, 6);
INSERT INTO FAIT_TRAJET VALUES (12, 2);
