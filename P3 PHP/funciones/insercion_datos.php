<?php
// Incluye el archivo de conexión a la base de datos (db.php)
include('../db.php');

// Inicializa variables para los campos de la venta
$comercial_id = '';
$producto_referencia = '';
$cantidad = '';
$fecha = '';

// Mensajes de estado
$mensaje = '';
$error = '';

// Verifica si se ha enviado el formulario de inserción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $comercial_id = $_POST['comercial_id'];
    $producto_referencia = $_POST['producto_referencia'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];

    // Valida los datos (puedes agregar más validaciones según tus necesidades)
    if (empty($comercial_id) || empty($producto_referencia) || empty($cantidad) || empty($fecha)) {
        $error = 'Todos los campos son obligatorios.';
    } else {
        // Realiza la inserción en la base de datos
        $sql = "INSERT INTO Ventas (codComercial, refProducto, cantidad, fecha) VALUES (:comercial_id, :producto_referencia, :cantidad, :fecha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':comercial_id', $comercial_id, PDO::PARAM_STR);
        $stmt->bindParam(':producto_referencia', $producto_referencia, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $mensaje = 'La venta se ha insertado correctamente.';
        } else {
            $error = 'Error al insertar la venta: ' . implode(" ", $stmt->errorInfo());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inserción de Ventas</title>
    <link rel="stylesheet" type="text/css" href="../Style/insercion_datos.css">
</head>
<body>
    <h1>Inserción de Ventas</h1>

    <!-- Muestra mensajes de estado (éxito o error) -->
    <?php
    if (!empty($mensaje)) {
        echo "<div style='color: green;'>$mensaje</div>";
    }
    if (!empty($error)) {
        echo "<div style='color: red;'>$error</div>";
    }
    ?>

    <!-- Formulario de inserción de ventas -->
    <form action="insercion_datos.php" method="POST">
        <label for="comercial_id">Comercial ID:</label>
        <input type="text" name="comercial_id" id="comercial_id" value="<?php echo $comercial_id; ?>"><br>

        <label for="producto_referencia">Referencia del Producto:</label>
        <input type="text" name="producto_referencia" id="producto_referencia" value="<?php echo $producto_referencia; ?>"><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>"><br>

        <label for="fecha">Fecha (YYYY-MM-DD):</label>
        <input type="text" name="fecha" id="fecha" value="<?php echo $fecha; ?>"><br>


        <input type="submit" value="Insertar Venta">
    </form>
    <h2>HAY que añadir insertar en las otras tablas</h2>

    
</body>
</html>
