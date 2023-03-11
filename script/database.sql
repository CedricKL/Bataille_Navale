DROP DATABASE IF EXISTS bataille;
CREATE DATABASE bataille;
USE bataille;
DROP TABLE IF EXISTS joueur, partie, jouer, navire ;

CREATE TABLE joueur 
(
    pseudo VARCHAR(30) UNIQUE,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    sexe CHAR(2),
    ville VARCHAR(30),
    mdp VARCHAR(40) NOT NULL,
    rol VARCHAR(10) NOT NULL,
    PRIMARY KEY (pseudo)
)
;

CREATE TABLE partie 
(
    idPartie INTEGER AUTO_INCREMENT,
    Grillej1 VARCHAR(255) NOT NULL,
    Grillej2 VARCHAR(255) NOT NULL,
    tour INTEGER NOT NULL,
    etat INTEGER NOT NULL,
    PRIMARY KEY (idPartie)
);

CREATE TABLE jouer
(
    idPartie INTEGER,
    pseudo VARCHAR(30) UNIQUE,
    PRIMARY KEY (idPartie,pseudo),
    FOREIGN KEY (idPartie) REFERENCES partie(idPartie),
    FOREIGN KEY (pseudo) REFERENCES joueur(pseudo)
)
;
CREATE TABLE navire 
(
    idNavire VARCHAR(30),
    type VARCHAR(30),
    taille INTEGER NOT NULL,
    PRIMARY KEY(idNavire)
);




