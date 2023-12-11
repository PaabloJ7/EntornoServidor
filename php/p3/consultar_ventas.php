<?php
include 'funciones.inc';

$comerciales = obtenerComerciales();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comercialSeleccionado = $_POST['comercial'];

    $conexion = conectar();
    $consultaVentas = $conexion->prepare(
        "SELECT v.fecha, p.nombre AS producto, v.cantidad
         FROM Ventas v
         JOIN Productos p ON v.refProducto = p.referencia
         WHERE v.codComercial = :comercial"
    );

    $consultaVentas->bindParam(':comercial', $comercialSeleccionado);
    $consultaVentas->execute();
    $ventas = $consultaVentas->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Ventas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Consulta de Ventas</h1>

    <form method="post" action="">
        <label for="comercial">Seleccione un comercial:</label>
        <select name="comercial" id="comercial">
            <?php foreach ($comerciales as $comercial): ?>
                <option value="<?= $comercial['codigo'] ?>"><?= $comercial['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Consultar Ventas</button>
    </form>

    <?php if (isset($ventas)): ?>
        <h2>Ventas del Comercial</h2>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= $venta['fecha'] ?></td>
                        <td><?= $venta['producto'] ?></td>
                        <td><?= $venta['cantidad'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href=index.php>Volver</a>
</body>
</html>
