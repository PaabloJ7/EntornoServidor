<?php
require_once 'funciones.php';

session_start();

// Obtains name from session
$usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : "";

// Calls function with username
eliminarPreferenciasColor($usuario);

header("Location: preferencias.php");
exit();
