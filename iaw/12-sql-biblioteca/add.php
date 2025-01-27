<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $any = $_POST['any_publicacio'];
    $genere = $_POST['genere'];

    afegirLlibre($titol, $autor, $any, $genere);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Afegir Llibre</title>
</head>
<body>
    <h1>Afegir Llibre</h1>
    <form method="POST">
        <label>Títol: <input type="text" name="titol" required></label><br>
        <label>Autor: <input type="text" name="autor" required></label><br>
        <label>Any de Publicació: <input type="number" name="any_publicacio" required></label><br>
        <label>Gènere: <input type="text" name="genere" required></label><br>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>

