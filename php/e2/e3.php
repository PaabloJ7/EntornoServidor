<?php
// se hace la funcion para saber que numeros son primos
function esPrimo($number) {
    if ($number <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}
// se hace el calculo
$sum = 0;
for ($i = 2; $i < 100; $i++) {
    if (esPrimo($i)) {
        $sum += $i;
    }
}

echo "La suma de los numeros primos por debajo de 100 es: $sum";
?>
