<?php

// FIXME Credenciales MySQL Docker root@root, dejar passwd vacía al terminar

$host = 'localhost:3306';
$db = 'PT1_EMPLEATS';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script> alert('Conexión establecida con éxito, bienvenido $user');</script>";
} catch (PDOException $e) {
    echo 'Error de connexió: ' . $e->getMessage();
    exit;
}
