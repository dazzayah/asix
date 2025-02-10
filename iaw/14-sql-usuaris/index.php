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
<div>
    &nbsp;
</div>

<div class="container" id="login-dialog">
    <form class="col-lg-4 col-lg-offset-4" style="border: 1px solid #aaa; text-align: center;">
        <div class="form-group">
            &nbsp;
        </div>
        <div class="form-group">
            <label>Username</label> &nbsp;
            <input type="text" id="username" />
        </div>
        <div class="form-group">
            <label>Password</label> &nbsp;
            <input type="password" id="password" />
        </div>
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary" />
        </div>
    </form>
</div>

<div>
    &nbsp;
</div>

<div class="container" id="menu">
    <a href="#" class="btn btn-default">Añadir</a> &nbsp;
    <a href="#" class="btn btn-default">Ordenar</a> &nbsp;
</div>

<div>
    &nbsp;
</div>

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
        <tr>
            <td>NU-CH-000001</td>
            <td>Chocolate chip cookies</td>
            <td>Pack</td>
            <td>
                <a href="#" class="btn btn-default">Editar</a> &nbsp;
                <a href="#" class="btn btn-default">Eliminar</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="container" id="new-entry">
    <h3>Añadir un empleado</h3>
    <form>
        <div class="form-group">
            <label for="nombre" class="inline-80">Nombre</label> &nbsp;
            <input type="text" id="nombre" />
        </div>
        <div class="form-group">
            <label for="apellido" class="inline-80">Apellido</label> &nbsp;
            <input type="text" id="apellido" />
        </div>
        <div class="form-group">
            <label for="email" class="inline-80">Correo electrónico</label> &nbsp;
            <input type="text" id="email" />
        </div>
        <div class="form-group">
            <label for="fecha_inicio" class="inline-80">Fecha de inicio</label> &nbsp;
            <input type="date" id="fecha_inicio" />
        </div>
        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary" />
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
</body>
</html>

