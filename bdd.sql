-- Database: tripcomment

-- DROP DATABASE IF EXISTS tripcomment;

CREATE DATABASE tripcomment
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Chinese (Simplified)_China.1252'
    LC_CTYPE = 'Chinese (Simplified)_China.1252'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;


CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,          -- Identifiant unique pour chaque utilisateur
    nom VARCHAR(50) NOT NULL, -- Nom d'utilisateur unique
	prenom VARCHAR(50) NOT NULL,
	tel VARCHAR(15),
    email VARCHAR(100) UNIQUE NOT NULL,   -- Email unique
    mdp VARCHAR(255) NOT NULL, -- Mot de passe crypté
    user_role VARCHAR(20) DEFAULT 'user', -- Rôle de l'utilisateur, par défaut 'user'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Date de création du compte
);

Select * From users
DELETE FROM users WHERE nom = 'HO';
CREATE TABLE commentaires (
    commentaires_id SERIAL PRIMARY KEY,
    users_id INT NOT NULL,
    titre VARCHAR(191) NOT NULL, 
    image TEXT NOT NULL, 
    description TEXT NOT NULL,
	date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (users_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE villes (
    villes_id SERIAL PRIMARY KEY,
    nom VARCHAR(100) ,
    users_id INT ,
    commentaires_id INT ,
    FOREIGN KEY (users_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (commentaires_id) REFERENCES commentaires(commentaires_id) ON DELETE CASCADE
);

INSERT INTO villes (nom)
VALUES 
('Paris'),
('Rome'),
('Londres');

Select * From commentaires
DELETE FROM commentaires WHERE titre = 'Londre';

SELECT 
    u.nom, 
    u.prenom, 
    c.titre, 
    c.description, 
	c.date,
	c.commentaires_id,
    v.nom AS ville
FROM 
    users u
JOIN 
    commentaires c ON u.user_id = c.users_id
JOIN 
    villes v ON c.commentaires_id = v.commentaires_id
WHERE 
    v.nom = 'Paris'; -- Remplacez 'NomDeLaVille' par le nom de la ville souhaitée



CREATE TABLE blacklist (
    blacklist_id SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Select * From blacklist

