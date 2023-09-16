<?php

// Funció per inicialitzar un taulell buit
function inicialitzarTaulell($files, $columnes) {
    $taulell = array_fill(0, $files, array_fill(0, $columnes, 0));
    return $taulell;
}

// Funció per mostrar el taulell
function mostrarTaulell($taulell) {
    foreach ($taulell as $fila) {
        echo implode(' ', $fila) . "\n";
    }
}

// Funció per col·locar un vaixell en el taulell
function col·locarVaixell(&$taulell, $fila, $columna, $direccio, $mida) {
    $files = count($taulell);
    $columnes = count($taulell[0]);

    // Comprovar si es pot col·locar el vaixell
    if (
        ($direccio == 'horitzontal' && $columna + $mida > $columnes) ||
        ($direccio == 'vertical' && $fila + $mida > $files)
    ) {
        return false; // No es pot col·locar el vaixell aquí
    }

    // Comprovar si les cel·les estan buides
    for ($i = 0; $i < $mida; $i++) {
        if (
            ($direccio == 'horitzontal' && $taulell[$fila][$columna + $i] != 0) ||
            ($direccio == 'vertical' && $taulell[$fila + $i][$columna] != 0)
        ) {
            return false; // No es pot col·locar el vaixell aquí
        }
    }

    // Col·locar el vaixell
    for ($i = 0; $i < $mida; $i++) {
        if ($direccio == 'horitzontal') {
            $taulell[$fila][$columna + $i] = 1;
        } else {
            $taulell[$fila + $i][$columna] = 1;
        }
    }

    return true; // El vaixell s'ha col·locat amb èxit
}

// Funció per generar una partida aleatòria
function generarPartidaAleatoria() {
    $files = 10;
    $columnes = 10;
    $taulell = inicialitzarTaulell($files, $columnes);

    $vaixells = array(
        'fragata' => 4,
        'submarí' => 3,
        'destructor' => 2,
        'portaavions' => 1
    );

    foreach ($vaixells as $tipus => $quantitat) {
        for ($i = 0; $i < $quantitat; $i++) {
            $fila = rand(0, $files - 1);
            $columna = rand(0, $columnes - 1);
            $direccio = rand(0, 1) == 0 ? 'horitzontal' : 'vertical';

            // Intentar col·locar el vaixell fins que es col·loqui correctament
            while (!col·locarVaixell($taulell, $fila, $columna, $direccio, strlen($tipus))) {
                $fila = rand(0, $files - 1);
                $columna = rand(0, $columnes - 1);
                $direccio = rand(0, 1) == 0 ? 'horitzontal' : 'vertical';
            }
        }
    }

    return $taulell;
}

// Generar una partida aleatòria i mostrar el taulell
$partida = generarPartidaAleatoria();
mostrarTaulell($partida);

?>

