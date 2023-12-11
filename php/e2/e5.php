<?php
$number = 12345;
$digitSum = 0;

while ($number > 0) {
    $digit = $number % 10;  // Consigue el ultimo numero
    $digitSum += $digit;    // Añade el digito a la suma
    $number = (int)($number / 10);  // Quita el ultimo digito
}

echo "La suma de los digitos es: $digitSum";
?>
