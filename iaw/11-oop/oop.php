<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP PHP Programming</title>
</head>
<body>

<?php
    require_once "Classes/Persona.php";

    // Creamos los objetos $juan y $cristina de la clase Persona.
    $juan = new Persona("Juan", "López");
    $cristina = new Persona("Cristina", "Castaño");

    // Usamos el método saludar(), unicamente disponible en la clase Persona.
    $juan -> saludar();
    echo "<br>";

    // Llamamos al método saludar() y setEdad() de la clase Persona, instanciado por el objeto $cristina.
    $cristina -> saludar();
    $cristina -> setEdad(25);
    echo "<br>" .($cristina -> getEdad());

    // Llamar a un método estático con ::, estas no pueden usar $this ya que no forman parte de ningun objeto.
    echo "<br>" .Persona::saludarEstatico();

    // Por otro lado llamamos a la propiedad estática.
    echo "<br>" .Persona::$descripcion;
?>
</body>
</html>