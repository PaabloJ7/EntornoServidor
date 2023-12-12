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
    <title>Preferences</title>
    <style>
        body {
            background-color: <?php echo $colorSeleccionado; ?>;
        }
    </style>
</head>
<body>
<p>Connected as: <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></p>
<p>(Login time: <?php echo isset($_SESSION["startTime"]) ? $_SESSION["startTime"] : "N/A"; ?>)</p>

<p><a href="information.php?logout=true">Back to the homepage</a></p>

<h2>Information</h2>
<p>Explanation of how the application works.</p>

<!-- Some paragraphs -->
<h3>Application.php Features:</h3>
<p>The application.php page provides exclusive access to authenticated users.</p>
<p>On this page, users can:</p>
<ul>
    <li>Access the updated information page.</li>
    <li>Adjust their background color preferences on the preferences page.</li>
    <li>Logout to exit the application.</li>
</ul>

</body>
</html>
