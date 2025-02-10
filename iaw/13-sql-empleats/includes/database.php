<?php

require_once 'config.php';

function getEmpleados() {
    try {
        global $pdo;
        $query = 'SELECT * FROM empleats;';
        $stmt = $pdo->query($query);

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

function addEmpleado($nom, $cognom, $email, $data_inici) {
    try {
        global $pdo;
        $query = 'INSERT INTO empleats (nom, cognom, email, data_inici) VALUES (?, ?, ?, ?);';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$nom, $cognom, $email, $data_inici]);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

function fetchDatosEmpleado($id) {
    try {
        global $pdo;
        $query = 'SELECT * FROM empleats WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);

        return $stmt -> fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }

}

function editarEmpleado($id, $nom, $cognom, $email, $data_inici) {
    try {
        global $pdo;
        $query = 'UPDATE empleats SET nom = ?, cognom = ?, email = ?, data_inici = ? WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$nom, $cognom, $email, $data_inici, $id]);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

function borrarEmpleado($id) {
    try {
        global $pdo;
        $query = 'DELETE FROM empleats WHERE id = ?;';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
