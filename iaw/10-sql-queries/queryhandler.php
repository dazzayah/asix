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

    // Método -> query, más simple. No evita SQL Injection, pero para consultas muy simples nos sirve.
    $query = 'SELECT * FROM equips;';
    $stmt = $pdo->query($query); // + óptimo - seguro

    echo '<h4> Todos los equipos: </h4>';
    while ($row = $stmt->fetch()) {
      echo 'Equipo ' . $row['id'] . ': ';
      echo $row['nom'] . ' | Número de Socios: ' . $row['num_socis'] . '<br>';
    }

    // Método prepare y execute, permite el uso de placeholders y dificulta el SQL injection. 
    /* $query = "SELECT * FROM equips";

     $stmt = $pdo -> prepare($query); // - óptimo + seguro
     $stmt -> execute();

            Acerca los métodos prepare() execute(), he logrado encontrar dos formas
            de introducir datos: mediante parametros posicionales o nombrados.

            Los posicionales utilizan como placeholders interrogantes: (?)
            Mientras que los nombrados requieren del método $pdo -> bindParam(":placeholder", $dato)
            o directamente relacionandolos dentro de execute().

     while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { 

            El método estático FETCH_ASSOC, quita el índice numérico del array devuelto.
            Por defecto, opera con el método FETCH_BOTH, lo que devuelve un array indexado 
            numerica y asociativamente. Con tal de evitar una sintaxis demasiado compleja, 
            trataré de no utilizar esta clase de métodos a menos que sea necesario.

     echo $row['nom'];
     } */

    // Ejercicio 3: Consultar los jugadores nacidos a partir del año 2000
    // Declaración con prepare(): parámetros posicionales

    $query = 'SELECT * FROM jugadors WHERE any_naixement >= ?;';
    $any_naixement = 2000;

    $stmt = $pdo->prepare($query);
    $stmt->execute([$any_naixement]); // <-- O podriamos introducir los datos directamente ([2000])

    echo '<h4> Los jugadores más jovenes: </h4>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo 'Nombre: ' . $row['nom'] . '<br>';
      echo 'Nacimiento: ' . $row['any_naixement'] . '<br>';
    }

    // Ejercicio 4: Almacenar en un array los clubs con más de 100.000 socios 
    // Declaración con prepare(): parámetros nombrados

    $query = 'SELECT * FROM equips WHERE num_socis > :num_socis;';

    echo '<h4> Clubes con más de 100.000 socios </h4>';

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':num_socis', 100000); // <-- bindValue() permite valores literales, mientras que su alternativa bindParam() no.
    $stmt->execute(); // <-- Mientras que execute() si permite pasar valores literales

    $equips = $stmt->fetchAll(); // <-- Extrae todas las filas en un unico array.
    foreach ($equips as $equip) {
      echo 'Nombre: ' . $equip['nom'] . ', Ciudad: ' . $equip['ciutat'] . ', Socios: ' . $equip['num_socis'];
    }

    // Ejercicio 5: Consultar los jugadores y equipos relacionados

    // Asignamos un alias dado que ambas columnas se llaman 'nom'
    $query = 'SELECT jugadors.nom AS jugador, equips.nom as equip FROM jugadors JOIN equips ON jugadors.equip_id = equips.id;'; 

    $stmt = $pdo->query($query);
    echo '<h4> Jugadores y equipos relacionados </h4>';

    while ($row = $stmt->fetch()) {
      echo 'Jugador: ' . $row['jugador'] . ' - Equipo: ' . $row['equip'] . '<br>';
    }

    // Ejercicio 6: Insertar un club nuevo
    echo '<h4> Añadir un nuevo equipo a la base de datos </h4>';

    $equipo_nuevo = 'Sevilla FC';
    $ciudad = 'Sevilla';
    $num_socios = 30000;

    $query = 'INSERT INTO equips (nom, ciutat, num_socis) VALUES (?, ?, ?);'; // Aquí utilizamos placeholders posicionales

    $stmt = $pdo -> prepare($query);
    $stmt -> execute([$equipo_nuevo, $ciudad, $num_socios]); 

    $stmt = $pdo -> query('SELECT * FROM equips WHERE nom = "Sevilla FC";');
    while ($row = $stmt -> fetch()) {
      echo 'Equipo: ' . $row['nom'] . ' - Ciudad: ' . $row['ciutat'] . ' - Socios: ' . $row['num_socis'] . '<br>';
    }

    // He añadido otro equipo para mostrar el funcionamiento, pero esta vez utilizando bindParam() y placeholders nombrados.

    $equipo_nuevo = 'Celta de Vigo';
    $ciudad = 'Vigo';
    $num_socios = 50000;

    $query = 'INSERT INTO equips (nom, ciutat, num_socis) VALUES (:equipo_nuevo, :ciudad, :num_socios);'; // 

    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(':equipo_nuevo', $equipo_nuevo); // <-- bindParam() no permite valores literales, 
    $stmt -> bindParam(':ciudad', $ciudad);             // por lo que hay que pasarle una variable.
    $stmt -> bindParam(':num_socios', $num_socios);

    $stmt -> execute();

    $stmt = $pdo -> query('SELECT * FROM equips WHERE nom = "Celta de Vigo";');
    while ($row = $stmt -> fetch()) {
      echo 'Equipo: ' . $row['nom'] . ' - Ciudad: ' . $row['ciutat'] . ' - Socios: ' . $row['num_socis'] . '<br>';
    }

    // Ejercicio 7: Actualizar los datos de un equipo

    $equipo = 'Real Madrid'; // Equipo a actualizar
    $num_socios = 30000;
    
    $query = 'UPDATE equips SET num_socis = ? WHERE nom = ?;'; // Para actualizar un dato, utilizamos UPDATE.

    $stmt = $pdo -> prepare($query);
    $stmt -> execute([$num_socios, $equipo]);

    echo '<h4> Actualizar los datos de un equipo </h4>';
    $stmt = $pdo -> query('SELECT * FROM equips WHERE nom = "Real Madrid";');
    while ($row = $stmt -> fetch()) {
      echo 'Equipo: ' . $row['nom'] . ' - Ciudad: ' . $row['ciutat'] . ' - Socios: ' . $row['num_socis'] . '<br>';
    }

    // Ejercicio 8: Eliminar un equipo
    $equipo = 'Atlético de Madrid'; // Equipo a eliminar
    
    $query = 'DELETE FROM equips WHERE nom = ?;'; // Y para eliminar un dato, utilizamos DELETE.

    $stmt = $pdo -> prepare($query);
    $stmt -> execute([$equipo]);

    echo '<h4> Eliminar un equipo </h4>';
    $stmt = $pdo -> query('SELECT * FROM equips WHERE nom = "Atlético de Madrid";');
    
    if (empty($stmt -> fetchAll())) { // Y podemos implementar un condicional que verifique si el array está vacío.
      echo "No existe ninguna fila con el nombre de equipo: " . $equipo; 
    } else {
      echo 'Equipo: ' . $row['nom'] . ' - Ciudad: ' . $row['ciutat'] . ' - Socios: ' . $row['num_socis'] . '<br>';
    }

    // He leíedo que considera buena práctica cerrar las conexiones y liberar las variables al terminar.

    $pdo = null; // Cerramos la conexión con la base de datos.
    $stmt = null; // Liberamos la variable de la consulta.

  } 

  // En caso de que capturemos una excepción, se manda el error y el script se detiene.
  // 
  catch (PDOException $e) {
    exit("Fallo en las consultas: " . $e->getMessage()); 
  } ?>

</body>
</html>