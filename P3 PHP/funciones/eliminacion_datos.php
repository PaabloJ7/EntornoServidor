<?php
// Incluye el archivo de conexión a la base de datos (db.php)
include('../db.php');

// Mensajes de estado
$mensaje = '';
$error = '';

// Eliminación de datos de la tabla Comerciales
if (isset($_POST['eliminar_comercial'])) {
    $codigo_comercial = $_POST['codigo_comercial'];

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($codigo_comercial)) {
        // Identificar y eliminar ventas relacionadas
        $sql_delete_ventas = "DELETE FROM Ventas WHERE codComercial = :codigo";
        $stmt_delete_ventas = $conn->prepare($sql_delete_ventas);
        $stmt_delete_ventas->bindParam(':codigo', $codigo_comercial, PDO::PARAM_STR);

        if ($stmt_delete_ventas->execute()) {
            // Ahora que las ventas relacionadas han sido eliminadas, puedes eliminar el comercial
            $sql = "DELETE FROM Comerciales WHERE codigo = :codigo";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':codigo', $codigo_comercial, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $mensaje = 'El comercial se ha eliminado correctamente.';
            } else {
                $error = 'Error al eliminar el comercial: ' . implode(" ", $stmt->errorInfo());
            }
        } else {
            $error = 'Error al eliminar las ventas relacionadas con el comercial: ' . implode(" ", $stmt_delete_ventas->errorInfo());
        }
    } else {
        $error = 'Por favor, selecciona un comercial para eliminar.';
    }
}



// Eliminación de datos de la tabla Productos
if (isset($_POST['eliminar_producto'])) {
    $referencia_producto = $_POST['referencia_producto'];

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($referencia_producto)) {
        // Identificar y eliminar ventas relacionadas
        $sql_delete_ventas = "DELETE FROM Ventas WHERE refProducto = :referencia";
        $stmt_delete_ventas = $conn->prepare($sql_delete_ventas);
        $stmt_delete_ventas->bindParam(':referencia', $referencia_producto, PDO::PARAM_STR);

        if ($stmt_delete_ventas->execute()) {
            // Ahora que las ventas relacionadas han sido eliminadas, puedes eliminar el producto
            $sql = "DELETE FROM Productos WHERE referencia = :referencia";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':referencia', $referencia_producto, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $mensaje = 'El producto se ha eliminado correctamente.';
            } else {
                $error = 'Error al eliminar el producto: ' . implode(" ", $stmt->errorInfo());
            }
        } else {
            $error = 'Error al eliminar las ventas relacionadas con el producto: ' . implode(" ", $stmt_delete_ventas->errorInfo());
        }
    } else {
        $error = 'Por favor, selecciona un producto para eliminar.';
    }
}


// Eliminación de datos de la tabla Ventas
if (isset($_POST['eliminar_venta'])) {
    $id_venta = $_POST['id_venta'];

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($id_venta)) {
        $sql = "DELETE FROM Ventas WHERE id = :id_venta";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $mensaje = 'La venta se ha eliminado correctamente.';
        } else {
            $error = 'Error al eliminar la venta: ' . implode(" ", $stmt->errorInfo());
        }
    } else {
        $error = 'Por favor, selecciona una venta para eliminar.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminación de Datos</title>
    <link rel="stylesheet" type="text/css" href="../Style/eliminacion_datos.css">
</head>
<body>
    <h1>Eliminación de Datos</h1>

    <!-- Muestra mensajes de estado (éxito o error) -->
    <?php
    if (!empty($mensaje)) {
        echo "<div style='color: green;'>$mensaje</div>";
    }
    if (!empty($error)) {
        echo "<div style='color: red;'>$error</div>";
    }
    ?>

    <!-- Formulario de eliminación de comerciales -->
    <h2>Eliminar Comercial</h2>
    <form action="eliminacion_datos.php" method="POST">
        <input type="hidden" name="eliminar_comercial" value="1">
        <label for="codigo_comercial">Código del Comercial:</label>
        <input type="text" name="codigo_comercial" id="codigo_comercial"><br>
        <input type="submit" value="Eliminar Comercial">
    </form>

    <!-- Formulario de eliminación de productos -->
    <h2>Eliminar Producto</h2>
    <form action="eliminacion_datos.php" method="POST">
        <input type="hidden" name="eliminar_producto" value="1">
        <label for="referencia_producto">Referencia del Producto:</label>
        <input type="text" name="referencia_producto" id="referencia_producto"><br>
        <input type="submit" value="Eliminar Producto">
    </form>

    <!-- Formulario de eliminación de ventas -->
    <h2>Eliminar Venta</h2>
    <form action="eliminacion_datos.php" method="POST">
        <input type="hidden" name="eliminar_venta" value="1">
        <label for="id_venta">ID de la Venta:</label>
        <input type="text" name="id_venta" id="id_venta"><br>
        <input type="submit" value="Eliminar Venta">
    </form>

    <h2>No hay id de venta ni nada que lo identifique, lo borro por fecha????</h2>
</body>
</html>
