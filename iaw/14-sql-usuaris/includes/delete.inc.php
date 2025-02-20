<?php
require_once "db_queries.inc.php";

$id = $_GET['id'];
rmUser($id);
header('Location: /14-sql-usuaris/index.php');
exit;