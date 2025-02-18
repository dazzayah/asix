-- Afegir rols inicials
INSERT INTO rols (nom) VALUES
('Administrador'),
('Usuari'),
('Moderador');

-- Afegir usuaris inicials
INSERT INTO usuaris (nom, cognoms, nom_usuari, correu, data_naixement) VALUES
('Joan', 'Pérez', 'joanperez', 'joan.perez@example.com', '1990-05-15'),
('Maria', 'García', 'mariagarcia', 'maria.garcia@example.com', '1985-08-22'),
('Lluís', 'Rodríguez', 'lluisrodriguez', 'lluis.rodriguez@example.com', '1992-12-30');

-- Afegir adreces associades als usuaris
INSERT INTO adreces (id, carrer, ciutat, codi_postal, pais) VALUES
(1, 'Carrer de la Pau, 15', 'Barcelona', '08001', 'Catalunya'),
(2, 'Avinguda Diagonal, 30', 'Barcelona', '08007', 'Catalunya'),
(3, 'Carrer Gran de Gràcia, 75', 'Barcelona', '08006', 'Catalunya');
