<?php
$host = 'localhost'; // Puede ser 'localhost' o la dirección IP de tu servidor MySQL si es remoto.
$dbname = 'ventas_comerciales';
$username = 'dwes';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Opcional: configurar el juego de caracteres a utf8
    $conn->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
