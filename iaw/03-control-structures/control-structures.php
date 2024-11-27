<?php
$day = "Viernes";

# Primera condición IF
if ($day == "Lunes") {
    echo "El peor día de la semana.";
}

# Condiciones ELSEIF
elseif ($day == "Martes") {
    echo "¡Es $day!";
} elseif ($day == "Miercoles") {
    echo "¡Es $day!";
} elseif ($day == "Jueves") {
    echo "¡Es $day!";
} elseif ($day == "Viernes") {
    echo "¡Es $day!";
}

# Condición ELSE
else {
    echo "Es fin de semana, ¡esperemos que sea sabado!";
}

echo "<br><br>";


switch ($day) {

    case "Martes":
        echo $day;
        break;

    default:
        echo "Vaya <br><br>";
}

$month = 1;

while ($month <= 12) {
    echo "Este mes es el $month <br>";
    $month++;
}

echo "<br><br>";

$line = 1;

while ($line <= 5) {
    $i = 1;
    while ($i <= $line) {
        echo "*";
        $i++;
    }

    echo "<br>";
    $line++;
}
?>
