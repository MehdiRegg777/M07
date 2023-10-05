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
session_start();

$filas = 10;
$columnas = 10;

if (!isset($_SESSION['tablero'])) {
    // Si no existe el tablero en la sesión, crea uno nuevo
    $tablero = array_fill(0, $filas, array_fill(0, $columnas, 'oceano'));
    $_SESSION['tablero'] = $tablero;
} else {
    // Si ya existe el tablero en la sesión, obtén el estado actual
    $tablero = $_SESSION['tablero'];
}

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

function pintar_casilla(&$tablero, $fila, $columna, $resultado)
{
    if ($resultado == 1) {
        // Si acierta un barco, pinta la celda de amarillo
        $tablero[$fila][$columna] = 'barcos';
    } else {
        // Si no acierta, pinta la celda de azul con 0
        $tablero[$fila][$columna] = 'oceano';
    }
}

if (isset($_POST['fila']) && isset($_POST['columna'])) {
    // Si el jugador ha seleccionado una celda, verifica si acierta un barco
    $fila_seleccionada = $_POST['fila'];
    $columna_seleccionada = $_POST['columna'];
    $resultado = $tablero[$fila_seleccionada][$columna_seleccionada];

    // Actualiza el tablero con el resultado
    pintar_casilla($tablero, $fila_seleccionada, $columna_seleccionada, $resultado);
}

// Crear partida o cargar partida existente
if (!isset($_SESSION['barcos'])) {
    $barcos = [4, 3, 3, 2, 2, 2, 1, 1, 1, 1];
    $_SESSION['barcos'] = $barcos;
} else {
    $barcos = $_SESSION['barcos'];
}

foreach ($barcos as $barco) {
    colocar_barco($tablero, $barco, $filas, $columnas);
}

$_SESSION['tablero'] = $tablero;

// Mostrar el tablero actualizado
echo '<form method="post">';
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
                    $estado_casilla = $tablero[$i - 1][$j - 1];
                    echo "<td class='$estado_casilla'>";
                    if ($estado_casilla == 'barcos') {
                        echo 'X';
                    } else {
                        echo '0';
                    }
                    echo "</td>";
                }
            }
        }
    }
    echo "</tr>";
}

echo '</table>';
echo '<input type="hidden" name="fila" value="-1">'; // Valor inicial para fila
echo '<input type="hidden" name="columna" value="-1">'; // Valor inicial para columna
echo '</form>';
?>

