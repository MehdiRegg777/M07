<style type="text/css">
.estilo td {
    font-size: 12px;
    border-width: 1px;
    padding: 8px;
}
</style>

<?php

$filas = 10;
$columnas = 10;
$tablero = array_fill(0, $filas, array_fill(0, $columnas, 0));

// Define la flota con cantidades específicas de cada tipo de barco
$flota = [
    'fragatas' => 4,
    'submarinos' => 3,
    'destructores' => 2,
    'portaaviones' => 1,
];

// Función para colocar un barco en el tablero de manera aleatoria
function colocarBarco(&$tablero, $barco, $filas, $columnas)
{
    $longitud = $barco['longitud'];
    $posicion_vertical = rand(0, 1) === 1; // Aleatoriamente vertical u horizontal

    do {
        $inicio_fila = rand(0, $filas - 1);
        $inicio_columna = rand(0, $columnas - 1);
    } while (!esPosicionValida($tablero, $inicio_fila, $inicio_columna, $longitud, $posicion_vertical));

    if ($posicion_vertical) {
        for ($i = $inicio_fila; $i < $inicio_fila + $longitud; $i++) {
            $tablero[$i][$inicio_columna] = $barco['codigo'];
        }
    } else {
        for ($j = $inicio_columna; $j < $inicio_columna + $longitud; $j++) {
            $tablero[$inicio_fila][$j] = $barco['codigo'];
        }
    }
}

// Función para verificar si una posición es válida para colocar un barco
function esPosicionValida($tablero, $fila, $columna, $longitud, $vertical)
{
    $filas = count($tablero);
    $columnas = count($tablero[0]);

    if ($vertical) {
        if ($fila + $longitud > $filas) {
            return false;
        }

        for ($i = $fila; $i < $fila + $longitud; $i++) {
            if ($tablero[$i][$columna] !== 0) {
                return false;
            }
        }
    } else {
        if ($columna + $longitud > $columnas) {
            return false;
        }

        for ($j = $columna; $j < $columna + $longitud; $j++) {
            if ($tablero[$fila][$j] !== 0) {
                return false;
            }
        }
    }

    return true;
}

// Coloca todos los barcos en el tablero
foreach ($flota as $tipo => $cantidad) {
    for ($i = 0; $i < $cantidad; $i++) {
        $barco = [
            'codigo' => strtoupper(substr($tipo, 0, 1)),
            'longitud' => strlen($tipo),
        ];
        colocarBarco($tablero, $barco, $filas, $columnas);
    }
}

// Muestra el tablero
echo '<table class="estilo" border="1" cellpadding="0" cellspacing="0" >';

for ($i = 0; $i <= $filas; $i++) {
    echo "<tr scope='row' >";
    if ($i == 0) {
        for ($j = 0; $j <= $columnas; $j++) {
            if ($j != 0) {
                echo "<td>$j</td>\n";
            } else {
                echo "<td></td>\n";
            }
        }
    } else {
        if ($i <= $filas) {
            for ($j = 0; $j <= $columnas; $j++) {
                if ($j == 0) {
                    echo "<td>" . chr(($i - 1) + 65) . "</td>";
                } else {
                    if ($tablero[$i - 1][$j - 1] == 1) {
                        echo "<td>X</td>";
                    } else {
                        echo "<td>{$tablero[$i - 1][$j - 1]}</td>";
                    }
                }
            }
        }
    }
    echo "</tr>";
}

echo '</table>';

?>
