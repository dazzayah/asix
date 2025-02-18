<?php
// Funció per obtenir tots els usuaris
function obtenir_usuaris() {
	global $pdo;
}

// Funció per obtenir un usuari per ID
function obtenir_usuari($id) {
	global $pdo;
}

// Funció per obtenir un usuari per ID
function obtenir_adreca($id) {
	global $pdo;
}

// Funció per afegir un usuari
function afegir_usuari($nom, $cognoms, $nom_usuari, $correu, $data_naixement) {
	global $pdo;
}

// Funció per actualitzar un usuari
function actualitzar_usuari($id, $nom, $cognoms, $nom_usuari, $correu, $data_naixement) {
	global $pdo;
}

// Funció per actualitzar una adreça
function actualitzar_adreca($id, $carrer, $ciutat, $codi_postal, $pais) {
	global $pdo;
}

// Funció per eliminar un usuari
function eliminar_usuari($id) {
	global $pdo;
}

// Funció per eliminar l'adreça d'un usuari
function eliminar_adreca($id_usuari) {
	global $pdo;
}

// Funció per eliminar logs
function eliminar_adreca($id_usuari) {
	global $pdo;
}

// Funció per registrar els logs
function registrar_log($usuari_id, $camp_modificat, $valor_antic, $valor_nou) {
	global $pdo;
}



?>
