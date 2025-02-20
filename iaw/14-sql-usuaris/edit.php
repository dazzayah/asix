<?php
require_once 'includes/db_queries.inc.php';

$id = $_GET['id'];
$empleado = fetchUserData($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $fecha_inicio = $_POST['fecha_inicio'];

    editarEmpleado($id, $nombre, $apellido, $email, $fecha_inicio);
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
    <link rel="stylesheet" href="estils.css">
</head>
<body>

<h2>Editar Usuari</h2>



<form method="POST">
    <div>
        <label for="nombre">Nombre</label> &nbsp;
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($['nom']); ?>"/>
    </div>
    <div>
        <label for="apellido">Apellido</label> &nbsp;
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($empleado['cognom']); ?>" />
    </div>
    <div>
        <label for="email">Correo electrónico</label> &nbsp;
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($empleado['email']); ?>" />
    </div>
    <div>
        <label for="fecha_inicio">Fecha de inicio</label> &nbsp;
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($empleado['data_inici']); ?>"/>
    </div>
    <div>
        <input type="submit" value="Guardar" class="btn btn-primary" />
    </div>
</form>

</body>
</html>
