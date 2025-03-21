DROP DATABASE IF EXISTS triggers_security_ilia;
CREATE DATABASE triggers_security_ilia;
USE triggers_security_ilia;

CREATE TABLE departaments (
    departament VARCHAR(50) PRIMARY KEY,
    ciutat VARCHAR(50),
    edifici VARCHAR(50)
);

CREATE TABLE empleats (
    codi_emp INT PRIMARY KEY,
    nom VARCHAR(50),
    departament VARCHAR(50),
    sou DECIMAL(10,2),
    codi_proj INT,
    FOREIGN KEY (departament) REFERENCES departaments(departament)
);

INSERT INTO departaments (departament, ciutat, edifici) VALUES ('COMPTABILITAT', 'Barcelona', 'A1');
INSERT INTO empleats (codi_emp, nom, departament, sou, codi_proj) VALUES (1, 'Joan', 'COMPTABILITAT', 25000, 101);

INSERT INTO empleats (codi_emp, nom, departament, sou, codi_proj) VALUES (2, 'Adri', 'COMPTABILITAT', 15000, 101); -- Error
INSERT INTO empleats (codi_emp, nom, departament, sou, codi_proj) VALUES (3, 'Pau', 'COMPTABILITAT', 25000, 101); -- Ok
INSERT INTO empleats (codi_emp, nom, departament, sou, codi_proj) VALUES (4, 'Lluis', 'COMPTABILITAT', 25000, 101);

-- 1
CREATE TRIGGER trg_salari_minim
    BEFORE INSERT ON empleats
    FOR EACH ROW
BEGIN
    IF NEW.departament = 'COMPTABILITAT' AND NEW.sou < 20000 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El sou és inferior al límit mínim per al departament de COMPTABILITAT';
    END IF;
END;

-- 2
CREATE TRIGGER trg_borrar_empleat
    AFTER INSERT ON empleats
    FOR EACH ROW
BEGIN
    IF NEW.codi_proj IS NULL THEN
        DELETE FROM empleats WHERE codi_emp = NEW.codi_emp;
    END IF;
END;

-- 3
CREATE TRIGGER trg_no_eliminar_departament
    BEFORE DELETE ON departaments
    FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM empleats WHERE departament = OLD.departament) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No es pot eliminar el departament perquè té empleats associats';
    END IF;
END;

-- 4
CREATE TABLE audit_empleats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codi_emp INT,
    old_sou DECIMAL(10,2),
    new_sou DECIMAL(10,2),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER trg_audit_actualitzacio_sou
    AFTER UPDATE ON empleats
    FOR EACH ROW
BEGIN
    IF NEW.sou <> OLD.sou THEN
        INSERT INTO audit_empleats (codi_emp, old_sou, new_sou)
        VALUES (OLD.codi_emp, OLD.sou, NEW.sou);
    END IF;
END;

-- 5
CREATE TRIGGER trg_ciutat_majuscules
    BEFORE INSERT ON departaments
    FOR EACH ROW
BEGIN
    SET NEW.ciutat = UPPER(NEW.ciutat);
END;

-- 6
CREATE TRIGGER trg_edifici_no_modificable
    BEFORE UPDATE ON departaments
    FOR EACH ROW
BEGIN
    IF NEW.edifici <> OLD.edifici THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No es pot modificar el camp edifici';
    END IF;
END;

-- PARTE DE SEGURIDAD

-- EXPORTAR DATOS A CSV
SELECT * FROM empleats INTO OUTFILE './empleats.csv'
    FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

-- IMPORTAR DATOS DESDE CSV
LOAD DATA INFILE './empleats.csv' INTO TABLE empleats
    FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';


