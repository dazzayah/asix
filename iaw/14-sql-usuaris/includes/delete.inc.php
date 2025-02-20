<?php
require_once "db_queries.inc.php";

$id = $_GET['id'];
rmUser($id);
header('Location: ../index.php');
exit;