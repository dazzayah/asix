<?php
require_once 'database.php';
$generes = obtenirTotsElsGeneres();

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Gèneres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gèneres</h1>
    
    <ul>
            <?php foreach ($generes as $genere): ?>
                <li> ... </li>
            <?php endforeach; ?>

    </ul>
</body>
</html>
