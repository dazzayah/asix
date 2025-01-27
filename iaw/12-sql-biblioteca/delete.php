<?php
require 'database.php';

$id = $_GET['id'];
eliminarLlibre($id);
header('Location: index.php');
exit;