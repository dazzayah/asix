<?php

$persona=["Iliá","Joan","Adri","Alex"];

echo "Tenemos a los alumnos: " .$persona[0] .", " .$persona[1] .", " .$persona[2] .", " .$persona[3] ."<br><br>";

$altura=[
    $persona[0] => "1.86",
    $persona[1] => "1.82",
    $persona[2] => "1.79",
    $persona[3] => "1.75"
];


echo $persona[0] ." mide " .$altura[$persona[0]] ."<br>";
echo $persona[1] ." mide " .$altura[$persona[1]] ."<br>";
echo $persona[2] ." mide " .$altura["Adri"] ."<br>";
echo $persona[3] ." mide " .$altura["Alex"] ."<br>";


?>