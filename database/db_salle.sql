-- table Carte 
CREATE TABLE Carte (
    id_carte VARCHAR(20) PRIMARY KEY,
    type_carte VARCHAR(20) NOT NULL，
    date_achat DATE NOT NULL CHECK(date_achat >= '2022-01-01' AND date_achat <= '2023-12-31'),
    date_expiration DATE CHECK(date_expiration >= '2022-01-01'),
    CONSTRAINT check_type_carte CHECK (type_carte IN ('Membre', 'Employé'))
);

--  table Personne 
CREATE TABLE Personne (
    id_personne VARCHAR(9) PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prénom VARCHAR(30) NOT NULL,
    sexe CHAR(1) NOT NULL,
    num_téléphone CHAR(10) NOT NULL,
    adress_mail VARCHAR(30) NOT NULL,
    login VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(20) NOT NULL,
    id_carte VARCHAR(20),
    FOREIGN KEY (id_carte) REFERENCES Carte(id_carte)
);

--  Créer une table Membre, héritée de Personne
CREATE TABLE Membre (
    id_membre VARCHAR(9) NOT NULL,
    type_abonnement VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_membre),
    FOREIGN KEY (id_membre) REFERENCES Personne(id_personne),
    CONSTRAINT check_type_abonnement CHECK (type_membre IN ('Classique', 'premium', 'famille'))
);

-- Créer une table Employé, héritée de Personne
CREATE TABLE Employe (
    id_employe VARCHAR(9) NOT NULL,
    poste VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_employé),
    FOREIGN KEY (id_employé) REFERENCES Personne(id_personne)
);

-- table Salle 
CREATE TABLE Salle (
    id_salle CHAR(8) PRIMARY KEY,
    nom_salle VARCHAR(30) NOT NULL,
    adress_salle VARCHAR(100) NOT ULL,
    date_fondation DATE NOT NULL CHECK(date_fondation >= '2022-01-01' AND date_fondation <= '2023-12-31')
);

-- table Cours
CREATE TABLE Cours (
    id_cours CHAR(8) PRIMARY KEY,
    nom_cours VARCHAR(30) NOT NULL,
    heure_début TIME NOT NULL CHECK(heure_début >= '08:00:00' AND heure_début <= '20:00:00'),
    heure_fin TIME NOT NULL CHECK(heure_fin >= '10:00:00' AND heure_fin <= '22:00:00'),
    type_cours VARCHAR(20) NOT NULL,
    id_salle CHAR(8),
    id_employe VARCHAR(9),
    FOREIGN KEY (id_salle) REFERENCES Salle(id_salle),
    FOREIGN KEY (id_employé) REFERENCES Employé(id_employé)
);


-- table Reservation
CREATE TABLE Reservation (
    id_reservation CHAR(13) PRIMARY KEY,
    date_début DATE NOT NULL CHECK(date_début >= '2022-01-01' AND date_début <= '2023-12-31'),
    date_fin DATE NOT NULL CHECK(date_fin >= '2022-01-01' AND date_fin <= '2023-12-31'),
    id_membre VARCHAR(9),
    id_cours CHAR(8),
    FOREIGN KEY (id_membre) REFERENCES Membre(id_membre),
    FOREIGN KEY (id_cours) REFERENCES Cours(id_cours)
);
 


--  table Equipement 
CREATE TABLE Equipement (
    id_equipement CHAR(13) PRIMARY KEY,
    nom_equipement VARCHAR(30) NOT NULL,
    état VARCHAR(20) NOT NULL,
    date_achat DATE NOT NULL CHECK(date_achat >= '2022-01-01' AND date_achat <= '2023-12-31'),
    id_salle CHAR(8),
    FOREIGN KEY (id_salle) REFERENCES Salle(id_salle)
);


-- table Parking 
CREATE TABLE Parking (
    id_parking CHAR(11) PRIMARY KEY,
    capacite INTEGER NOT NULL,
    CHECK (capacite >= 0)
);

-- table Véhicule
CREATE TABLE Vehicule (
    id_vehicule CHAR(11) PRIMARY KEY,
    type_vehicule VARCHAR(20) NOT NULL,
    id_parking CHAR(11) REFERENCES Parking(id_parking),
    CONSTRAINT check_type_véhicule CHECK (type_véhicule IN ('voiture', 'moto'))
);

-- table Portique 
CREATE TABLE Portique (
    id_portique CHAR(10) PRIMARY KEY,
    type_portique VARCHAR(20) NOT NULL,
    adress_portique VARCHAR(40) NOT NULL,
    état VARCHAR(20) NOT NULL,
    id_parking CHAR(11),
    id_salle CHAR(8),
    FOREIGN KEY (id_parking) REFERENCES Parking(id_parking),
    FOREIGN KEY (id_salle) REFERENCES Salle(id_salle),
    CONSTRAINT check_type_portique CHECK (type_portique IN ('Employé', 'Membre','Mixte'))
);



-- table Scanne
CREATE TABLE Scanne (
    id_portique CHAR(10),
    id_carte CHAR(9),
    FOREIGN KEY (id_portique) REFERENCES Portique(id_portique),
    FOREIGN KEY (id_carte) REFERENCES Carte(id_carte)
);


INSERT INTO Carte (id_carte, type_carte, date_achat, date_expiration)
VALUES
    ('carteA001', 'Membre' , '2022-01-01', '2023-01-01'),
    ('carteA002', 'Membre' , '2022-03-01', '2023-03-01'),
    ('carteA003', 'Membre' , '2022-05-01', '2022-05-01'),
    ('carteB001', 'Employé', '2022-07-01', '2030-01-01'),
    ('carteB002', 'Employé', '2022-09-01', '2030-01-01'),
    ('carteC001', 'Employé', '2022-09-01', '2030-01-01'),
    ('carteD001', 'Employé', '2022-09-01', '2030-01-01');




INSERT INTO Personne (id_personne, nom, prenom, sexe, num_téléphone, adress_mail, login, mot_de_passe, id_carte)
VALUES
    ('A1', 'Dupont', 'Pierre', 'M', '0123456789', 'pierre@gmail.com', 'Pierre1234', 'Pierre@1#2', 'carteA001'),
    ('A2', 'Dubois', 'Marie', 'F', '9876543210', 'marie@yahoo.com', 'Marie5678', 'Marie@3$4','carteA002' ),
    ('A3', 'Martin', 'Jean', 'M', '0123456789', 'jean@outlook.com', 'Jean9999', 'Jean@5%6', 'carteA003'),
    ('B1', 'Lefebvre', 'Sophie', 'F', '9876543210', 'sophie@gmail.com', 'Sophie8888', 'Sophie@7&8', 'carteB001'),
    ('B2', 'Leclerc', 'Luc', 'M', '0123456789', 'luc@yahoo.com', 'Luc6666', 'Luc@9*0', 'carteC001'),
    ('C1', 'Garcia', 'Luis', 'M', '0123456789', 'luis@gmail.com', 'Luis1234', 'Luis@1#2', 'carteA002'),
    ('D1', 'Lopez', 'Maria', 'F', '9876543210', 'maria@yahoo.com', 'Maria5678', 'Maria@3$4', 'carteD001');


INSERT INTO Membre (id_membre,type_abonnement)
VALUES ('A1','Classique'), ('A2', 'premium'), ('A3','famille');

INSERT INTO Employe (id_employe, poste)
VALUES  ('B1', 'coach'), ('B2', 'coach'),  ('C1', 'accueil'), ('D1', 'gardien');

INSERT INTO Salle (id_salle, nom_salle,date_fondation,adress_salle)
VALUES
    ('salle001', 'Salle A', '2022-03-15', '123 Main St, City A'),
    ('salle002', 'Salle B', '2022-05-20', '456 Elm St, Town B'),
    ('salle003', 'Salle C', '2022-07-10', '789 Oak St, Village C');


INSERT INTO Cours (id_cours, nom_cours, heure_début, heure_fin, type_cours, id_salle, id_employe)
VALUES
    ('cours001', 'Yoga', '08:30', '10:00', 'Yoga', 'salle001', 'B1'),
    ('cours002', 'Musculation', '10:00', '11:30', 'musculation', 'salle001', 'B1'),
    ('cours003', 'Cardio', '14:00', '15:30', 'cardio', 'salle001', 'B1'),
    ('cours004', 'Boxe', '16:00', '17:30', 'Boxe', 'salle002', 'B2'),
    ('cours005', 'Pilates', '18:30', '20:00', 'Pilates', 'salle002', 'B2');
    ('cours006', 'Zumba', '10:00', '12:00', 'Zumba', 'salle003', 'B2');
    ('cours007', 'Powerlifting', '10:00', '12:00', 'Powerlifting', 'salle003', 'B1');
    ('cours008', 'Cardio', '16:00', '17:30', 'cardio', 'salle003', 'B1')
    ('cours009', 'Cardio', '14:00', '15:30', 'cardio', 'salle002', 'B1'),

    



INSERT INTO Reservation (id_reservation, date_début, date_fin, id_membre, id_cours)
VALUES
    ('reser1', '2022-01-02', '2023-12-31', 'A1', 'cours001'),
    ('reser2', '2022-03-05', '2023-12-31', 'A2', 'cours002'),
    ('reser3', '2022-05-07', '2023-12-31', 'A3', 'cours003'),
    ('reser4', '2022-07-09', '2023-12-31', 'A3', 'cours003'),
    ('reser5', '2022-09-11', '2023-12-31', 'A1', 'cours005');



INSERT INTO Equipement (id_equipement, nom_equipement, état, date_achat, id_salle)
VALUES
    ('equipement001', 'Tapis de course', 'disponible', '2022-02-01', 'salle001'),
    ('equipement002', 'Haltères', 'disponible', '2022-03-15', 'salle001'),
    ('equipement003', 'Vélo elliptique', 'disponible', '2022-04-20', 'salle001'),
    ('equipement004', 'Rameur', 'disponible', '2022-05-10', 'salle002'),
    ('equipement005', 'Banc de musculation', 'disponible', '2022-06-05', 'salle002');


INSERT INTO Parking (id_parking, capacite)
VALUES
    ('parking001', 100),
    ('parking002', 250),
    ('parking003', 100);


INSERT INTO Vehicule(id_vehicule, type_vehicule,id_parking)
VALUES
    ('vehicule001','voiture','parking001'),
    ('vehicule002','moto', 'parking002'),
    ('vehicule003','moto', 'parking003'),
    ('vehicule004','voiture','parking001'),
    ('vehicule005','voiture','parking002');


INSERT INTO Portique (id_portique,type_portique,adress_portique, état, id_parking, id_salle)
VALUES
    ('portiqueA1', 'Mixte', 'Parking ', 'Marche', 'parking001', NULL),
    ('portiqueA2', 'Membre', 'Salle', 'Marche', NULL, 'salle001'),
    ('portiqueA3', 'Employé', 'Salle', 'Marche', NULL, 'salle001'),
    ('portiqueB1', 'Mixte', 'Parking ', 'Marche', 'parking002', NULL),
    ('portiqueB2', 'Membre', 'Salle', 'Marche', NULL, 'salle002'),
    ('portiqueB3', 'Employé', 'Salle', 'Marche', NULL, 'salle002'),
    ('portiqueC1', 'Mixte', 'Parking ', 'Marche', 'parking003', NULL),
    ('portiqueC2', 'Membre', 'Salle', 'Marche', NULL, 'salle003'),
    ('portiqueC3', 'Employé', 'Salle', 'Marche', NULL, 'salle003')



INSERT INTO Scanne (id_portique, id_carte)
VALUES
    ('portiqueA1', 'carteA001'),
    ('portiqueA2', 'carteB001'),
    ('portiqueB2', 'carteA002'),
    ('portiqueB2', 'carteB002'),
    ('portiqueB2', 'carteC001');
