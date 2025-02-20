<?php
require_once 'includes/db_queries.inc.php';
require_once 'includes/functions.inc.php';

$users = fetchUsers();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat d'Usuaris</title>
    <link rel="stylesheet" href="includes/estils.css">
</head>
<body>
    <h1>Llistat d'Usuaris</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fecha de Inicio</th>
            <th>Nacimiento</th>
            <th></th> <!-- Dejo el header vacío porque si no en blanco y es feo -->
        </tr>
        <?php foreach ($users as $user) {
            echo userRow($user);} ?>
    </table>
    <a class="boto" href="add.php">Afegir</a>
</body>
</html>
