<?php
declare(strict_types=1);

function checkSignupErrors() {
    if (isset($_SESSION["signup_errors"])) {
        $errors = $_SESSION["signup_errors"];

        echo "<br>";
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
        unset($_SESSION["signup_errors"]);
    }
}