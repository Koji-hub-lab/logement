CREATE DATABASE IF NOT_EXIST logement;

CREATE TABLE utilisateur(
	id_utilisateur BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nom varchar(100) NOT NULL,
    prenom varchar(100) NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    telephone varchar(20) NULL,
    motdepasse varchar(255) NOT NULL,
    role ENUM('client','bailleur') NOT NULL,
    date_creation date DEFAULT CURRENT_DATE,
    date_modification date DEFAULT CURRENT_DATE
);

CREATE TABLE logement(
    id_logement BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	id_utilisateur BIGINT UNSIGNED,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    titre varchar(100) NOT NULL,
    description text NOT NULL,
    prix int NOT NULL,
    adresse varchar(255) NOT NULL,
    ville varchar(100) NOT NULL,
    nb_chambres int NOT NULL,
    nb_salles_bain int NOT NULL,
    wifi BOOLEAN DEFAULT FALSE,
    parking BOOLEAN DEFAULT FALSE,
    climatisation BOOLEAN DEFAULT FALSE,
    statut ENUM('disponible','louer') DEFAULT 'disponible',
    date_creation date DEFAULT CURRENT_DATE,
    date_modification date DEFAULT CURRENT_DATE
);

CREATE TABLE photo(
	id_photo BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_logement BIGINT UNSIGNED,
    FOREIGN KEY (id_logement) REFERENCES logement(id_logement) ON DELETE CASCADE,
    chemin varchar(255) NOT NULL,
    ordre int DEFAULT 0,
    date_creation date NULL
);

CREATE TABLE reservation(
    id_reservation BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_logement BIGINT UNSIGNED,
    FOREIGN KEY (id_logement) REFERENCES logement(id_logement),
	id_utilisateur BIGINT UNSIGNED,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    statut ENUM('en attente','accepter','refuser') DEFAULT 'en attente',
    message_utilisateur text NULL,
    date_creation date NULL,
    date_modification date NULL
);

CREATE TABLE favoris(
	id_favoris BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_logement BIGINT UNSIGNED,
    FOREIGN KEY (id_logement) REFERENCES logement(id_logement) ON DELETE CASCADE,
    id_utilisateur BIGINT UNSIGNED,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    date_creation date NULL
);

CREATE TABLE message(
	id_message BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_expediteur BIGINT UNSIGNED,
    FOREIGN KEY (id_expediteur) REFERENCES utilisateur(id_utilisateur),
    id_destinataire BIGINT UNSIGNED,
    FOREIGN KEY (id_destinataire) REFERENCES utilisateur(id_utilisateur),
    id_logement BIGINT UNSIGNED,
    FOREIGN KEY (id_logement) REFERENCES logement(id_logement),
    contenu text NOT NULL,
    lu BOOLEAN DEFAULT FALSE,
    date_creation date NULL
);
