<style type="text/css">

.estilo td {font-size:12px;border-width: 1px;padding: 8px;}

</style>

<?php

$filas = 10;
$columnas = 10;
$tablero = array_fill(0, $filas, array_fill(0, $columnas, 0));

$inicio_fila = rand(0, $filas - 1);
$inicio_columna = rand(0, $columnas - 1);
$posicion_vertical = true; // Cambia a false para posición horizontal
$longitud_submarino = 4; // Longitud del submarí

if ($posicion_vertical) {
    if ($inicio_fila + $longitud_submarino <= $filas) {
        $puede_colocar = true;
        for ($i = $inicio_fila; $i < $inicio_fila + $longitud_submarino; $i++) {
            if ($tablero[$i][$inicio_columna] != 0) {
                $puede_colocar = false;
                break;
            }
        }
    } else {
        $puede_colocar = false;
    }
} else {
    if ($inicio_columna + $longitud_submarino <= $columnas) {
        $puede_colocar = true;
        for ($j = $inicio_columna; $j < $inicio_columna + $longitud_submarino; $j++) {
            if ($tablero[$inicio_fila][$j] != 0) {
                $puede_colocar = false;
                break;
            }
        }
    } else {
        $puede_colocar = false;
    }
}

if ($puede_colocar) {
    if ($posicion_vertical) {
        for ($i = $inicio_fila; $i < $inicio_fila + $longitud_submarino; $i++) {
            $tablero[$i][$inicio_columna] = 1; // Representa el submarí como '1'
        }
    } else {
        for ($j = $inicio_columna; $j < $inicio_columna + $longitud_submarino; $j++) {
            $tablero[$inicio_fila][$j] = 1; // Representa el submarí como '1'
        }
    }
}

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
                        echo "<td></td>";
                    }
                }
            }
        }
    }
    echo "</tr>";
}

echo '</table>';

?>
