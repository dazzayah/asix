USE ILIA_PT0;

-- 1. Mostrar el nom dels departaments ubicats a la mateixa ciutat que el departament d’INFORMÀTICA
SELECT nom_dept, ciutat
FROM departaments
WHERE ciutat = (SELECT ciutat
                FROM departaments
                WHERE nom_dept = 'INFORMATICA');

-- 2. Obtenir el codi i el nom dels empleats que guanyen més diners que l’empleat ‘5’
SELECT codi_emp, nom_emp
FROM empleats
WHERE sou > (SELECT sou
             FROM empleats
             WHERE codi_emp = 5);

-- 3. Obtenir els companys de departament de l’empleat ‘5’
SELECT codi_emp, nom_emp
FROM empleats
WHERE codi_dept = (SELECT codi_dept
                   FROM empleats
                   WHERE codi_emp = 5);

-- 4. Obtenir el codi i el nom de tots els empleats assignats al projecte 'Daisy'
SELECT codi_emp, nom_emp
FROM empleats
WHERE codi_proj = (SELECT codi_proj
                   FROM projectes
                   WHERE nom_proj = 'Daisy');

-- 5. Mostrar quants empleats tenen assignat el projecte 'Daisy'
SELECT COUNT(*)
FROM empleats
WHERE codi_proj = (SELECT codi_proj
                   FROM projectes
                   WHERE nom_proj = 'Daisy');

-- 6. Mostrar els departaments que tenen assignat un empleat en el projecte ‘CLAM’
SELECT codi_dept, nom_dept
FROM departaments
WHERE codi_dept IN (SELECT codi_dept
                    FROM empleats
                    WHERE codi_proj = (SELECT codi_proj
                                       FROM projectes
                                       WHERE nom_proj = 'CLAM'));

-- 7. Mostrar el codi i el nom dels empleats que treballen en el departament de 'COMPTABILITAT' o d’ 'ADMINISTRACIO'
SELECT codi_emp, nom_emp
FROM empleats
WHERE codi_dept = (SELECT codi_dept
                   FROM departaments
                   WHERE nom_dept = 'COMPTABILITAT')
   OR codi_dept = (SELECT codi_dept
                   FROM departaments
                   WHERE nom_dept = 'ADMINISTRACIO');

-- 8. Mostrar quants empleats que treballen a ‘Madrid’ o a ‘Barcelona’ tenen un sou més gran que la mitjana de sous del departament de ‘RECURSOS HUMANS’
SELECT COUNT(*) AS Empleats
FROM empleats
WHERE codi_dept IN (SELECT codi_dept
                    FROM departaments
                    WHERE ciutat = 'Madrid')
   OR codi_dept IN (SELECT codi_dept
                    FROM departaments
                    WHERE ciutat = 'Barcelona')
    AND sou > (SELECT AVG(sou)
               FROM empleats
               WHERE codi_dept = (SELECT codi_dept
                                  FROM departaments
                                  WHERE nom_dept = 'RECURSOS HUMANS'));

-- 9. Consultar els empleats que treballen en un projecte amb un pressupost més gran que 70.000
SELECT codi_emp, nom_emp
FROM empleats
WHERE codi_proj IN (SELECT codi_proj
                    FROM projectes
                    WHERE pressupost > 70000) ORDER BY codi_emp;

-- 10. Obtenir el nom dels empleats que tenen assignat un projecte amb el pressupost més petit
SELECT nom_emp
FROM empleats
WHERE codi_proj IN (SELECT codi_proj
                    FROM projectes
                    WHERE pressupost = (SELECT min(pressupost)
                                        FROM projectes));
