<?php
require_once 'funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $userData = obtenerUsuario($usuario);

        if ($userData && verificarContrasena($contrasena, $userData["pwd"])) {
            // Iniciar sesión
            crearSesion($userData);
            header("Location: aplicacion.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Datos de usuario o contraseña no proporcionados.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
