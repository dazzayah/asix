<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Futbol</title>
</head>

<body>
    <h1>Implantación de aplicaciones web</h1>
    <h2>Introducción a PHP con conexión a BD</h2>

    <?php
    try {
        // Ejercicio 1: Conexión a la base de datos
        require_once "includes/dbh.php";

        // Ejercicio 2: Consultar todos los equipos

            // Método -> query, más simple. No evita SQL Injection, pero para consultas simples nos sirve.
        $query = "SELECT * FROM equips";
        $stmt = $pdo -> query($query); // + óptimo - seguro

        while ($row = $stmt -> fetch()) {
            var_dump(($row));
            echo $row['nom'];
        }

            // Método prepare y execute, permite el uso de placeholders y dificulta el SQL injection. 
        $query = "SELECT * FROM equips";

        $stmt = $pdo -> prepare($query); // - óptimo + seguro
        $stmt -> execute();

        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { 
            
            /* El método estático FETCH_ASSOC, quita el índice numérico del array devuelto.
            Por defecto, opera con el método FETCH_BOTH, lo que devuelve un array indexado 
            numerica y asociativamente. Con tal de evitar una sintaxis demasiado compleja, 
            trataré de no utilizar esta clase de métodos a menos que sea necesario.
            */

            echo $row['nom'];
        }


        // Ejercicio 3: Consultar los jugadores nacidos a partir del año 2000 
        // Ejercicio 4: Almacenar en un array los clubs con más de 100.000 socios
        // Ejercicio 5: Mostrar todos los jugadores obteniendo también el nombre del equipo
        // Ejercicio 6: Insertar un club nuevo
        // Ejercicio 7: Actualizar los datos de un equipo
        // Ejercicio 8: Eliminar un equipo
    } catch (PDOException $e) {
        die("Fallo en las consultas: " . $e->getMessage());
    }

    ?>

</body>

</html>