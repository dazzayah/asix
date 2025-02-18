-- Crear taula usuaris
DROP DATABASE IF EXISTS ILIA_PHP;
CREATE DATABASE ILIA_PHP;
USE ILIA_PHP;

CREATE TABLE IF NOT EXISTS usuaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    cognoms VARCHAR(100) NOT NULL,
    nom_usuari VARCHAR(50) NOT NULL UNIQUE,
    correu VARCHAR(100) NOT NULL UNIQUE,
    data_naixement DATE NOT NULL
);

-- Crear taula rols
CREATE TABLE IF NOT EXISTS rols (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

-- Crear taula adreces
CREATE TABLE IF NOT EXISTS adreces (
    id INT PRIMARY KEY,
    carrer VARCHAR(100) NOT NULL,
    ciutat VARCHAR(50) NOT NULL,
    codi_postal VARCHAR(10) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    FOREIGN KEY (id) REFERENCES usuaris(id)
);

-- Crear taula logs
CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuari_id INT NOT NULL,
    camp_modificat VARCHAR(100) NOT NULL,
    valor_antic TEXT,
    valor_nou TEXT,
    data_modificacio DATETIME NOT NULL,
    ip VARCHAR(45) NOT NULL,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id)
);
