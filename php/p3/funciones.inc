<?php
function conectar() {
    $host = "localhost";
    $usuario = "dwes";
    $contrasena = "";
    $baseDatos = "ventas_comerciales";

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $contrasena);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}

function obtenerComerciales() {
    $conexion = conectar();
    $comerciales = $conexion->query("SELECT * FROM Comerciales")->fetchAll(PDO::FETCH_ASSOC);
    return $comerciales;
}

function obtenerProductos() {
    $conexion = conectar();
    $productos = $conexion->query("SELECT * FROM Productos")->fetchAll(PDO::FETCH_ASSOC);
    return $productos;
}
?>
