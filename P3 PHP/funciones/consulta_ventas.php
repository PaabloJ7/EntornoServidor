<?php
// Incluye el archivo de conexión a la base de datos (db.php)
include('../db.php');

// Verifica si se ha seleccionado un comercial (puedes hacerlo a través de un formulario o un parámetro GET en la URL)
if (isset($_GET['comercial_id'])) {
    // Obtén el ID del comercial seleccionado
    $comercial_id = $_GET['comercial_id'];

    // Consulta para obtener todas las ventas de un comercial específico
    $sql = "SELECT c.nombre AS nombre_comercial, p.nombre AS nombre_producto, v.cantidad, v.fecha
            FROM Ventas v
            INNER JOIN Comerciales c ON v.codComercial = c.codigo
            INNER JOIN Productos p ON v.refProducto = p.referencia
            WHERE v.codComercial = :comercial_id";

    // Prepara la consulta
    $stmt = $conn->prepare($sql);

    // Vincula el valor del ID del comercial
    $stmt->bindParam(':comercial_id', $comercial_id, PDO::PARAM_STR);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene los resultados de la consulta
    $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Por favor, selecciona un comercial para ver sus ventas.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Ventas</title>
    <link rel="stylesheet" type="text/css" href="../Style/consulta_ventas.css">

</head>
<body>
    <h1>Consulta de Ventas por Comercial</h1>

    <!-- Agrega un formulario para seleccionar un comercial -->
    <form action="consulta_ventas.php" method="GET">
        <label for="comercial_id">Selecciona un comercial:</label>
        <select name="comercial_id" id="comercial_id">
            <?php
            // Genera opciones de comerciales desde la base de datos
            $sql_comerciales = "SELECT codigo, nombre FROM Comerciales";
            $stmt_comerciales = $conn->query($sql_comerciales);
            while ($row = $stmt_comerciales->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Consultar Ventas">
    </form>

    <?php
    // Si se ha seleccionado un comercial, muestra las ventas
    if (isset($ventas)) {
        echo "<h2>Ventas de " . $ventas[0]['nombre_comercial'] . "</h2>";
        if (count($ventas) > 0) {
            echo "<table>";
            echo "<tr><th>Producto</th><th>Cantidad</th><th>Fecha</th></tr>";
            foreach ($ventas as $venta) {
                echo "<tr>";
                echo "<td>" . $venta['nombre_producto'] . "</td>";
                echo "<td>" . $venta['cantidad'] . "</td>";
                echo "<td>" . $venta['fecha'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron ventas para este comercial.";
        }
    }
    ?>

</body>
</html>
