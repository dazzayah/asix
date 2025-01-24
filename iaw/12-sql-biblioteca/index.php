<?php
require 'database.php';
$llibres = obtenirLlibres();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Llibres a la Biblioteca</h1>
    <a href="genere.php">Mostrar gèneres ordenats</a>
    <br />
    <a href="add.php">Afegir un nou llibre</a>
    <table border="1">
        <thead>
            <tr>
                <th>Títol</th>
                <th>Autor</th>
                <th>Any</th>
                <th>Gènere</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($llibres as $llibre): ?>
                <tr>
                    <td><?= htmlspecialchars($llibre['titol']) ?></td>
                    <td><?= htmlspecialchars($llibre['autor']) ?></td>
                    <td><?= htmlspecialchars($llibre['any_publicacio']) ?></td>
                    <td><?= htmlspecialchars($llibre['genere']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $llibre['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="delete.php?id=<?= $llibre['id'] ?>" onclick="return confirm('Segur que vols eliminar aquest llibre?');" class="btn btn-delete">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

