CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE llibres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titol VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    any_publicacio INT(4) NOT NULL,
    genere VARCHAR(100) NOT NULL
);
