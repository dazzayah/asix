<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nom"];
    $fecha_nacimiento = $_POST["data_naixement"];
    $deportes = $_POST["esports"];
    $nivel = $_POST["nivell"];
}

function calcularEdad($fecha_nacimiento) {
    
    # https://www.codecademy.com/resources/docs/php/date-functions/date-diff
    # Entiendo que este método está orientado a objetos, por lo que a pesar de ser más eficiente, 
    # técnicamente no lo hemos dado, así que le paso el prefijo oop_* a todas las variables.

    $oop_fecha_hoy = new DateTime(); # Objeto con la fecha de hoy.
    $oop_fecha_nacimiento = new DateTime($fecha_nacimiento); # Crea un objeto nuevo de clase DateTime con la fecha pasada por el formulario.
    $oop_calculo_edad = date_diff($oop_fecha_nacimiento,$oop_fecha_hoy); # Ya que la función date_diff solo trabaja con objetos DateTime.
    $oop_edad = $oop_calculo_edad->format("%y"); # Y lo pasamos al formato que queremos.

    # / ---------------------------------------------------- / #

    # Aunque lo podemos hacer un poco más guarro, sin usar estas funciones tan chulas.
    # De forma predeterminada la fecha llega del POST en formato (yyyy-dd-mm).

    $dia_actual = date("d");
    $mes_actual = date("m"); # Fechas actuales separadas para poder calcular sobre ellas.
    $año_actual = date("Y");

    $fecha_nacimiento = explode("-", $fecha_nacimiento); # Separamos en un array los distintos valores separados por guiones.

    $año_nacimiento = $fecha_nacimiento[0];  
    $dia_nacimiento = $fecha_nacimiento[1]; # Y se los asignamos a variables distintas.
    $mes_nacimiento = $fecha_nacimiento[2]; 
    
    $edad = $año_actual - $año_nacimiento;

    # Y aquí verificamos y hacemos que, en caso de que este año no se hayan cumplido años todavía, se le reste 1 a la edad.

    if ($mes_actual < $mes_nacimiento || $mes_actual == $mes_nacimiento && $dia_actual < $dia_nacimiento) {
        $edad = $edad - 1;
    }

    # return $oop_edad;
    return $edad;
} 

function validarDeporte($deportes) {
    $deportes = str_replace(" ", "", $deportes); # Sanitiza los espacios en blanco.
    $deportes = explode(",", $deportes); # Lo necesito en forma de array, por lo que usamos explode() con la coma como separador.
    $deportes = array_filter($deportes); # https://www.studytonight.com/php-howtos/how-to-remove-empty-values-from-an-array-in-php

    return $deportes;
}

/* Validaciones a considerar:
    El nombre NO puede ser nulo. 
    El nombre debe tener al menos 3 caracteres. (Depende de la validación del anterior, elseif?)
    Deben introducirse 3 deportes separados por comas, y solamente 3.
    La fecha de nacimiento no puede ser posterior a la de hoy.
    Sanitizar los espacios en blanco.
*/

$errores = []; # Inicializamos un array para almacenar los errores.
$deportes_array = validarDeporte($deportes); # Lo convertimos a array antes de correr las comprobaciones.

if (empty($nombre)) {
    $errores[] = "El nombre no puede estar vacío.";
} elseif (strlen($nombre) < 3) {
        $errores[] = "El nombre no puede tener menos de 3 caracteres: <b>$nombre</b>";
    }

if ($fecha_nacimiento > date("Y-m-d")) {
    $errores[] = "La fecha de nacimiento no puede ser posterior a hoy.";
}

# Para mostrar los valores del array sin cambiar los valores de la variable directamente, corremos el opuesto a explode. 
# Esto muestra un resultado en forma de string de todos los valores del array.

if (count($deportes_array) !== 3) {
    $errores[] = "La lista de deportes no es correcta: " ."<b>" .implode(",", $deportes_array) ."</b>";
} 

if (!empty($errores)) {
    echo "<p style='color:red;'> Hay errores en la introducción de datos. </p>";
    echo "<ul style='color:red;'>";
    foreach ($errores as $error) { # Iteraremos sobre todos los errores recopilados hasta ahora y los mostraremos.
        echo "<li>$error</li>";
    }
    echo "</ul>";
} 

else {
    echo "<p style='color:green;'>Todos los datos son válidos.</p> <br>";
    
    echo "<h3>Entrada de datos</h3>";
    echo "<b>Nombre</b>: $nombre <br>";
    echo "<b>Edad</b>: " .calcularEdad($fecha_nacimiento) ." años<br>";
    
    echo "<br><b>Deportes favoritos</b>:<br><br>";

    /* 
    Si està entre 0 i 1 → no practicat.
    Si està entre 2 i 4 → poc practicat.
    Si està entre 5 i 7 → força practicat.
    Si és superior a 8 → molt practicat. <-- El 8 lo he incluido en la ultima validación, dado que si se introduce 8 no pasará nada (?)
    */

    if ($nivel == 0 || $nivel == 1) {
        $nivel = "No practicado";
    } elseif ($nivel >= 2 && $nivel <= 4) {
        $nivel = "Poco practicado";
    } elseif ($nivel >= 5 && $nivel <= 7) {
        $nivel = "Regularmente practicado";
    } elseif ($nivel >= 8) {
        $nivel = "Muy practicado";
    } else {
        $nivel = "Nivel desconocido";
    }

    for ($i=0; $i <= 2; $i++) { 
        echo "<li>Deporte " .$i +1 .": <b>$deportes_array[$i]</b>";
        if ($i === 0) {
            echo " ($nivel)";
        }
    }
}

?>