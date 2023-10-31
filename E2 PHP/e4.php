<?php
$entrada = array(1, 1, 2, 2, 3, 4, 5, 5);
$salida = array();

foreach ($entrada as $valor) {
    // Comprueba si el valor actual es diferente al anterior
    if (empty($salida) || $valor != end($salida)) {
        $salida[] = $valor; // Agrega el valor unico al array de salida
    }
}

// Imprime el resultado
echo "Entrada: (" . implode(", ", $entrada) . ")<br>";
echo "Salida: (" . implode(", ", $salida) . ")";
?>
