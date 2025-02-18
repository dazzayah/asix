<?php
declare(strict_types=1);
require_once "signup_model.inc.php";

function isInputEmpty(string $username, string $password, string $email): bool {
    if (empty($username || $password || $email)) {
        return true;
    } else {
        return false;
    }
}

function isEmailValid(string $email): bool {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function isUsernameTaken(string $username): bool {
    if (getUsername($username)) {
        return true;
    } else {
        return false;
    }
}

function isEmailRegistered(string $email): bool {
    if (getEmail($email)) {
        return true;
    } else {
        return false;
    }
}