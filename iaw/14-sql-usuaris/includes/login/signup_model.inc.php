<?php
declare(strict_types=1);
require_once "../db_handler.inc.php";

function getUsername(string $username) {
    global $pdo;

    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(":username", $username);
    $stmt -> execute();

    return $stmt -> fetch(PDO::FETCH_ASSOC);
}

function getEmail(string $email) {
    global $pdo;

    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(":email", $email);
    $stmt -> execute();

    return $stmt -> fetch(PDO::FETCH_ASSOC);
}