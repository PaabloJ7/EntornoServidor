<?php
// Función para resolver ecuaciones de segundo grado
function resolverEcuacionSegundoGrado($a, $b, $c) {
    // Calcula el discriminante
    $discriminante = ($b * $b) - (4 * $a * $c);

    // Comprueba el valor del discriminante
    if ($discriminante > 0) {
        // Dos soluciones reales
        $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
        $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
        return array($x1, $x2);
    } elseif ($discriminante == 0) {
        // Una solución real (raíz doble)
        $x1 = -$b / (2 * $a);
        return array($x1);
    } else {
        // No hay soluciones reales
        return false;
    }
}

// Funcion para mostrar las soluciones
function mostrarSoluciones($soluciones) {
    if ($soluciones === false) {
        echo "La ecuación no tiene soluciones reales.";
    } else {
        echo "Las soluciones son:<br>";
        foreach ($soluciones as $solucion) {
            echo "x = $solucion<br>";
        }
    }
}

// Coeficientes de la ecuación
$a = 1;
$b = -3;
$c = 2;

// Llama a la funcion para resolver la ecuación
$soluciones = resolverEcuacionSegundoGrado($a, $b, $c);

// Llama a la funcion para mostrar las soluciones
mostrarSoluciones($soluciones);
?>

