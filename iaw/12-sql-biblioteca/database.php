<?php
require_once 'config.php';

function obtenirLlibres()
{
    try {
        global $pdo;
        $query = 'SELECT * FROM llibres;';
        $stmt = $pdo -> query($query);

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        exit($e -> getMessage());
    }
}

function afegirLlibre($titol, $autor, $any, $genere)
{
    try {
        global $pdo;
        $query = 'INSERT INTO llibres (titol, autor, any_publicacio, genere) VALUES (?, ?, ?, ?);';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$titol, $autor, $any, $genere]);

    } catch (PDOException $e) {
        exit($e -> getMessage());
    }
}

function obtenirLlibre($id)
{
    try {
        global $pdo;
        $query = 'SELECT * FROM llibres WHERE id = ?';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        exit($e -> getMessage());
    }
}

function editarLlibre($id, $titol, $autor, $any, $genere) 
{
    try {
        global $pdo;
        $query = 'UPDATE llibres SET ';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([]);

    } catch (PDOException $e) {
        exit ($e -> getMessage());
    }
}

function eliminarLlibre($id)
{
    try {
        global $pdo;
        $query = 'DELETE FROM llibres WHERE id = ?';
        $stmt = $pdo -> prepare($query);
        $stmt -> execute([$id]);

    } catch (PDOException $e) {
        exit($e -> getMessage());
    }
}
