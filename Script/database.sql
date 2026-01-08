CREATE DATABASE mabagnole;
USE mabagnole;

CREATE TABLE utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    role ENUM('Client', 'Admin') NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    telephone VARCHAR(20) UNIQUE,
    cin VARCHAR(20) UNIQUE,
    is_active BOOLEAN DEFAULT TRUE

);

CREATE TABLE categories (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE vehicules (
    id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
    modele VARCHAR(100) NOT NULL,
    marque VARCHAR(100) NOT NULL,
    prix_jour DECIMAL(10,2) NOT NULL,
    disponibilite BOOLEAN DEFAULT TRUE,
    image VARCHAR(255),
    boite_vitesse VARCHAR(50),
    motorisation VARCHAR(50),
    id_categ INT NOT NULL,
    CONSTRAINT fk_categorie
        FOREIGN KEY (id_categ) REFERENCES categories(id_categorie)
        ON DELETE RESTRICT
);

CREATE TABLE reservations (
    id_reservation INT PRIMARY KEY AUTO_INCREMENT,
    id_client INT NOT NULL,
    id_vehi INT NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    statut ENUM('En Attente','Refusee','Approuvee') NOT NULL,
    lieu_prise VARCHAR(255) NOT NULL,
    lieu_retour VARCHAR(255) NOT NULL,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_client
        FOREIGN KEY (id_client) REFERENCES utilisateurs(id_utilisateur)
        ON DELETE CASCADE,
    CONSTRAINT fk_vehicule
        FOREIGN KEY (id_vehi) REFERENCES vehicules(id_vehicule)
        ON DELETE CASCADE
);

CREATE TABLE avis (
    id_avis INT PRIMARY KEY AUTO_INCREMENT,
    statut BOOLEAN DEFAULT TRUE,
    commentaire TEXT,
    note INT CHECK (note BETWEEN 1 AND 5),
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_reservation int NOT NULL,
    CONSTRAINT fk_reservatioin
        FOREIGN KEY (id_reservation) REFERENCES reservations(id_reservation)
        ON DELETE CASCADE
);

CREATE TABLE favoris (
    id_client INT NOT NULL,
    id_vehi INT NOT NULL,
    date_favori TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_client, id_vehi),
    CONSTRAINT fk_favoris_client
        FOREIGN KEY (id_client) REFERENCES utilisateurs(id_utilisateur)
        ON DELETE CASCADE,
    CONSTRAINT fk_favoris_vehicule
        FOREIGN KEY (id_vehi) REFERENCES vehicules(id_vehicule)
        ON DELETE CASCADE
);

ALTER TABLE vehicules
ADD COLUMN immatriculation UNIQUE;

ALTER TABLE categories
ADD COLUMN image varchar(255);



DELIMITER $$

CREATE PROCEDURE maj_disponibilite_vehicule()
BEGIN
    UPDATE vehicules v
    JOIN reservations r ON r.id_vehi = v.id_vehicule
    SET v.disponibilite = 0
    WHERE r.statut = 'Approuvee'
      AND DATE(r.date_debut) = CURDATE();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE liberer_vehicules()
BEGIN
    UPDATE vehicules v
    JOIN reservations r ON r.id_vehi = v.id_vehicule
    SET v.disponibilite = 1
    WHERE r.statut = 'Approuvee'
      AND DATE(r.date_fin) < CURDATE();
END $$

DELIMITER ;

/*Activer le scheduler d’événements*/
SET GLOBAL event_scheduler = ON;

/* verification*/
SHOW VARIABLES LIKE 'event_scheduler';


/*l’event qui s’exécute chaque jour*/
DELIMITER $$

CREATE EVENT IF NOT EXISTS event_maj_disponibilite_vehicule
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_DATE
DO
BEGIN
    CALL maj_disponibilite_vehicule();
END $$

DELIMITER ;

/*Event pour libérer le véhicule*/

DELIMITER $$

CREATE EVENT IF NOT EXISTS event_liberer_vehicules
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_DATE
DO
BEGIN
    CALL liberer_vehicules();
END $$

DELIMITER ;





