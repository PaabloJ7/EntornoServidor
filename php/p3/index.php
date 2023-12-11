<?php
include 'funciones.inc';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcion = $_POST['opcion'];

    switch ($opcion) {
        case 'consultar_ventas':
            header("Location: consultar_ventas.php");
            exit();
        case 'insertar_datos':
            header("Location: insertar_datos.php");
            exit();
        case 'modificar_datos':
            header("Location: modificar_datos.php");
            exit();
        case 'eliminar_datos':
            header("Location: eliminar_datos.php");
            exit();
        default:
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Ventas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Menú de Opciones</h1>

    <form method="post" action="">
        <select name="opcion">
            <option value="consultar_ventas">Consulta de Ventas</option>
            <option value="insertar_datos">Inserción de Datos</option>
            <option value="modificar_datos">Modificación de Datos</option>
            <option value="eliminar_datos">Eliminación de Datos</option>
        </select>
        <button type="submit">Seleccionar</button>
    </form>
</body>
</html>
