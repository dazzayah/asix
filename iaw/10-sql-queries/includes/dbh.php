<?php 

// Datos de la conexión y credenciales de la db.
$dsn = "mysql:host=localhost;dbname=futbol;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

/* Try-Catch, control de errores. En caso de aparecer un error 
 se lanza una excepción gracias a los métodos estáticos de la clase
 PDO (::ATTR_ERRMODE y ERRMODE_EXCEPTION) y se salta al bloque catch. */

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<script> alert('Conexión establecida con éxito, bienvenido $dbusername');</script>";


/* PDOException es una subclase de Exception, y le estamos indicando que
 si ocurre una excepción dentro del bloque try, lo capturamos y almacenamos
 en la variable $e. Al ser esta variable un objeto de esta clase heredada,
 tenemos acceso a sus métodos, como getMessage(), getCode() etc. /*

 /* No es necesario definir el objeto como $e = new PDOException, ya que la
 excepción se crea automáticamente solo si ocurre algún error. */

} catch (PDOException $e) {
    echo "Conexión fallida: " .$e -> getMessage();
}



