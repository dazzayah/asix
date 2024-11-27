<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT-5: Funciones</title>
</head>
<body>
<h1 style="text-align: center;"> Funciones en PHP </h1>
<h4 style="text-align: center; padding-bottom: 50px"> 0376 - Implantación de aplicaciones web </h4>
<h5>Ejercicio 1: Crea una función llamada "saluda" que imprima "¡Hola mundo!" cuando sea llamada.</h5>

	<?php
	function saluda() {
		echo "¡Hola mundo!";
	}

	saluda();
	?>

<h5>Ejercicio 2: Crea una función llamada "suma" que acepte dos números como parámetros y devuelve su suma.</h5>

	<?php
	function suma($a,$b) {
		echo $a + $b;
	}

	suma(5,3);
	?>

<h5>Ejercicio 3: Crea una función llamada "saludarTodos" que reciba un array de nombres y los imprima en cada línea mensaje "¡Hola [nombre]!"</h5>

	<?php
	$nombres = ["Joan","Eyesac","Pedro"];

	function saludarTodos($x) {
		for ($i=0; $i <= 2; $i++) { 
			echo "¡Hola {$x[$i]}!<br>";
		}
	}

	saludarTodos($nombres);
	?>

<h5>Ejercicio 4: Crea una función llamada "multiplicar" que acepte dos números y devuelva su producto</h5>

	<?php
	function multiplicar($x, $y) {
		echo $x * $y;
	}

	multiplicar(5,3);
	?>

<h5>Ejercicio 5: Crea una función "imprimirCuadrado" que acepte un número e imprima un cuadrado de símbolos "*" de a medida indicada.</h5>
    
	<?php
	function imprimirCuadrado($x) {
		for ($i=0; $i < $x; $i++) {
			for ($j=0; $j < $x; $j++) { 
				echo "&nbsp &nbsp *";
			}
			echo "<br>";
		}
	}          

	imprimirCuadrado(6);
	?>

<h5>Ejercicio 6: Crea una función InvertirCadena que reciba una cadena y la devuelva invertida</h5>

	<?php
	function invertirCadena($x) {
		return strrev($x);
	}

	$string_invertida = invertirCadena("Hola que tal");
	echo $string_invertida;
	?>

<h5>Ejercicio 7: Crea la función "convertirMayusculas" que reciba una cadena y la convierte</h5>

	<?php
	function convertirMayusculas($x) {
		return strtoupper($x);
	}

	$string_minuscula = "hola que tal";
	$string_mayuscula = convertirMayusculas($string_minuscula);
	echo $string_mayuscula
	?>

<h5>Ejercicio 8: Crear una función llamada "contarVocales" que reciba una cadena y conte el número de vocales que contiene.</h5>

	<?php

	function contarVocales($x) {
		$longitud = strlen($x);
		// $letras = explode($x);
		$vocales = [];
		// for ($i=0; $i < $longitud; $i++) { 
		// 	if 
		//}

	}

	?>

</body>
</html>