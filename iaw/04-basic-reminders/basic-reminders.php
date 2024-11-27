<?php

echo "-----------------------------------------------------------------------------<br>";
echo " Problema 1: Temperatura Celsius a Fahrenheit<br>";
echo "-----------------------------------------------------------------------------<br><br>";

// Constante de temperatura en Celsius
define("CELS", 30);

// Cálculo y almacenamiento en una variable (Celsius a Fahrenheit)
$far = CELS * (9/5) + 32;
echo $far ." ºF";
echo "<br><br>";

// Variable string & concat. de variables con echo
$temperatura = 'La temperatura de hoy en grados celsius es ' .CELS .'ºC corresponde a ' .$far .'ºF grados Farenheit.';
echo $temperatura ."<br><br>";

// Condicional: ¿Frío o calor?
if ($far < 68) {
    echo "Hoy hace frío.";
}

else {
    echo "Hoy hace calor.";
}

echo "<br><br>";

echo "-----------------------------------------------------------------------------<br>";
echo " Problema 2: División de nombres enteros <br>";
echo "-----------------------------------------------------------------------------<br><br>";


echo "Los números <b>pares</b> son: ";
$num_par = 0;

for ($num_par; $num_par <= 100; $num_par++) {
    if ($num_par % 2 == 0) {
            echo "$num_par, ";
    }
}

echo "<br><br>";

echo "Los números <b>múltiplos de 5</b> son: ";
$num_mult = 0;

for ($num_mult; $num_mult <= 100; $num_mult++) {
    if ($num_mult % 5 == 0) {
            echo "$num_mult, ";
    }
}

echo "<br><br>";

// Condiciones número primo: Mayor a 1, y divisores 1 y sí mismo.

echo "Los números <b>primos</b> son: ";

for ($i = 1; $i <= 1000; $i++) {
    if (esPrimo($i)) {
        echo " $i,";
    }
}

function esPrimo($num) {
    
    // Si se divide (dando residuo 0) menos o más de dos veces, NO ES PRIMO.
    $veces_dividido = 0;
    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $veces_dividido = $veces_dividido + 1;
        }
    }

    /* En caso de que se divida 2 veces, ni más ni menos, ES PRIMO, y se devuelve
    el valor TRUE para esta iteración del bucle.*/

    if ($veces_dividido == 2) {
        return true;
    }

    /* En caso contrario, si $num se divide más o menos de dos veces, no es primo
    por lo que devuelve el valor FALSE.*/

    else {
        return false;
    }
}

?>