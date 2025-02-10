<?php
require_once 'includes/database.php';

$id = $_GET['id'];
borrarEmpleado($id);
header('Location: index.php');
exit;