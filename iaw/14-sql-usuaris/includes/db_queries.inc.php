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
function fetchUserData($id) {
    try {
        global $pdo;
        $query = 'SELECT * FROM usuaris WHERE id = ?;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        exit($e -> getMessage());
    }
}

function fetchAddressData($id) {
    try {
        global $pdo;
        $query = 'SELECT * FROM adreces WHERE id = ?;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        exit($e -> getMessage());
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

function rmLog($id) {
    try {
        global $pdo;
        $query = 'DELETE FROM logs WHERE usuari_id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);
    } catch (PDOException $e) {
        exit( $e -> getMessage());
    }
}

// Funció per eliminar un usuari
function rmUser($id) {
    try {
        global $pdo;
        rmAddress($id); // <-- Borramos las referencia (FK) primero
        rmLog($id);
        $query = 'DELETE FROM usuaris WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);
    } catch (PDOException $e) {
        exit( $e -> getMessage());
    }
}

function fullAddUser($name, $surname, $username, $email, $birth, $street, $city, $postal_code, $country) {
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

function briefAddUser($name, $surname, $username, $email, $birth) {
    try {
        global $pdo;
        $query = 'INSERT INTO usuaris (nom, cognoms, nom_usuari, correu, data_naixement) VALUES (?, ?, ?, ?, ?);';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$name, $surname, $username, $email, $birth]);
    } catch (PDOException $e) {
        exit( $e -> getMessage());
    }
}

function addLog($user_id, $field, $old_value, $new_value, $mod_date, $ip) {
    try {
        global $pdo;
        $query = 'INSERT INTO logs (usuari_id, camp_modificat, valor_antic, valor_nou, data_modificacio, ip) 
                  VALUES (?, ?, ?, ?, ?, ?);';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$user_id, $field, $old_value, $new_value, $mod_date, $ip]);
    } catch (PDOException $e) {
        exit ($e -> getMessage());
    }
}

function editUser($id, $name, $surname, $username, $email, $birth, $street, $city, $postal_code, $country) {
    try {
        global $pdo;

        // Toma de datos para registrarlos en el log, (antes de hacerse ningun cambio)

        $query = 'SELECT nom_usuari, correu FROM usuaris WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);
        $old_data = $stmt -> fetch(PDO::FETCH_ASSOC);

        $old_username = $old_data['nom_usuari'];
        $old_email = $old_data['correu'];
        $mod_date = date('Y-m-d H:i:s');

        // Edicion

        $query = 'UPDATE usuaris SET nom = ?, cognoms = ?, nom_usuari = ?, correu = ?, data_naixement = ? WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$name, $surname, $username, $email, $birth, $id]);

        // Y ahora comprobamos si se han hecho cambios y los registramos si es asi
        if ($old_username !== $username) {
            addLog($id, "nom_usuari", $old_username, $username, $mod_date, $_SERVER['REMOTE_ADDR']);
        }
        if ($old_email !== $email) {
            addLog($id, "correu", $old_email, $email, $mod_date, $_SERVER['REMOTE_ADDR']);
        }

        // Para evitar utilizar sintaxis propia de SQL para solucionar el "conflicto" de utilizar UPDATE o INSERT extraeremos los datos mediante un select
        $query = 'SELECT * FROM adreces WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);
        $exists = $stmt -> fetch(); // <-- verificamos si contiene algo (true), o no (false).

        // Condicional UPDATE || INSERT

        if ($exists == true) {
            $query = 'UPDATE adreces SET carrer = ?, ciutat = ?, codi_postal = ?, pais = ? WHERE id = ?;';
            $stmt = $pdo -> prepare($query);
            $stmt -> execute([$street, $city, $postal_code, $country, $id]);
        } else {
            $query = 'INSERT INTO adreces (id, carrer, ciutat, codi_postal, pais) VALUES (?, ?, ?, ?, ?);';
            $stmt = $pdo -> prepare($query);
            $stmt -> execute([$id, $street, $city, $postal_code, $country]);
        }
    } catch (PDOException $e) {
        exit( $e -> getMessage());
    }
}


