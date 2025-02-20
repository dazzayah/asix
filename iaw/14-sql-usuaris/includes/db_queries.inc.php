<?php
require_once "db_handler.inc.php";

// Funció per obtenir tots els usuaris
function fetchUsers() {
	try {
		global $pdo;
		$query = 'SELECT * FROM usuaris;';
		$stmt = $pdo->query($query);

		return $stmt -> fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $e) {
		exit($e -> getMessage());
	}
}

// Funció per obtenir un usuari per ID
function fetchUserID($id) {
	global $pdo;
}

function fetchUserData() {
    global $pdo;
}

// Funció per eliminar un usuari
function rmUser($id) {
    try {
        global $pdo;
        rmAddress($id);
        $query = 'DELETE FROM usuaris WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);
    } catch (PDOException $e) {
        exit( $e -> getMessage());
    }
}

function rmAddress($id) {
	try {
		global $pdo;
		$query = 'DELETE FROM adreces WHERE id = ?;';
		$stmt = $pdo -> prepare($query);
		$stmt -> execute([$id]);
	} catch (PDOException $e) {
		exit( $e -> getMessage());
	}
}

function addUser($name, $surname, $username, $email, $birth, $street, $city, $postal_code, $country) {
	try {
		global $pdo;
		$query = 'INSERT INTO usuaris (nom, cognoms, nom_usuari, correu, data_naixement) VALUES (?, ?, ?, ?, ?);';
		$stmt = $pdo -> prepare($query);
		$stmt -> execute([$name, $surname, $username, $email, $birth]);
        $userid = $pdo -> lastInsertId();

        $query = 'INSERT INTO adreces (id, carrer, ciutat, codi_postal, pais) VALUES (?, ?, ?, ?, ?);';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$userid, $street, $city, $postal_code, $country]);
	} catch (PDOException $e) {
		exit( $e -> getMessage());
	}
}

/*
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
}*/

