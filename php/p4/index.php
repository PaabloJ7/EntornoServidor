<?php
require_once 'funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
<h2>Iniciar Sesión</h2>
<form method="post" action="abrir_sesion.php">
    Usuario:
    <label>
        <input type="text" name="usuario" required>
    </label>
    <br>
    Contraseña:
    <label>
        <input type="password" name="contrasena" required>
    </label>
    <br>
    <input type="submit" value="Iniciar Sesión">
</form>
<p><a href="informacion.php">Acceder como invitado</a></p>
</body>
</html>
