<?php
// se crea el array
$estaturas = array(
  "Juan" => 186,
  "Alberto" => 172,
  "Marta" => 173
);

// Se muestra el resultado de Juan
echo "La estatura de Juan es " . $estaturas["Juan"] . " cm. \n";
// Se muestra el resultado de Alberto
echo "La estatura de Alberto es " . $estaturas["Alberto"] . " cm. \n";
echo "<br>";

echo "<br>";
echo "E5 foreach<br>";

// foreach para recorrer el array
foreach ($estaturas as $nombre => $altura) {
    echo "Nombre: $nombre, Estatura: $altura cm<br>";
}
echo "<br>";
echo "E6- ordenado<br>";


arsort($estaturas);

foreach ($estaturas as $nombre => $altura) {
    echo "Persona: $nombre, Altura: $altura cm<br>";
}

echo "<br>";
echo "E7- ordenado al reves<br>";

krsort($estaturas);

foreach ($estaturas as $nombre => $altura) {
    echo "Persona: $nombre, Altura: $altura cm<br>";
}
?>
