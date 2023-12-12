<?php
require_once 'funciones.php';

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $color = $_POST["color"];
    guardarPreferenciasColor($color, $_SESSION["usuario"]);
}

$colorSeleccionado = obtenerPreferenciasColor($_SESSION["usuario"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación</title>
    <style>
        body {
            background-color: <?php echo $colorSeleccionado; ?>;
        }
    </style>
</head>
<body>
<p>Conectado como: <?php echo $_SESSION["usuario"]; ?></p>
<p>(Inicio de sesión: <?php echo $_SESSION["horaInicio"]; ?>)</p>

<h2>Aplicación</h2>
<!-- This is the Menu for the logged user -->
<h3>Menu de Aplicaciones</h3>
<p><a href="preferencias.php">Ir a Preferencias</a></p>
<p><a href="informacion.php">Ver Información con las Preferencias Actualizadas</a></p>
<p><a href="cerrar_sesion.php">Cerrar Sesión</a></p>
</body>
</html>