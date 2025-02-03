DROP DATABASE IF EXISTS ILIA_PT0;
CREATE DATABASE ILIA_PT0;
USE ILIA_PT0;

CREATE TABLE departaments (
    codi_dept INT(5) NOT NULL,
    nom_dept VARCHAR(18) NOT NULL,
    planta INT(5),
    edifici VARCHAR(20),
    ciutat VARCHAR(15),
    PRIMARY KEY (codi_dept)
);

CREATE TABLE projectes (
    codi_proj INT(5) NOT NULL,
    nom_proj VARCHAR(25) NOT NULL,
    pressupost DECIMAL(10,2),
    PRIMARY KEY (codi_proj)
);

CREATE TABLE empleats (
    codi_emp INT(5) NOT NULL,
    nom_emp VARCHAR(15) NOT NULL,
    sou DECIMAL(10,2),
    codi_dept INT(5),
    codi_proj INT(5),
    PRIMARY KEY (codi_emp),
    FOREIGN KEY (codi_dept) REFERENCES departaments(codi_dept),
    FOREIGN KEY (codi_proj) REFERENCES projectes(codi_proj)
);

INSERT INTO departaments (codi_dept, nom_dept, planta, edifici, ciutat)
VALUES 
(1, 'COMPTABILITAT', 2, 'La Castellana', 'MADRID'),
(2, 'ADMINISTRACIO', 3, 'Torres Mafre', 'BARCELONA'),
(3, 'RECURSOS HUMANS', 1, 'Diagonal Mar', 'BARCELONA'),
(4, 'DIRECCIO GENERAL', 10, 'La Castellana', 'MADRID'),
(5, 'MARKETING', 8, 'Diagonal Mar', 'BARCELONA'),
(6, 'VENDES', 3, 'Torres Mafre', 'BARCELONA'),
(7, 'VENDES', 5, 'La Castellana', 'MADRID'),
(8, 'INFORMATICA', -1, 'Estacio Comunicacio', 'BARCELONA');

INSERT INTO projectes (codi_proj, nom_proj, pressupost)
VALUES 
(1, 'Daisy', 240000),
(2, 'CLAM', 63000),
(3, 'Vocal Processor', 600000);

INSERT INTO empleats (codi_emp, nom_emp, sou, codi_dept, codi_proj)
VALUES 
(1, 'Maria', 21000, 1, 1),
(2, 'Josep', 18000, 1, 1),
(3, 'Ramon', 48000, 4, 2),
(4, 'Marta', 48000, 5, 3),
(5, 'Miquel', 27000, 6, 2),
(6, 'Josep', 24000, 7, NULL),
(7, 'Laura', 60000, 4, 2),
(8, 'Toni', 15000, NULL, NULL),
(9, 'Josep', 18000, 3, NULL),
(10, 'Eugenia', 30000, 8, 1),
(11, 'Esteve', 33000, 8, 1),
(12, 'Robert', 16000, 8, 2),
(13, 'Manel', 18000, 8, 2),
(14, 'Ester', 19000, 8, 3);

-- 1 al 3
SELECT * FROM empleats;
SELECT * FROM departaments;
SELECT * FROM projectes;

-- 4
SELECT codi_dept FROM empleats;

-- 5
SELECT nom_emp FROM empleats
WHERE sou > 800
ORDER BY nom_emp DESC;

-- 6
SELECT nom_emp, codi_emp FROM empleats
WHERE codi_dept = 8;

-- 7 
SELECT nom_emp, codi_emp FROM empleats
WHERE codi_dept = 8 AND codi_proj = 2;

-- 8
SELECT nom_emp, sou FROM empleats
WHERE codi_dept = 1 OR codi_dept = 2;

-- 9
SELECT nom_emp, sou FROM empleats
WHERE codi_dept = 1 OR codi_dept = 2 OR codi_dept = 4 OR codi_dept = 5;

-- 10
SELECT nom_emp, codi_emp FROM empleats
WHERE sou BETWEEN 30000 AND 50000;

-- 11
SELECT nom_emp, codi_emp FROM empleats
WHERE codi_dept = 5 AND sou > 40000;

-- 12
SELECT nom_emp FROM empleats
WHERE sou > 40000
ORDER BY nom_emp DESC;

-- 13
SELECT * FROM empleats
WHERE nom_emp LIKE 'M%'
ORDER BY nom_emp;

-- 14
SELECT nom_emp, codi_emp FROM empleats
WHERE codi_dept IS NULL;

-- 15
SELECT nom_emp, codi_emp FROM empleats
WHERE codi_proj IS NOT NULL;

-- 16
SELECT nom_proj, codi_proj FROM projectes
WHERE nom_proj LIKE '% %';

-- 17
SELECT nom_dept FROM departaments
WHERE ciutat = 'Barcelona';

-- 18
SELECT nom_dept FROM departaments
WHERE ciutat != 'Madrid';

-- 19

-- INSERT INTO departaments(codi_dept,nom_dept, ciutat)
-- VALUES (9,'VENTAS', 'MALAGA');

SELECT ciutat
FROM departaments                 -- ( No tengo muy claro lo que se quiere, si que se muestre
GROUP BY ciutat                   -- todas las ciudades con 1 solo departamento... )
HAVING COUNT(codi_dept) = 1;

-- O mostrar las ciudades con uno o más departamentos, cosa
-- que no tiene mucho sentido porque el id no puede ser nulo,
-- pero aquí están los dos

SELECT DISTINCT ciutat
FROM departaments
WHERE codi_dept IS NOT NULL;

SELECT COUNT(codi_dept), ciutat FROM departaments
GROUP BY ciutat;


-- 20
SELECT nom_dept
FROM departaments
WHERE edifici = 'Torres Mafre'
  AND ciutat = 'BARCELONA';

-- 21
SELECT codi_emp, sou
FROM empleats;

-- 22
SELECT nom_emp
FROM empleats
WHERE codi_proj = 1;

-- 23
SELECT *
FROM departaments
WHERE planta > 5;

-- 24
SELECT nom_emp
FROM empleats
WHERE sou < 20000;

-- 25
SELECT codi_proj, nom_proj
FROM projectes
WHERE pressupost >= 250000;

-- 26
SELECT nom_dept
FROM departaments
WHERE edifici = 'La Castellana';


-- 27
SELECT COUNT(*)
FROM empleats;

-- 28
SELECT COUNT(*)
FROM empleats
WHERE sou > 40000;

-- 29
SELECT COUNT(*)
FROM departaments
WHERE ciutat = 'BARCELONA';

-- 30
SELECT COUNT(*)
FROM departaments
WHERE ciutat = 'BARCELONA'
  AND edifici != 'Torres Mafre';

-- 31
SELECT COUNT(*)
FROM empleats
WHERE codi_proj IS NULL;

-- 32
SELECT COUNT(*)
FROM empleats
WHERE nom_emp = 'Josep';

-- 33
SELECT AVG(sou)
FROM empleats;

-- 34
SELECT SUM(sou)
FROM empleats
WHERE codi_dept = 1;

-- 35
SELECT SUM(sou)
FROM empleats
WHERE codi_dept IN (1, 2, 5);

-- 36
SELECT SUM(pressupost)
FROM projectes;

-- 37
SELECT MAX(sou)
FROM empleats;

-- 38
SELECT MIN(sou)
FROM empleats;

-- 39
SELECT MIN(sou)
FROM empleats
WHERE codi_dept = 8;

-- 40
SELECT COUNT(*)
FROM empleats
WHERE codi_proj = 3;

-- 41
SELECT COUNT(DISTINCT codi_proj)
FROM empleats
WHERE codi_proj IS NOT NULL;
