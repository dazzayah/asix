<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT-6: Formularios</title>
</head>

<body>
    <h1 style="text-align: center;"> Formularios en PHP </h1>
    <h2 style="text-align: center; padding-bottom: 50px"> 0376 - Implantación de aplicaciones web </h2>
    <h3>1 & 2. Crea un formulario con dos campos y añade un botón para enviar los datos:</h3>
    <form action="forms.php" method="GET">
        <label for="num">Número:</label>
        <input type="number" id="num" name="num" min="0" required>
        <br><br>
        <label for="per">Porcentaje: </label>
        <input type="number" id="per" name="per" min="0" max="100" required> %
        <br><br>
        <input type="submit" value="Calcular">
    </form><br>
    <h3>3 & 4. Usando PHP, recoge los datos enviados mediante GET y haz el cálculo del porcentaje. Muestra el valor:</h3>
    <?php
    /* Durante la primera ejecución, es posible que el navegador notifique que el valor de la 
    variable es null, por lo que aplico una comprobación. En caso de que sea null, por defecto
     le asignaremos 0, y en caso de tener un valor, dejará el introducido por el formulario*/
    
    if (isset($_GET['num'])) {
        $num = $_GET['num'];
    }else {
        $num = 0;
    }

    if (isset($_GET['per'])) {
        $per = $_GET['per'];
    }else {
        $per = 0;
    }

    # Incluso habiendo añadido un atributo min en los formularios, los comprobaremos con php
    

    $resultado = $num * $per / 100;
    echo "El <i>$per%</i> de <i>$num</i> es <b>$resultado</b>.";
    ?>
</body>

</html>