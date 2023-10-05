<style type="text/css">
    .estilo td {
        font-size: 12px;
        border-width: 1px;
        padding: 8px;
    }
    .barcos {
        background-color: yellow;
    }
    .oceano {
        background-color: #4ec1d9;
    }
</style>

<?php
$filas = 10;
$columnas = 10;
$tablero = array_fill(0, $filas, array_fill(0, $columnas, 0));

function colocar_barco(&$tablero, $barco, $filas, $columnas)
{
    do {
        $inicio_fila = rand(0, $filas - 1);
        $inicio_columna = rand(0, $columnas - 1);
        $posicion_vertical = rand(0, 1);
    } while (!puede_colocar_barco($tablero, $barco, $inicio_fila, $inicio_columna, $posicion_vertical, $filas, $columnas));

    if ($posicion_vertical) {
        for ($i = $inicio_fila; $i < $inicio_fila + $barco; $i++) {
            $tablero[$i][$inicio_columna] = 1; // Representa el barco como '1'
        }
    } else {
        for ($j = $inicio_columna; $j < $inicio_columna + $barco; $j++) {
            $tablero[$inicio_fila][$j] = 1; // Representa el barco como '1'
        }
    }
}

function puede_colocar_barco($tablero, $barco, $inicio_fila, $inicio_columna, $posicion_vertical, $filas, $columnas)
{
    if ($posicion_vertical) {
        if ($inicio_fila + $barco > $filas) {
            return false;
        }
        for ($i = $inicio_fila; $i < $inicio_fila + $barco; $i++) {
            if ($tablero[$i][$inicio_columna] != 0) {
                return false;
            }
            // Evitar que los barcos se toquen
            if (
                ($i > 0 && $tablero[$i - 1][$inicio_columna] != 0) ||
                ($i < $filas - 1 && $tablero[$i + 1][$inicio_columna] != 0) ||
                ($inicio_columna > 0 && $tablero[$i][$inicio_columna - 1] != 0) ||
                ($inicio_columna < $columnas - 1 && $tablero[$i][$inicio_columna + 1] != 0) ||
                //Verificar en diagonal (EXTRA):
                ($i > 0 && $inicio_columna > 0 && $tablero[$i - 1][$inicio_columna - 1] != 0) || 
                ($i > 0 && $inicio_columna < $columnas - 1 && $tablero[$i - 1][$inicio_columna + 1] != 0) || 
                ($i < $filas - 1 && $inicio_columna > 0 && $tablero[$i + 1][$inicio_columna - 1] != 0) ||
                ($i < $filas - 1 && $inicio_columna < $columnas - 1 && $tablero[$i + 1][$inicio_columna + 1] != 0) 
            ) {
                return false;
            }
        }
    } else {
        if ($inicio_columna + $barco > $columnas) {
            return false;
        }
        for ($j = $inicio_columna; $j < $inicio_columna + $barco; $j++) {
            if ($tablero[$inicio_fila][$j] != 0) {
                return false;
            }
            // Evitar que los barcos se toquen
            if (
                ($j > 0 && $tablero[$inicio_fila][$j - 1] != 0) ||
                ($j < $columnas - 1 && $tablero[$inicio_fila][$j + 1] != 0) ||
                ($inicio_fila > 0 && $tablero[$inicio_fila - 1][$j] != 0) ||
                ($inicio_fila < $filas - 1 && $tablero[$inicio_fila + 1][$j] != 0) ||
                //Verificar en diagonal (EXTRA):
                ($j > 0 && $inicio_fila > 0 && $tablero[$j - 1][$inicio_fila - 1] != 0) || 
                ($j > 0 && $inicio_fila < $filas - 1 && $tablero[$j - 1][$inicio_fila + 1] != 0) || 
                ($j < $columnas - 1 && $inicio_fila > 0 && $tablero[$j + 1][$inicio_fila - 1] != 0) || 
                ($j < $columnas - 1 && $inicio_fila < $filas - 1 && $tablero[$j + 1][$inicio_fila + 1] != 0) 
            ) {
                return false;
            }
        }
    }
    return true;
}

// Crear partida
$barcos = [4, 3, 3, 2, 2, 2, 1, 1, 1, 1];

foreach ($barcos as $barco) {
    colocar_barco($tablero, $barco, $filas, $columnas);
}

echo '<table class="estilo" border="1" cellpadding="0" cellspacing="0">';

for ($i = 0; $i <= $filas; $i++) {
    echo "<tr scope='row'>";
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
                        echo "<td class='barcos'>X</td>";
                    } else {
                        echo "<td class='oceano'></td>";
                    }
                }
            }
        }
    }
    echo "</tr>";
}

echo '</table>';

//print_r($tablero);

?>
