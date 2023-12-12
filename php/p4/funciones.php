<?php
/**
 * Connects to the database using PDO.
 * @return PDO The database connection.
 */
function conectarBaseDatos() {
    $servername = "localhost";
    $username = "usu4";
    $password = "usu4";
    $dbname = "tarea4";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
/**
 * Closes the database connection.
 * @param PDO $conn The database connection to be closed.
 */
function cerrarConexion($conn) {
    $conn = null;
}
/**
 * Retrieves user data from the database based on the username.
 * @param string $usuario The username.
 * @return array|false An associative array containing user data, or false if not found.
 */
function obtenerUsuario($usuario) {
    $conn = conectarBaseDatos();
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    cerrarConexion($conn);

    return $userData;
}
/**
 * Verifies if the entered password matches the stored hashed password.
 * @param string $contrasenaIngresada The entered password.
 * @param string $contrasenaAlmacenada The stored hashed password.
 * @return bool True if the passwords match, false otherwise.
 */
function verificarContrasena($contrasenaIngresada, $contrasenaAlmacenada) {
    // Verificar si la contraseña almacenada está cifrada con password_hash
    if (password_needs_rehash($contrasenaAlmacenada, PASSWORD_DEFAULT)) {
        $contrasenaAlmacenada = password_hash($contrasenaAlmacenada, PASSWORD_DEFAULT);
    }

    return password_verify($contrasenaIngresada, $contrasenaAlmacenada);
}



/**
 * Creates a session for the specified user.
 * @param array $usuario An array containing user data.
 */
function crearSesion($usuario) {
    session_start();
    // Almacenar información en la sesión
    $_SESSION["usuario"] = $usuario["usuario"];
    $_SESSION["horaInicio"] = date("Y-m-d H:i:s");


}
/**
 * Destroys the current session.
 */
function cerrarSesion() {
    session_start();
    session_unset();
    session_destroy();
}
/**
 * Retrieves the preferred background color stored in a cookie.
 * @return string The preferred background color.
 */
function obtenerPreferenciasColor($usuario) {
    return isset($_COOKIE["preferencias_color_" . $usuario]) ? $_COOKIE["preferencias_color_" . $usuario] : "blanco";
}


/**
 * Sets a cookie with the preferred background color.
 * @param string $color The preferred background color to be stored.
 */
function guardarPreferenciasColor($color, $usuario) {
    setcookie("preferencias_color_" . $usuario, $color, time() + (365 * 24 * 60 * 60), "/");
}

/**
 * Saves the color preference in the session.
 *
 * @param string $color The selected color.
 */

/**
 * Deletes the cookie storing the preferred background color.
 */
/**
 * Deletes the cookie storing the preferred background color.
 */
function eliminarPreferenciasColor($usuario) {
    // Delete preference in session
    unset($_SESSION["preferencias_color"]);

    // Delete preference in cookie
    setcookie("preferencias_color_" . $usuario, "", time() - 3600, "/");
}
