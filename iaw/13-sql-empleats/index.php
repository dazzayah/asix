<?php
require 'includes/database.php';
require 'includes/functions.php';
$empleados = getEmpleados();
?>

<!doctype html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Empleats</title>
    <style>
        .inline-80 {
            display: inline-block;
            width: 80px;
        }
    </style>
</head>

<body>
<div class="container" id="listing">
    <h3>Lista de empleados</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fecha de Inicio</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado) {
                echo filaEmpleado($empleado);} ?>
        </tbody>
    </table>
    <div class="container" id="menu" style="padding-top: 10px">
        <a href="add.php" class="btn btn-default">Añadir</a> &nbsp;
    </div>
</div>




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- <script src="js/bootstrap.min.js"></script> -->
</body>
</html>

