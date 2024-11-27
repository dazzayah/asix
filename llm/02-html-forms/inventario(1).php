<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT1 - Introducción a PHP</title>
</head>

<body>
  <?php
  # Pregunta 1: Array asociativo/multidimensional
  
  $inventario = [
    "P1" => ["nombre" => "Monitor MSI 27", "precio" => 115.20, "stock" => 20],
    "P2" => ["nombre" => "Ratón Logitech", "precio" => 14.75, "stock" => 8],
    "P3" => ["nombre" => "Disco duro SSD 512GB", "precio" => 88.15, "stock" => 16],
    "01" => ["nombre" => "Portátil ZBook 17", "precio" => 1215.00, "stock" => 2],
    "02" => ["nombre" => "Ordenador Dell X9", "precio" => 480.52, "stock" => 5],
  ];
  ?>
  
  <h3>Ejercicio 2: Mostrar tabla de productos</h3>

    <?php

    # Pregunta 2: Recorrido del array con bucle y echo del contenido
    
    /* Al tratar con arrays asociativos, utilizaré foreach para evitar poner un número definido
    y estático de iteraciones, haciendo que el foreach pase por todos los elementos en el array */

    foreach ($inventario as $codigo => $producto) # Muestra toda la tabla
    {
      /* echo "Código</b>: $codigo" 
        ." Nombre: " .$producto["nombre"] 
        ." Precio: " .$producto["precio"] ."€" 
        ." Stock: " .$producto["stock"] ." Unidades <br>";
        */

      # Acabo de descubrir los placeholders, que maravilla.
      echo "Código: {$codigo} | Nombre: {$producto["nombre"]} | Precio: {$producto["precio"]}€ | Stock: {$producto["stock"]} Unidades <br>";
    } 
    ?>
    
  <br><hr>
  <h3>Ejercicio 3: Buscar por código</h3>
  <form action="" method="POST">
        <label for="codigo_busqueda">Código de producto:</label>
        <input type="text" id="codigo_busqueda" name="codigo_busqueda" required>
        <button type="submit">Buscar</button>
  </form>

    <?php
    # Pregunta 3: Buscar productos por código
    # Caso 1: Búsqueda de un código existente y echo
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  # <-- Si se me permite la floritura...
      $codigo_busqueda = $_POST["codigo_busqueda"];
      $encontrado = false;
    
      /* Este if recorrerá todo el array hasta que encuentre la coincidencia, y cuando lo haga
      asignará el valor true a encontrado, lo cual evitará que se active el último condicional,
      que se encarga de validar si el código finalmente no existe. */
    
      foreach ($inventario as $codigo => $producto) {
        if ($codigo_busqueda == $codigo) {
          echo "Producto $codigo_busqueda: Nombre: {$producto["nombre"]} | Precio: {$producto["precio"]}€ | Stock: {$producto["stock"]} Unidades <br>";
          $encontrado = true;
        }
      }
    
      # Caso 2: Si el código no existe, el valor del booleano nunca cambia.
      
      if ($encontrado == false) {
        echo "No se ha encontrado el código: $codigo_busqueda";
      }
    }
    ?>

  <br><hr>
  <h3>Ejercicio 4: Stock total de todos los productos</h3>
  
    <?php
    # Pregunta 4: Cuenta de productos en stock, sumando
    
    $stock_total = 0; # Inicializamos una variable para mantener la cuenta de la suma por vuelta.

    foreach ($inventario as $codigo => $producto) {
      $stock_total = $stock_total + $producto["stock"]; # <-- Y la llamamos para almacenar los resultados (1a iteración [0+20], 2a iteración [20+8]...)
      echo "Stock de $codigo: {$producto["stock"]} <br>";
    }

    echo "<br> Cantidad total en stock: <b>$stock_total</b> <br>";
    ?>

  <br><hr>
  <h3>Ejercicio 5: Producto más caro</h3>
  
    <?php

    # Pregunta 5: Muestra del producto más caro

    /*Inicializamos la variable con claves existentes del array que queremos extraer los valores 
    (mejor que crear múltiples variables de distintos tipos de datos, creo yo).*/

    $producto_caro = ["nombre" => "", "precio" => 0, "stock" => 0]; 

    foreach ($inventario as $codigo => $producto) {
      if ($producto["precio"] > $producto_caro["precio"]) {
        $producto_caro = $producto;
        $codigo_producto_caro = $codigo; # Almacena el código del producto que cumpla la condición (más caro), ya que $producto no lo contiene y quiero mostrarlo.
      }
    }

    echo "Producto más caro: Código $codigo_producto_caro | Nombre: {$producto_caro["nombre"]} | Por un precio de: {$producto_caro["precio"]}€<br>";
    ?>

  <br><hr>
  <h3>Ejercicio 6: Valor del inventario</h3>

    <?php

    # Pregunta 6: Muestra del valor total entre todos los productos en stock.
    $total = 0; # Inicializamos una variable de tipo INT 

    # Y el resultado de la multiplicación por iteración la almacenamos y la vamos agregando
    foreach ($inventario as $codigo => $producto) {
      $total = $total + $producto["stock"] * $producto["precio"]; # $total += $producto["stock"] * $producto["precio"];
    }

    echo "El total entre todos los productos en stock es: $total" . "€ <br>";

    ?>

  <br><hr>
  <h3>Ejercicio 7: ¡Alerta! ¡Falta de Stock!</h3>
  
    <?php

    # Pregunta 7: Evitar la falta de stock. 
    /* Condiciones: Se tienen menos de 3 unidades o tenemos 8 o menos unidades y su precio
    es inferior a 100 euros. */

    # No tengo muy claro que haga algo, pero los paréntesis dentro del condicional me ayudan a seccionar el rango de las puertas lógicas.
    # Si hay MENOS de 3, INMEDIATAMENTE hay escasez de ese producto, O ,si hay menos u 8 productos y su coste es menor a 100€.
    foreach ($inventario as $codigo => $producto) {
      if (($producto["stock"] < 3) or ($producto["stock"] <= 8 and $producto["precio"] < 100)) {
        echo "Hay escasez de: {$producto["nombre"]} | Código: {$codigo} | Precio: {$producto["precio"]}€ | Stock: {$producto["stock"]} Unidades <br>";
      }
    }
    ?>

  <br><hr>
  <h3>Ejercicio 8: Subida de precios un 10%</h3>

    <?php

    # Pregunta 8: Modificación del array, subida de precios un 10%

    foreach ($inventario as $codigo => $producto) {
      $inventario[$codigo]["precio"] = $producto["precio"] * 1.1;
      echo "$codigo: {$producto["nombre"]}, {$inventario[$codigo]["precio"]}€ --- (<i>+10%</i> de {$producto["precio"]}) <br>"; 
    }

    /* Es importante decir que, si operamos directamente sobre $producto, que no es más que una variable temporal mientras dura el bucle
    no surtirá ningún efecto sobre el array original, por lo que tenemos que partir desde $inventario[$codigo]["precio"]. */

    ?>

  <br><hr>
  <h3>Ejercicio 9: Añadir un Teclado HP al inventario</h3>

    <?php

    # Pregunta 9: Adición de un producto
    # Características: Código P4, Teclado HP, 21,00€, 10 unidades
    
    # $inventario = $inventario + ["P4" => ["nombre" => "Teclado HP", "precio" => 21.00, "stock" => 10]];
    
    $inventario["P4"] = ["nombre" => "Teclado HP", "precio" => 21.00, "stock" => 10];
    
    foreach ($inventario as $codigo => $producto) {
      echo "Código: {$codigo} | Nombre: {$producto["nombre"]} | Precio: {$producto["precio"]}€ | Stock: {$producto["stock"]} Unidades <br>";
    }

    ?>

  <br><hr>
  <h3>Ejercicio 10: Quitar productos del inventario</h3>
  
    <?php

    # Pregunta 10: Eliminación de productos condición OR
    # Condiciones: Tienen código P2 O Tienen un precio superior a 400€
    
    /*
    $codigos_finales= [];
    foreach ($inventario as $codigo => $producto) {
      if (!($codigo == "P2" or $inventario[$codigo]['precio'] > 400)){
        $codigos_finales = $codigos_finales + $inventario[$codigo];
      }
    }
    */

    /* Sin el uso de funciones, lo único que podemos hacer es crear un array nuevo o redefinir el original, por lo que definiremos
    nuevamente un condicional y utilizaremos puertas lógicas para validar cuál de los productos cumple dichas condiciones. 
    
    ¡PERO...! Tenemos que invertir el funcionamiento, y quedarnos con los "buenos", en vez de seleccionar los "malos", los que queremos eliminar. */

    $inventario_final = [];
    foreach ($inventario as $codigo => $producto) {
      if ($codigo != "P2" and $inventario[$codigo]['precio'] < 400) { # Si código NO equivale a P2 Y su precio es MENOR a 400€, pasará la comprobación.
        $inventario_final[$codigo] = $producto; # Y almacenamos los productos buenos dentro del array (anidado) del array vacío que hemos inicializado antes del bucle.
      }
    }

    foreach ($inventario_final as $codigo => $producto) {
      echo "{$codigo} Nombre: {$producto["nombre"]} | Precio: {$producto["precio"]}€ | Stock: {$producto["stock"]} Unidades <br>";
    }

    ?>
</body>
</html>