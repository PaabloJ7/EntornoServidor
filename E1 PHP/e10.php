<?php
$cadena = "Esto es un string de varias palabras";

// strlen para saber el numero de caracteres
$numeroCaracteres = strlen($cadena);

// str_word_count para saber el numero de palabras
$numeroPalabras = str_word_count($cadena);

// strtoupper para que devuelta la frase en mayuscula
$mayusculas = strtoupper($cadena);

echo "Numero de caracteres en la cadena: $numeroCaracteres<br>";
echo "Numero de palabras en la cadena: $numeroPalabras<br>";
echo "Cadena en mayusculas: $mayusculas";
?>