<?php
require_once 'includes/db_queries.inc.php';

$id = $_GET['id'];
$user = fetchUserData($id);
$address = fetchAddressData($id);

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

    editUser($id, $name, $surname, $username, $email, $birth, $street, $city, $postal_code, $country);
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuari</title>
    <link rel="stylesheet" href="includes/estils.css">
</head>
<body>

<h2>Editar Usuari</h2>
<form method="POST">
    <div>
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['nom']); ?>"/> &nbsp;
    </div>
    <div>
        <label for="surname">Apellido</label>
        <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user['cognoms']); ?>" /> &nbsp;
    </div>
    <div>
        <label for="username">Nombre de usuario</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['nom_usuari']); ?>" /> &nbsp;
    </div>
    <div>
        <label for="email">Correo electrónico</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['correu']); ?>" /> &nbsp;
    </div>
    <div>
        <label for="birth">Fecha de inicio</label>
        <input type="date" id="birth" name="birth" value="<?php echo htmlspecialchars($user['data_naixement']); ?>"/> &nbsp;
    </div>
    <div>
        <label for="street">Calle</label>
        <input type="text" id="street" name="street" value="<?php echo htmlspecialchars($address['carrer']); ?>"/> &nbsp;
    </div>
    <div>
        <label for="city">Ciudad</label>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($address['ciutat']); ?>"/> &nbsp;
    </div>
    <div>
        <label for="postal_code">Código Postal</label>
        <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($address['codi_postal']); ?>"/> &nbsp;
    </div>
    <div>
        <label for="country">País</label>
        <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($address['pais']); ?>"/> &nbsp;
    </div>
    <div>
        <input type="submit" value="Guardar"/>
    </div>
</form>

</body>
</html>
