<?php
include 'funciones.inc';

$comerciales = obtenerComerciales();
$productos = obtenerProductos();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = conectar();

    if (isset($_POST['modificar_comercial'])) {
        // Modificación de datos en la tabla Comerciales
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $salario = isset($_POST['salario']) ? $_POST['salario'] : 0;
        $hijos = isset($_POST['hijos']) ? $_POST['hijos'] : 0;
        $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';

        $modificarComercial = $conexion->prepare(
            "UPDATE Comerciales 
            SET nombre = :nombre, salario = :salario, hijos = :hijos, fNacimiento = :fechaNacimiento
            WHERE codigo = :codigo"
        );

        $modificarComercial->bindParam(':codigo', $codigo);
        $modificarComercial->bindParam(':nombre', $nombre);
        $modificarComercial->bindParam(':salario', $salario);
        $modificarComercial->bindParam(':hijos', $hijos);
        $modificarComercial->bindParam(':fechaNacimiento', $fechaNacimiento);

        $modificarComercial->execute();

        // Puedes añadir mensajes de éxito o manejo de errores aquí
    }
      if (isset($_POST['modificar_producto'])) {
        // Modificación de datos en la tabla Productos
        $referencia = $_POST['referencia'];
        $nombreProducto = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $descuento = $_POST['descuento'];

        $modificarProducto = $conexion->prepare(
            "UPDATE Productos
             SET nombre = :nombreProducto, descripcion = :descripcion, precio = :precio, descuento = :descuento
             WHERE referencia = :referencia"
        );

        $modificarProducto->bindParam(':referencia', $referencia);
        $modificarProducto->bindParam(':nombreProducto', $nombreProducto);
        $modificarProducto->bindParam(':descripcion', $descripcion);
        $modificarProducto->bindParam(':precio', $precio);
        $modificarProducto->bindParam(':descuento', $descuento);

        $modificarProducto->execute();
}
if (isset($_POST['modificar_venta'])) {
    // Modificación de datos en la tabla Ventas
    $codComercial = $_POST['codComercial'];
    $refProducto = $_POST['refProducto'];
    $cantidad = $_POST['cantidad'];
    $fechaVenta = $_POST['fechaVenta'];

    $modificarVenta = $conexion->prepare(
        "UPDATE Ventas
         SET cantidad = :cantidad, fecha = :fechaVenta
         WHERE codComercial = :codComercial AND refProducto = :refProducto"
    );

    $modificarVenta->bindParam(':codComercial', $codComercial);
    $modificarVenta->bindParam(':refProducto', $refProducto);
    $modificarVenta->bindParam(':cantidad', $cantidad);
    $modificarVenta->bindParam(':fechaVenta', $fechaVenta);

    $modificarVenta->execute();
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificación de Datos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Modificación de Datos</h1>

    <h2>Modificar Comerciales</h2>
    <form method="post" action="">
        <label for="codigo">Código:</label>
        <select name="codigo">
            <?php foreach ($comerciales as $comercial) : ?>
                <option value="<?php echo $comercial['codigo']; ?>"><?php echo $comercial['codigo']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="nombre">Nuevo Nombre:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="salario">Nuevo Salario:</label>
        <input type="text" name="salario" required>
        <br>

        <label for="hijos">Nuevo Número de hijos:</label>
        <input type="text" name="hijos" required>
        <br>

        <label for="fechaNacimiento">Nueva Fecha de Nacimiento:</label>
        <input type="date" name="fechaNacimiento" required>
        <br>

        <button type="submit" name="modificar_comercial">Modificar Comercial</button>
    </form>

<!-- Después del formulario de modificación de comerciales -->

<h2>Modificar Productos</h2>
<form method="post" action="">
    <label for="referencia">Referencia:</label>
    <select name="referencia">
        <?php foreach ($productos as $producto) : ?>
            <option value="<?php echo $producto['referencia']; ?>"><?php echo $producto['referencia']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="nombreProducto">Nuevo Nombre del Producto:</label>
    <input type="text" name="nombreProducto" required>
    <br>

    <label for="descripcion">Nueva Descripción:</label>
    <input type="text" name="descripcion">
    <br>

    <label for="precio">Nuevo Precio:</label>
    <input type="text" name="precio" required>
    <br>

    <label for="descuento">Nuevo Descuento:</label>
    <input type="text" name="descuento" required>
    <br>

    <button type="submit" name="modificar_producto">Modificar Producto</button>
</form>

<!-- Ahora, agrega el formulario de modificación de ventas -->

<h2>Modificar Ventas</h2>
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

    <label for="cantidad">Nueva Cantidad:</label>
    <input type="text" name="cantidad" required>
    <br>

    <label for="fechaVenta">Nueva Fecha de Venta:</label>
    <input type="date" name="fechaVenta" required>
    <br>

    <button type="submit" name="modificar_venta">Modificar Venta</button>
</form>
<a href=index.php>Volver</a>
</body>
</html>
