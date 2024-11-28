<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT-6: Formularios</title>
</head>

<body>
    <h1 style="text-align: center;"> Formularios en PHP </h1>
    <h2 style="text-align: center; padding-bottom: 50px"> 0376 - Implantación de aplicaciones web </h2>
    <hr>
    <h2>Ejercicio 1: Calculadora de porcentajes</h2>
    <h3>1 & 2. Crea un formulario con dos campos y añade un botón para enviar los datos:</h3>
    <form action="forms.php" method="GET">
        <label for="num">Número:</label>
        <input type="number" id="num" name="num" min="0" required>
        <br><br>
        <label for="per">Porcentaje: </label>
        <input type="number" id="per" name="per" min="0" max="100" required> %
        <br><br>
        <input type="submit" value="Calcular">
    </form><br>
    <h3>3 & 4. Usando PHP, recoge los datos enviados mediante GET y haz el cálculo del porcentaje. Muestra el valor:</h3>

    <?php
    function calcular()
    {
        /* Durante la primera ejecución, es posible que el navegador notifique que el valor de la variable es null, por lo que aplico una comprobación. 
        En caso de que sea null, por defecto le asignaremos 0, y en caso de tener un valor, dejará el introducido mediante el formulario */

        if (isset($_GET['num'])) {
            $num = $_GET['num'];
        } else {
            $num = 0;
        }

        if (isset($_GET['per'])) {
            $per = $_GET['per'];
        } else {
            $per = 0;
        }

        /* Incluso habiendo añadido un atributo min/max y required en los formularios, comprobaremos que los números cumplen los requisitos con un if statement */

        if ($num >= 0 && $per >= 0 && $per <= 100) {
            $resultado = $num * $per / 100;
            echo "El <i>$per%</i> de <i>$num</i> es <b>$resultado</b>.";
        } else {
            echo "Lo siento, los parámetros <b>no son válidos</b>.";
        }
    }

    calcular();
    ?>

    <br><br><br>
    <hr>
    <h2>Ejercicio 2: Formulario de registro</h2>
    <h3>1. Crea un formulario con los campos indicados:</h3>
    <form action="forms.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="mail">E-mail: </label>
        <input type="text" id="mail" name="mail">
        <br><br>
        <label for="birth">Fecha de nacimiento:</label>
        <input type="date" id="birth" name="birth">
        <br><br>
        <label for="passwd">Contraseña</label>
        <input type="password" id="passwd" name="passwd">
        <br><br>
        <input type="submit" value="Registrar">
    </form><br>
    <h3>2. Recoge los datos mediante POST y utiliza funciones personalizadas para validar los puntos indicados:</h3>

    <?php
    function tratar_datos()
    {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            $name = null;
        }
        if (isset($_POST['mail'])) {
            $mail = $_POST['mail'];
        } else {
            $mail = null;
        }
        if (isset($_POST['birth'])) {
            $birth = $_POST['birth'];
        } else {
            $birth = null;
        }
        if (isset($_POST['passwd'])) {
            $passwd = $_POST['passwd'];
        } else {
            $passwd = null;
        }

        # Esto comprueba que la longitud de la cadena sea mayor o igual a 3 caracteres y que el primer carácter empieza por mayúscula. 
        # (Lo he acabado invirtiendo de forma un poco vaga perdón)

        if ($name == null) {
            echo " ";
        } elseif ((strlen($name) >= 3 && ctype_upper(substr($name, 0, 1)))) {
            echo "<b style='color: green;'>[Nombre]</b> - Tu nombre es: <i>$name</i> <br>";
        } else {
            echo "<b style='color: red;'>[Nombre]</b> - El nombre <i>$name</i> no es válido. Debe tener más de 3 letras y empezar en mayúscula. <br>";
        }

        if ($name == null) {
            echo " ";
        } elseif ((filter_var($mail, FILTER_VALIDATE_EMAIL))) {
            echo "<b style='color: green;'>[E-mail]</b> - Tu correo es: <i>$mail</i> <br>";
        } else {
            echo "<b style='color: red;'>[E-mail]</b> - Este correo electrónico no es válido: <i>$mail</i> | E.g: johndoe123@unknown.com <br>";
        }

        $fecha = new DateTime($birth);
        $hoy = new DateTime();

        if ($birth == null) {
            echo " ";
        } elseif ($fecha < $hoy) {
            echo "<b style='color: green;'>[Fecha de nacimiento]</b> - Has nacido el: <i>$birth</i> <br>";
        } else {
            echo "<b style='color: red;'>[Fecha de nacimiento]</b> - Error, no puedes nacer en el futuro: <i>$birth</i> <br>";
        }

        if ($passwd == null) {
            echo " ";
        } elseif (strlen($passwd) >= 8) {
            echo "<b style='color: green;'>[Contraseña]</b> - Contraseña válida, tu contraseña es: $passwd <br>";
        } else {
            echo "<b style='color: red;'>[Contraseña]</b> - La contraseña <i>$passwd</i> es demasiado corta, asegúrate de incluir por lo menos 8 carácteres. <br>";
        }
    }

    tratar_datos();
    ?>

    <br><br>
    <hr>
    <h2>Ejercicio 3: Mensajería</h2>
    <h3>1. Crea un formulario con los campos indicados:</h3>

    <form action="forms.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username">
        <br><br>
        <label for="message">Mensaje: </label><br>
        <textarea id="message" name="message" rows="4" cols="50"></textarea>
        <br><br>
        <label for="lang">Idioma:</label>
        <select name="lang" id="lang">
            <option value="catalan">Català</option>
            <option value="castellano">Español (España)</option>
            <option value="english">English</option>
        </select>
        <br><br>
        <input type="submit" value="Envíar">
    </form><br>

    <h3>2. Muestra la respuesta personalizada al usuario:</h3>

    <?php
    function respuesta()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $username = null;
        }
        if (isset($_POST['message'])) {
            $message = $_POST['message'];
        } else {
            $message = null;
        }
        if (isset($_POST['lang'])) {
            $lang = $_POST['lang'];
        } else {
            $lang = null;
        }

        /*
        if ($lang == 'catalan') {
            echo "Hola $username, has enviat el següent missatge: $message";
        }
        if ($lang == 'castellano') {
            echo "Hola $username, has enviado el siguiente mensaje: $message"; 
        }   
        if ($lang == 'english') {
            echo "Hi $username, you've sent the following message: $message";
        }
        */

        switch ($lang) {
            case "catalan":
                echo "Hola <i style='color: green;'>$username</i>, has enviat el següent missatge: <i style='color: #218AFF;'>$message</i>";
                break;
            case "castellano":
                echo "Hola <i style='color: green;'>$username</i>, has enviado el siguiente mensaje: <i style='color: #218AFF;'>$message</i>";
                break;
            case "english":
                echo "Hi <i style='color: green;'>$username</i>, you've sent the following message: <i style='color: #218AFF;'>$message</i>";
                break;
            default:
                echo " ";
        }

        return $message;
    }

    $message = respuesta(); # Almacenamos el valor de la variable que hemos devuelto con return.
    ?>

    <h3>3. Utiliza la función strlen() para contar los caracteres del mensaje y mostrar la longitud:</h3>

    <?php
    if ($message != null) {   
        echo "Este mensaje tiene " .strlen($message) ." caracteres, <br><br>(<i>$message</i>).";
    } 
    ?>

</body>
</html>