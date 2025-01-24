<?php
// Connexió a la base de dades
$host = 'localhost';
$db = 'biblioteca';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de connexió: ' . $e->getMessage();
    exit;
}

?>
