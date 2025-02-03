CREATE DATABASE PT1_EMPLEATS;
USE PT1_EMPLEATS;

CREATE TABLE empleats
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nom        VARCHAR(100) NOT NULL,
    cognom     VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    data_inici DATE         NOT NULL
);

INSERT INTO empleats (nom, cognom, email, data_inici)
VALUES ('Joan', 'Perez', 'joan.perez@example.com', '2023-01-15')
        ,
       ('Maria', 'Lopez', 'maria.lopez@example.com', '2022-12-01')
        ,
       ('Carlos', 'Garcia', 'carlos.garcia@example.com', '2023-03-10')
        ,
       ('Ana', 'Martinez', 'ana.martinez@example.com', '2022-11-20')
        ,
       ('Luis', 'Fernandez', 'luis.fernandez@example.com', '2023-05-05');
