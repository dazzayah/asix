<?php
require 'database.php';

$id = $_GET['id'];
$llibre = obtenirLlibre($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $any = $_POST['any_publicacio'];
    $genere = $_POST['genere'];

    editarLlibre($id, $titol, $autor, $any, $genere);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Editar Llibre</title>
</head>
<body>
    <h1>Editar Llibre</h1>
    <form method="POST">
        <label>Títol: <input type="text" name="titol" value="<?= htmlspecialchars($llibre['titol']) ?>" required></label><br>
        <label>Autor: <input type="text" name="autor" value="<?= htmlspecialchars($llibre['autor']) ?>" required></label><br>
        <label>Any de Publicació: <input type="number" name="any_publicacio" value="<?= htmlspecialchars($llibre['any_publicacio']) ?>" required></label><br>
        <label>Gènere: <input type="text" name="genere" value="<?= htmlspecialchars($llibre['genere']) ?>" required></label><br>
        <button type="submit">Actualitzar</button>
    </form>
</body>
</html>

