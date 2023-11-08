<?php
// Incluye el archivo de conexión a la base de datos (db.php)
include('../db.php');

// Mensajes de estado
$mensaje = '';
$error = '';

// Modificación de datos de la tabla Comerciales
if (isset($_POST['modificar_comercial'])) {
    $codigo_comercial = $_POST['codigo_comercial'];
    $nuevo_salario = $_POST['nuevo_salario'];

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($codigo_comercial) && !empty($nuevo_salario)) {
        $sql = "UPDATE Comerciales SET salario = :nuevo_salario WHERE codigo = :codigo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nuevo_salario', $nuevo_salario, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo_comercial, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $mensaje = 'Los datos del comercial se han modificado correctamente.';
        } else {
            $error = 'Error al modificar los datos del comercial: ' . implode(" ", $stmt->errorInfo());
        }
    } else {
        $error = 'Por favor, ingresa el código del comercial y el nuevo salario.';
    }
}

// Modificación de datos de la tabla Productos
if (isset($_POST['modificar_producto'])) {
    $referencia_producto = $_POST['referencia_producto'];
    $nuevo_precio = $_POST['nuevo_precio'];

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($referencia_producto) && !empty($nuevo_precio)) {
        $sql = "UPDATE Productos SET precio = :nuevo_precio WHERE referencia = :referencia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nuevo_precio', $nuevo_precio, PDO::PARAM_STR);
        $stmt->bindParam(':referencia', $referencia_producto, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $mensaje = 'Los datos del producto se han modificado correctamente.';
        } else {
            $error = 'Error al modificar los datos del producto: ' . implode(" ", $stmt->errorInfo());
        }
    } else {
        $error = 'Por favor, ingresa la referencia del producto y el nuevo precio.';
    }
}

// Modificación de datos de la tabla Ventas
if (isset($_POST['modificar_venta'])) {
    $fecha_venta = $_POST['fecha_venta'];
    $nueva_cantidad = $_POST['nueva_cantidad'];

    // Validación de datos (puedes agregar más validaciones según tus necesidades)
    if (!empty($fecha_venta) && !empty($nueva_cantidad)) {
        $sql = "UPDATE Ventas SET cantidad = :nueva_cantidad WHERE fecha = :fecha_venta";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nueva_cantidad', $nueva_cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_venta', $fecha_venta, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $mensaje = 'Los datos de la venta se han modificado correctamente.';
        } else {
            $error = 'Error al modificar los datos de la venta: ' . implode(" ", $stmt->errorInfo());
        }
    } else {
        $error = 'Por favor, ingresa la fecha de la venta y la nueva cantidad.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificación de Datos</title>
    <link rel="stylesheet" type="text/css" href="../Style/modificacion_datos.css">
</head>
<body>
    <h1>Modificación de Datos</h1>

    <!-- Muestra mensajes de estado (éxito o error) -->
    <?php
    if (!empty($mensaje)) {
        echo "<div style='color: green;'>$mensaje</div>";
    }
    if (!empty($error)) {
        echo "<div style='color: red;'>$error</div>";
    }
    ?>

    <!-- Formulario de modificación de comerciales -->
    <h2>Modificar Comercial</h2>
    <form action="modificacion_datos.php" method="POST">
        <input type="hidden" name="modificar_comercial" value="1">
        <label for="codigo_comercial">Código del Comercial:</label>
        <input type="text" name="codigo_comercial" id="codigo_comercial"><br>
        <label for="nuevo_salario">Nuevo Salario:</label>
        <input type="text" name="nuevo_salario" id="nuevo_salario"><br>
        <input type="submit" value="Modificar Comercial">
    </form>

    <!-- Formulario de modificación de productos -->
    <h2>Modificar Producto</h2>
    <form action="modificacion_datos.php" method="POST">
        <input type="hidden" name="modificar_producto" value="1">
        <label for="referencia_producto">Referencia del Producto:</label>
        <input type="text" name="referencia_producto" id="referencia_producto"><br>
        <label for="nuevo_precio">Nuevo Precio:</label>
        <input type="text" name="nuevo_precio" id="nuevo_precio"><br>
        <input type="submit" value="Modificar Producto">
    </form>

    <!-- Formulario de modificación de ventas -->
    <h2>Modificar Venta</h2>
    <form action="modificacion_datos.php" method="POST">
        <input type="hidden" name="modificar_venta" value="1">
        <label for="fecha_venta">Fecha de la Venta:</label>
        <input type="text" name="fecha_venta" id="fecha_venta"><br>
        <label for="nueva_cantidad">Nueva Cantidad:</label>
        <input type="text" name="nueva_cantidad" id="nueva_cantidad"><br>
        <input type="submit" value="Modificar Venta">
    </form>
</body>
</html>
