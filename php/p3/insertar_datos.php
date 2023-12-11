<?php
include 'funciones.inc';

$comerciales = obtenerComerciales();
$productos = obtenerProductos();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = conectar();

    if (isset($_POST['insertar_comercial'])) {
        // Inserción de datos en la tabla Comerciales
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $salario = isset($_POST['salario']) ? $_POST['salario'] : 0;
        $hijos = isset($_POST['hijos']) ? $_POST['hijos'] : 0;
        $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';

        // Validación de campos obligatorios
        if (empty($codigo) || empty($nombre)) {
            // Manejar el error, redirigir o mostrar un mensaje al usuario
            echo "El código y el nombre no pueden estar vacíos.";
        } else {
            $insertarComercial = $conexion->prepare(
                "INSERT INTO Comerciales (codigo, nombre, salario, hijos, fNacimiento)
                VALUES (:codigo, :nombre, :salario, :hijos, :fechaNacimiento)"
            );

            $insertarComercial->bindParam(':codigo', $codigo);
            $insertarComercial->bindParam(':nombre', $nombre);
            $insertarComercial->bindParam(':salario', $salario);
            $insertarComercial->bindParam(':hijos', $hijos);
            $insertarComercial->bindParam(':fechaNacimiento', $fechaNacimiento);

            $insertarComercial->execute();

            // Puedes añadir mensajes de éxito o manejo de errores aquí
        }
    }

    if (isset($_POST['insertar_producto'])) {
        // Inserción de datos en la tabla Productos
        $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
        $nombreProducto = isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : 0;
        $descuento = isset($_POST['descuento']) ? $_POST['descuento'] : 0;

        // Validación de campos obligatorios
        if (empty($referencia) || empty($nombreProducto)) {
            // Manejar el error, redirigir o mostrar un mensaje al usuario
            echo "La referencia y el nombre del producto no pueden estar vacíos.";
        } else {
            $insertarProducto = $conexion->prepare(
                "INSERT INTO Productos (referencia, nombre, descripcion, precio, descuento)
                VALUES (:referencia, :nombre, :descripcion, :precio, :descuento)"
            );

            $insertarProducto->bindParam(':referencia', $referencia);
            $insertarProducto->bindParam(':nombre', $nombreProducto);
            $insertarProducto->bindParam(':descripcion', $descripcion);
            $insertarProducto->bindParam(':precio', $precio);
            $insertarProducto->bindParam(':descuento', $descuento);

            $insertarProducto->execute();

            // Puedes añadir mensajes de éxito o manejo de errores aquí
        }
    }

    if (isset($_POST['insertar_venta'])) {
        // Inserción de datos en la tabla Ventas
        $codComercial = isset($_POST['codComercial']) ? $_POST['codComercial'] : '';
        $refProducto = isset($_POST['refProducto']) ? $_POST['refProducto'] : '';
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $fechaVenta = isset($_POST['fechaVenta']) ? $_POST['fechaVenta'] : '';

        // Validación de campos obligatorios
        if (empty($codComercial) || empty($refProducto)) {
            // Manejar el error, redirigir o mostrar un mensaje al usuario
            echo "El código del comercial y la referencia del producto no pueden estar vacíos.";
        } else {
            $insertarVenta = $conexion->prepare(
                "INSERT INTO Ventas (codComercial, refProducto, cantidad, fecha)
                VALUES (:codComercial, :refProducto, :cantidad, :fechaVenta)"
            );

            $insertarVenta->bindParam(':codComercial', $codComercial);
            $insertarVenta->bindParam(':refProducto', $refProducto);
            $insertarVenta->bindParam(':cantidad', $cantidad);
            $insertarVenta->bindParam(':fechaVenta', $fechaVenta);

            $insertarVenta->execute();

            // Puedes añadir mensajes de éxito o manejo de errores aquí
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inserción de Datos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Inserción de Datos</h1>

    <h2>Inserción de Comerciales</h2>
    <form method="post" action="">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" required>
        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="salario">Salario:</label>
        <input type="text" name="salario" required>
        <br>

        <label for="hijos">Número de hijos:</label>
        <input type="text" name="hijos" required>
        <br>

        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fechaNacimiento" required>
        <br>

        <button type="submit" name="insertar_comercial">Insertar Comercial</button>
    </form>

    <h2>Inserción de Productos</h2>
    <form method="post" action="">
        <!-- Agrega aquí campos para la inserción de productos -->
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" required>
        <br>

        <label for="nombreProducto">Nombre del Producto:</label>
        <input type="text" name="nombreProducto" required>
        <br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion">
        <br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" required>
        <br>

        <label for="descuento">Descuento:</label>
        <input type="text" name="descuento" required>
        <br>

        <button type="submit" name="insertar_producto">Insertar Producto</button>
    </form>

    <h2>Inserción de Ventas</h2>
    <form method="post" action="">
        <!-- Agrega aquí campos para la inserción de ventas -->
        <label for="codComercial">Código del Comercial:</label>
        <input type="text" name="codComercial" required>
        <br>

        <label for="refProducto">Referencia del Producto:</label>
        <input type="text" name="refProducto" required>
        <br>

        <label for="cantidad">Cantidad:</label>
        <input type="text" name="cantidad" required>
        <br>

        <label for="fechaVenta">Fecha de Venta:</label>
        <input type="date" name="fechaVenta" required>
        <br>

        <button type="submit" name="insertar_venta">Insertar Venta</button>
    </form>
    <a href=index.php>Volver</a>
</body>
</html>
