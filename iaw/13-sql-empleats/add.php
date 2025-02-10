<?php
require 'includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $fecha_inicio = $_POST['fecha_inicio'];

    addEmpleado($nombre, $apellido, $email, $fecha_inicio);
    header('Location: index.php');
    exit;
}

?>
<!doctype html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Añadir empleado</title>
    <style>
        .inline-80 {
    display: inline-block;
    width: 80px;
        }
    </style>
</head>

<body>
<div class="container" id="new-entry">
    <h3 style="padding-bottom: 20px">Añadir un empleado</h3>
    <form method="POST">
        <div class="form-group">
            <label for="nombre" class="inline-80">Nombre</label> &nbsp;
            <input type="text" id="nombre" name="nombre"/>
        </div>
        <div class="form-group">
            <label for="apellido" class="inline-80">Apellido</label> &nbsp;
            <input type="text" id="apellido" name="apellido"/>
        </div>
        <div class="form-group">
            <label for="email" class="inline-80">Correo electrónico</label> &nbsp;
            <input type="text" id="email" name="email"/>
        </div>
        <div class="form-group">
            <label for="fecha_inicio" class="inline-80">Fecha de inicio</label> &nbsp;
            <input type="date" id="fecha_inicio" name="fecha_inicio"/>
        </div>
        <div class="form-group">
            <input type="submit" value="Añadir" class="btn btn-primary"/>
        </div>
    </form>
</div>
</body>
</html>

