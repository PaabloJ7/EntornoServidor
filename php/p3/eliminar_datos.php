<?php
include 'funciones.inc';

$comerciales = obtenerComerciales();
$productos = obtenerProductos();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = conectar();

    if (isset($_POST['eliminar_comercial'])) {
        // Eliminación de datos en la tabla Comerciales
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

        // Antes de eliminar el comercial, también eliminamos las ventas asociadas
        $eliminarVentas = $conexion->prepare("DELETE FROM Ventas WHERE codComercial = :codigo");
        $eliminarVentas->bindParam(':codigo', $codigo);
        $eliminarVentas->execute();

        $eliminarComercial = $conexion->prepare("DELETE FROM Comerciales WHERE codigo = :codigo");
        $eliminarComercial->bindParam(':codigo', $codigo);
        $eliminarComercial->execute();

        // Puedes añadir mensajes de éxito o manejo de errores aquí
    }

    if (isset($_POST['eliminar_producto'])) {
        // Eliminación de datos en la tabla Productos
        $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';

        // Antes de eliminar el producto, también eliminamos las ventas asociadas
        $eliminarVentas = $conexion->prepare("DELETE FROM Ventas WHERE refProducto = :referencia");
        $eliminarVentas->bindParam(':referencia', $referencia);
        $eliminarVentas->execute();

        $eliminarProducto = $conexion->prepare("DELETE FROM Productos WHERE referencia = :referencia");
        $eliminarProducto->bindParam(':referencia', $referencia);
        $eliminarProducto->execute();

        // Puedes añadir mensajes de éxito o manejo de errores aquí
    }

    if (isset($_POST['eliminar_venta'])) {
        // Eliminación de datos en la tabla Ventas
        $codComercial = isset($_POST['codComercial']) ? $_POST['codComercial'] : '';
        $refProducto = isset($_POST['refProducto']) ? $_POST['refProducto'] : '';
        $fechaVenta = isset($_POST['fechaVenta']) ? $_POST['fechaVenta'] : '';

        $eliminarVenta = $conexion->prepare(
            "DELETE FROM Ventas
            WHERE codComercial = :codComercial AND refProducto = :refProducto AND fecha = :fechaVenta"
        );

        $eliminarVenta->bindParam(':codComercial', $codComercial);
        $eliminarVenta->bindParam(':refProducto', $refProducto);
        $eliminarVenta->bindParam(':fechaVenta', $fechaVenta);
        $eliminarVenta->execute();

        // Puedes añadir mensajes de éxito o manejo de errores aquí
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminación de Datos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Eliminación de Datos</h1>

    <h2>Eliminar Comerciales</h2>
    <form method="post" action="">
        <label for="codigo">Código:</label>
        <select name="codigo">
            <?php foreach ($comerciales as $comercial) : ?>
                <option value="<?php echo $comercial['codigo']; ?>"><?php echo $comercial['codigo']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <button type="submit" name="eliminar_comercial">Eliminar Comercial</button>
    </form>

    <!-- Después del formulario de eliminación de comerciales -->

    <h2>Eliminar Productos</h2>
    <form method="post" action="">
        <label for="referencia">Referencia:</label>
        <select name="referencia">
            <?php foreach ($productos as $producto) : ?>
                <option value="<?php echo $producto['referencia']; ?>"><?php echo $producto['referencia']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <button type="submit" name="eliminar_producto">Eliminar Producto</button>
    </form>

    <!-- Ahora, agrega el formulario de eliminación de ventas -->

    <h2>Eliminar Ventas</h2>
    <form method="post" action="">
        <label for="codComercial">Código del Comercial:</label>
        <select name="codComercial">
            <?php foreach ($comerciales as $comercial) : ?>
                <option value="<?php echo $comercial['codigo']; ?>"><?php echo $comercial['codigo']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="refProducto">Referencia del Producto:</label>
        <select name="refProducto">
            <?php foreach ($productos as $producto) : ?>
                <option value="<?php echo $producto['referencia']; ?>"><?php echo $producto['referencia']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="fechaVenta">Fecha de Venta:</label>
        <input type="date" name="fechaVenta" required>
        <br>

        <button type="submit" name="eliminar_venta">Eliminar Venta</button>
    </form>
    <a href=index.php>Volver</a>
</body>
</html>
