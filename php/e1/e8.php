<?php
// creamos el array de colores
$colores = array("rojo", "verde", "azul", "amarillo");
// sort para ordenar alfabeticamente
sort($colores);
// foreach para reocorrer el array y que se imprima
foreach ($colores as $color) {
    echo $color . "<br>";
}
?>