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
    // After saving goes back to aplication
    header("Location: aplicacion.php");
    exit();
}

// If we access to procesar_preferencias.php directly without any form action, redirects to aplication page.
header("Location: aplicacion.php");
exit();

