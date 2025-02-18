<?php

// Cambios en el .ini para aumentar la seguridad del sitio, pasando parámetros desactivados por defecto a 1..
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Y configuramos los parámetros de la creación de cookies:
session_set_cookie_params([
   'lifetime' => 1800, // Tiempo de vida
   'domain' => 'localhost', // Supongo que evita la interacción malintencionada del dominio (fuzzing?)
   'path' => '/', // Si se define una raíz se evita recursividad inintencionada
   'secure' => true,
   'httponly' => true
]);

session_start(); // Declaramos el inicio de una sesión al momento de ejecutarse este php

/* Esta sección de código es muy interesante, vista en el curso de Dani Krossing de PHP:
https://www.youtube.com/watch?v=Ojk70Ag8Ofs

Nos aseguramos de que la ID de la sesión se regenere de forma regular para evitar "secuestros" de sesión.
Esto lo logramos iniciando un condicional que verifica que nuestro valor "ultima_reg" no exista en la
variable $_SESSION.
*/

if (!isset($_SESSION["last_reg"])) {
    session_regenerate_id(); // En caso de que no exista, se genera un id nuevo.
    $_SESSION["last_reg"] = time(); // Y creamos un nuevo valor en el array asociado al momento de hacerlo.
} else {
    $interval = 60 * 30; // Si existe, en este caso he definido un intervalo de 30 minutos en segundos.
    if (time() - $_SESSION["last_reg"] >= $interval) { // Si en este preciso instante hemos superado el intervalo...
        session_regenerate_id(); // Se regenera la id de sesión
        $_SESSION["last_reg"] = time(); // Y reasignamos el valor nuevamente.
    }
}