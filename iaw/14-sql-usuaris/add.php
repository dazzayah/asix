<?php
require 'includes/db_queries.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    addUser($name, $surname, $username, $email, $birth, $street, $city, $postal_code, $country);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir Usuari</title>
    <link rel="stylesheet" href="/includes/estils.css">
</head>
<body>
    <h1>Afegir Usuari</h1>
    <form method="POST">
        <div>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name"/>&nbsp;
        </div>
        <div>
            <label for="surname">Apellido</label>
            <input type="text" id="surname" name="surname"/>&nbsp;
        </div>
        <div>
            <label for="username">Nombre de usuario</label>
            <input type="text" id="username" name="username"/>&nbsp;
        </div>
        <div>
            <label for="email">Correo electrónico</label>
            <input type="text" id="email" name="email"/>&nbsp;
        </div>
        <div>
            <label for="birth">Fecha de nacimiento</label>
            <input type="date" id="birth" name="birth"/>&nbsp;
        </div>

        <!-- Para la tabla "adreces" -->
        <div>
            <label for="street">Calle</label>
            <input type="text" id="street" name="street"/>&nbsp;
        </div>
        <div>
            <label for="city">Ciudad</label>
            <input type="text" id="city" name="city"/>&nbsp;
        </div>
        <div>
            <label for="postal_code">Código Postal</label>
            <input type="text" id="postal_code" name="postal_code"/>&nbsp;
        </div>
        <div>
            <label for="country">País</label>
            <input type="text" id="country" name="country"/>&nbsp;
        </div>

        <div>
            <input type="submit" value="Añadir"/>
        </div>
    </form>
</body>
</html>
