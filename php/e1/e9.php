<?php
// creamos el array de colores
$colores = array("rojo", "verde", "azul", "amarillo");
// rsort para ordenar en reversa
rsort($colores);
// foreach para reocorrer el array y que se imprima
foreach ($colores as $color) {
    echo $color . "<br>";
}
?>