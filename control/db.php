<?php

$host = 'localhost';
$dbname = 'formatos_digitales_db';
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("SET NAMES 'utf8'");

    // echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}