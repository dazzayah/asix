CREATE DATABASE ILIA_PT0;
USE ILIA_PT0;
SELECT * FROM departaments;

SELECT ciutat, COUNT(*) AS n_departamentos
FROM departaments
GROUP BY ciutat;

-- 42. Agrupar els empleats per projecte i sumar el sou de cada un dels subgrups creats:
SELECT codi_proj, COUNT(*) AS empleados, SUM(sou) AS sueldo_total
FROM empleats
GROUP BY codi_proj;

-- 43. Fer que en la consulta anterior no surti el grup d'empleats sense projecte assignat:
SELECT codi_proj, COUNT(*) AS empleados, SUM(sou) AS sueldo_total
FROM empleats
WHERE codi_proj IS NOT NULL
GROUP BY codi_proj;

-- 44. Mostrar la mitjana de sous per departament:
SELECT codi_proj, COUNT(*) AS empleados, AVG(sou) AS media_sueldo
FROM empleats
GROUP BY codi_proj;

-- 45. Mostrar la mitjana de sous per departament, només per departaments amb més de 2 empleats:
SELECT codi_proj, COUNT(*) AS empleados, AVG(sou) AS media_sueldo
FROM empleats
GROUP BY codi_proj
HAVING COUNT(*) > 2;

-- 46. Visualitzar quants empleats tenen el mateix sou:
SELECT sou, COUNT(*) AS empleats
FROM empleats
GROUP BY sou;

-- 47. Visualitzar quants empleats tenen el mateix sou, només sous amb més de 2 empleats:
SELECT sou, COUNT(*) AS empleats
FROM empleats
GROUP BY sou
HAVING COUNT(*) > 2;

-- 48. Per cada ciutat, visualitzar la planta més alta on està ubicat un departament:
SELECT ciutat, MAX(planta) AS planta_mas_alta
FROM departaments
GROUP BY ciutat;

-- 49. Mitjana per departament dels sous dels empleats que no tenen assignat el projecte 3:
SELECT departaments.nom_dept, AVG(empleats.sou) AS media_salario
FROM departaments
JOIN empleats ON departaments.codi_dept = empleats.codi_dept
WHERE empleats.codi_proj != 3
GROUP BY departaments.nom_dept;

-- 50. Mitjana de sous dels empleats per departament excloent aquells on el sou mínim és inferior a 18000:
SELECT departaments.nom_dept, AVG(empleats.sou) AS media_salario
FROM departaments
         JOIN empleats ON departaments.codi_dept = empleats.codi_dept
WHERE empleats.sou > 18000
GROUP BY departaments.nom_dept;

-- 51. Agrupar els departaments per ciutat i edifici mostrant el nom de la ciutat, l'edifici i quants departaments conté:
SELECT ciutat, edifici, COUNT(*) AS num_departaments
FROM departaments
GROUP BY ciutat, edifici;

-- 52. Elimina de la consulta anterior aquells grups on el número d'elements sigui inferior a 1:
SELECT ciutat, edifici, COUNT(*) AS num_departaments
FROM departaments
GROUP BY ciutat, edifici
HAVING COUNT(*) > 1;

-- 53. Mostrar el nom i quants empleats hi ha que es diguin igual:
SELECT nom_emp, COUNT(*) AS num_empleats
FROM empleats
GROUP BY nom_emp
HAVING COUNT(*) > 1;

-- 54. Mostrar quants empleats estan en el mateix departament i treballen junts en el mateix projecte:
SELECT codi_dept, codi_proj, COUNT(*) AS num_empleats
FROM empleats
WHERE codi_dept = codi_proj
GROUP BY codi_dept, codi_proj;

-- 55. Obtenir els departaments on la mitjana del sou dels empleats és d’almenys 1000 euros:
SELECT empleats.codi_dept
FROM empleats
GROUP BY codi_dept
HAVING AVG(empleats.sou) >= 1000;

-- 56. Obtenir el màxim sou pagat en cada un dels departaments:
SELECT empleats.codi_dept, MAX(empleats.sou) AS max_sou
FROM empleats
GROUP BY codi_dept;

-- 57. Extreure del resultat anterior aquells departaments que no tinguin més de 2 treballadors:
SELECT empleats.codi_dept, MAX(empleats.sou) AS max_sou
FROM empleats
GROUP BY codi_dept
HAVING COUNT(*) > 2;

-- 1. Obtenir el nom dels empleats i la ciutat en la que treballen:
SELECT empleats.nom_emp, departaments.ciutat
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept;

-- 2. Mostrar el nom dels empleats i el nom i el pressupost del projecte que tenen assignat:
SELECT empleats.nom_emp, projectes.nom_proj, projectes.pressupost
FROM empleats
INNER JOIN projectes ON empleats.codi_proj = projectes.codi_proj;

-- 3. Obtenir el codi i el nom dels empleats que treballen al departament de 'COMPTABILITAT':
SELECT empleats.codi_emp, empleats.nom_emp
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
WHERE departaments.nom_dept = 'COMPTABILITAT';

-- 4. Obtenir el codi i el nom dels empleats que treballen a la ciutat de ‘Barcelona’:
SELECT empleats.codi_emp, empleats.nom_emp
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
WHERE departaments.ciutat = 'Barcelona';

-- 5. Obtenir el codi i el nom dels empleats que tenen assignat un projecte amb un pressupost superior a 200.000 euros:
SELECT empleats.codi_emp, empleats.nom_emp
FROM empleats
INNER JOIN projectes ON empleats.codi_proj = projectes.codi_proj
WHERE projectes.pressupost > 200000;

-- 6. Obtenir el nom dels empleats que tenen assignat el projecte ‘CLAM’:
SELECT empleats.nom_emp
FROM empleats
INNER JOIN projectes ON empleats.codi_proj = projectes.codi_proj
WHERE projectes.nom_proj = 'CLAM';

-- 7. Obtenir el nom dels diferents departaments dels empleats assignats al projecte ‘CLAM’:
SELECT DISTINCT departaments.nom_dept
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
INNER JOIN projectes ON empleats.codi_proj = projectes.codi_proj
WHERE projectes.nom_proj = 'CLAM';

-- 8. Mostrar el nom de les ciutats i el número d’empleats que treballen en cada ciutat:
SELECT departaments.ciutat, COUNT(empleats.nom_emp) AS num_empleats
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
GROUP BY departaments.ciutat;

-- 9. Obtenir els noms dels departaments on hi ha empleats que cobrin més de 1000 euros:
SELECT DISTINCT departaments.nom_dept
FROM departaments
INNER JOIN empleats ON departaments.codi_dept = empleats.codi_dept
WHERE empleats.sou > 1000;

-- 10. Obtenir els noms dels departaments on hi ha un empleat que es digui ‘Josep’:
SELECT DISTINCT departaments.nom_dept
FROM departaments
INNER JOIN empleats ON departaments.codi_dept = empleats.codi_dept
WHERE empleats.nom_emp = 'Josep';

-- 11. Obtenir els noms dels departaments on la mitjana del sou dels empleats és almenys 1000 euros:
SELECT departaments.nom_dept
FROM departaments
INNER JOIN empleats ON departaments.codi_dept = empleats.codi_dept
GROUP BY departaments.nom_dept
HAVING AVG(empleats.sou) >= 1000;

-- 12. Obtenir el codi i el nom dels projectes que tenen assignats 2 o més empleats:
SELECT projectes.codi_proj, projectes.nom_proj
FROM projectes
INNER JOIN empleats ON projectes.codi_proj = empleats.codi_proj
GROUP BY projectes.codi_proj, projectes.nom_proj
HAVING COUNT(empleats.codi_emp) >= 2;

-- 13. Obtenir la mitjana dels sous dels empleats de cada una de les ciutats:
SELECT departaments.ciutat, AVG(empleats.sou) AS mitjana_sou
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
GROUP BY departaments.ciutat;

-- 14. Obtenir el nom dels empleats que treballen als departaments de ‘VENDES’, ‘MARKETING’ o ‘COMPTABILITAT’:
SELECT empleats.nom_emp
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
WHERE departaments.nom_dept IN ('VENDES', 'MARKETING', 'COMPTABILITAT');

-- 15. Comptar quants empleats treballen als departaments de ‘VENDES’, ‘MARKETING’ o ‘COMPTABILITAT’:
SELECT COUNT(empleats.codi_emp) AS num_empleats
FROM empleats
INNER JOIN departaments ON empleats.codi_dept = departaments.codi_dept
WHERE departaments.nom_dept IN ('VENDES', 'MARKETING', 'COMPTABILITAT');

-- CON LEFT JOIN

-- Llista de tots els departaments i els seus empleats, incloent departaments sense empleats.
SELECT departaments.nom_dept, empleats.nom_emp
FROM departaments
LEFT JOIN empleats ON departaments.codi_dept = empleats.codi_dept;

-- Llista de tots els empleats i els seus projectes, incloent empleats sense projecte assignat.
SELECT empleats.nom_emp, projectes.nom_proj
FROM empleats
LEFT JOIN projectes ON empleats.codi_proj = projectes.codi_proj;

-- Llista de tots els projectes amb els seus empleats assignats, incloent projectes sense empleats.
SELECT projectes.nom_proj, empleats.nom_emp
FROM projectes
LEFT JOIN empleats ON projectes.codi_proj = empleats.codi_proj;

-- Llista de tots els departaments amb el nom de l'edifici i els empleats associats, incloent departaments sense empleats.
SELECT departaments.nom_dept, departaments.edifici, empleats.nom_emp
FROM departaments
LEFT JOIN empleats ON departaments.codi_dept = empleats.codi_dept;

-- Llista de tots els departaments i el sou mitjà dels seus empleats, incloent departaments sense empleats.
SELECT departaments.nom_dept, AVG(empleats.sou) AS sou_mitja
FROM departaments
LEFT JOIN empleats ON departaments.codi_dept = empleats.codi_dept
GROUP BY departaments.nom_dept;

-- CON RIGHT JOIN

-- Llista de tots els empleats i els seus departaments, incloent empleats sense departament.
SELECT empleats.nom_emp, departaments.nom_dept
FROM departaments
RIGHT JOIN empleats ON departaments.codi_dept = empleats.codi_dept;

-- Llista de tots els projectes amb els seus empleats assignats, incloent empleats sense projecte.
SELECT empleats.nom_emp, projectes.nom_proj
FROM projectes
RIGHT JOIN empleats ON projectes.codi_proj = empleats.codi_proj;

-- Llista de tots els empleats amb el nom del seu departament i la seva ciutat, incloent empleats sense departament.
SELECT empleats.nom_emp, departaments.nom_dept, departaments.ciutat
FROM departaments
RIGHT JOIN empleats ON departaments.codi_dept = empleats.codi_dept;

-- Llista de tots els projectes amb el seu empleat i el pressupost del projecte, incloent empleats sense projecte.
SELECT empleats.nom_emp, projectes.nom_proj, projectes.pressupost
FROM projectes
RIGHT JOIN empleats ON projectes.codi_proj = empleats.codi_proj;

-- Llista de tots els empleats amb el seu departament i l'edifici on treballen, incloent empleats sense departament.
SELECT empleats.nom_emp, departaments.nom_dept, departaments.edifici
FROM departaments
RIGHT JOIN empleats ON departaments.codi_dept = empleats.codi_dept;
