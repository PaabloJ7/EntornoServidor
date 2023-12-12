<?php
require_once 'funciones.php';
session_start();

$colorSeleccionado = obtenerPreferenciasColor($_SESSION["usuario"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias</title>
    <style>
        body {
            background-color: <?php echo $colorSeleccionado; ?>;
        }
    </style>
</head>
<body>
<p>Conectado como: <?php echo $_SESSION["usuario"]; ?></p>
<p>(Inicio de sesión: <?php echo $_SESSION["horaInicio"]; ?>)</p>

<h2>Preferencias</h2>
<form method="post" action="procesar_preferencias.php">
    Selecciona un color de fondo:
    <label>
        <input type="color" name="color" value="<?php echo $colorSeleccionado; ?>">
    </label>
    <br>
    <input type="submit" value="Guardar Preferencias">
</form>
<form method="post" action="reset_preferencias.php">
    <input type="submit" value="Restablecer Preferencias">
</form>
<p><a href="informacion.php">Ver Información con las Preferencias Actualizadas</a></p>
<p><a href="cerrar_sesion.php">Cerrar Sesión</a></p>
</body>
</html>