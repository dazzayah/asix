<?php
// require_once "signup_contr.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    try {

        // ERR Handlers
        $errors = [];

        if (isInputEmpty($username, $password, $email)) {
            $errors["empty_input"] = "Rellena todos los campos.";
        }

        if (isEmailValid($email)) {
            $errors["invalid_email"] = "El correo que has introducido no es válido.";
        }

        if (isUsernameTaken($username)) {
            $errors["username_taken"] = "El nombre de usuario que has introducido ya existe.";
        }

        if (isEmailRegistered($email)) {
            $errors["email_taken"] = "Este correo electrónico ya está registrado.";
        }

        if (!empty($errors)) {
            $_SESSION["error_signup"] = $errors;
            header("Location: ../register.php");
        }

    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

} else {
    header("Location: ../register.php");
    die();
}