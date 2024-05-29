//1.Indique la durée moyenne de tous les cours dans trois salles.

SELECT S.id_salle, S.nom_salle, ROUND(AVG(EXTRACT(EPOCH FROM (heure_fin - heure_début)) / 3600), 1) AS durée_moyenne_heures_arrondie
FROM Cours C
JOIN Salle S ON C.id_salle = S.id_salle
GROUP BY S.id_salle, S.nom_salle
HAVING COUNT(C.id_cours) > 0;

//2.Calculer le nombre de femmes (F) et d hommes (M) respectivement dans le tableau des personnes.

SELECT sexe, COUNT(*) AS count_by_gender
FROM Personne
GROUP BY sexe;

// 3.Afficher les membres (Membre) avec leur type d abonnement (type_abonnement) et indiquer 'Premium' pour ceux ayant plus de 5 réservations, sinon 'Classique'.

SELECT id_membre, 
       CASE 
           WHEN COUNT(id_reservation) > 5 THEN 'Premium'
           ELSE 'Classique'
       END AS type_abonnement
FROM Reservation
GROUP BY id_membre;

//4.Le tableau des parkings (Parking) et le tableau des véhicules (Véhicule) sont liés et le nombre de voitures et de motos dans chaque parking est calculé en fonction du groupe de parkings.

SELECT Parking.id_parking,
    COUNT(CASE WHEN Vehicule.type_vehicule = 'voiture' THEN 1 END) AS voiture_count,
    COUNT(CASE WHEN Vehicule.type_vehicule = 'moto' THEN 1 END) AS moto_count
FROM Parking , Vehicule 
WHERE Parking.id_parking = Vehicule.id_parking
GROUP BY Parking.id_parking;

//5.Interroger tous les équipements de la salle001 et les classer par date_achat du plus récent au plus récent.

SELECT id_equipement, nom_equipement, état, date_achat
FROM Equipement
WHERE id_salle = 'salle001'
ORDER BY date_achat DESC;

//6.Trouver le même cours dans les trois salles

SELECT nom_cours, COUNT(*) AS occurrences
FROM Cours
GROUP BY nom_cours
HAVING COUNT(*) > 1;


//7.Recherchez tous les cours gerés par des employés ayant le poste de "coach" et triez-les par ID.

SELECT P.id_personne, P.nom, P.prenom, C.nom_cours
FROM Personne P, Cours C
WHERE P.id_personne = C.id_employe
AND P.id_personne IN (
    SELECT id_employe
    FROM Employe
    WHERE poste = 'coach'
)
ORDER BY p.id_personne;


//8.Indique le nombre d employés dans chaque salle

SELECT S.id_salle, COUNT(E.id_employe) AS employe_count
FROM Salle S, Cours C, Employe E  
WHERE S.id_salle = C.id_salle
AND C.id_employe = E.id_employe
GROUP BY S.id_salle;


//9.Obtenir toutes les informations sur un membre sans réservation

SELECT *
FROM Membre
WHERE id_membre NOT IN (
    SELECT id_membre
    FROM Reservation
);

//10.
Comptage des inscriptions par employé : calculez le nombre total d inscriptions par employé et le nombre de cours correspondant.

SELECT E.id_employe, P.nom, P.prenom, 
    COUNT(DISTINCT R.id_membre) AS total_reservations, 
    COUNT(DISTINCT C.id_cours) AS total_cours
FROM Employe E
JOIN Personne P ON E.id_employe = P.id_personne
JOIN Cours C ON E.id_employe = C.id_employe
JOIN Reservation R ON C.id_cours = R.id_cours
GROUP BY E.id_employe, P.nom, P.prenom;



//11.Statistiques sur les inscriptions aux cours par employé : indiquez le nom du cours et le nombre d inscriptions par instructeur.

SELECT E.id_employe, P.nom, P.prenom, C.nom_cours, COUNT(R.id_reservation) AS nombre_reservations
FROM Employe E
JOIN Personne P ON E.id_employe = P.id_personne
JOIN Cours C ON E.id_employe = C.id_employe
JOIN Reservation R ON C.id_cours = R.id_cours
WHERE E.poste = 'coach'
GROUP BY E.id_employe, P.nom, P.prenom, C.nom_cours
ORDER BY E.id_employe, COUNT(R.id_reservation) DESC;

//12. Vérifier les cours les plus populaires : découvrez le nom du cours le plus demandé et le nombre de réservations.

SELECT C.nom_cours, COUNT(R.id_reservation) AS nombre_reservations
FROM Cours C, Reservation R
WHERE C.id_cours = R.id_cours
GROUP BY C.nom_cours
ORDER BY COUNT(R.id_reservation) DESC
LIMIT 1;

