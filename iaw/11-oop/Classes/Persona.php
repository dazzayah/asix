<?php

class Persona {
    // Propiedades de acceso, public, protected o private
    private $nombre;
    private $apellido;
    private $edad;

    public static $descripcion = "Individuo de la especie humana.";

    // Método mágico ímplicito de PHP, función lanzada por defecto por cada objeto creado.
    public function __construct($nombre, $apellido) {
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
    }

    public function setEdad($edad) {
        $this -> edad = $edad;
    }

    public function getEdad() {
        return $this -> edad;
    }

    public function saludar() {
        echo "¡Hola, soy {$this -> nombre}!";
    }

    // Método estático
    public static function saludarEstatico(){
        return "¡Hola, no formo parte de un objeto, por lo que soy una función estática!";
    }
}


