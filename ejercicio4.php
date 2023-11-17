<h2>Ejecicio 4</h2>

<style type="text/css">

.estilo td {font-size:12px;border-width: 1px;padding: 8px;}

</style>

<table class="estilo" border="1" cellpadding="0" cellspacing="0" >

<?php

$cont = 0;
$M = 7;
$N = 7;

echo "<table class='estilo' border='1' cellpadding='0' cellspacing='0'>";

for ($i = 0; $i <= $M; $i++) {
    echo "<tr scope='row'>";

    if ($i == 0) {
        for ($j = $cont; $j <= $N; $j++) {
            if ($j != 0) {
                echo "<td>$j</td>\n";
            } else {
                echo "<td></td>\n";
            }
        }
    } else {
        if ($i < 5) {
            for ($j = $cont; $j <= $N; $j++) {
                if ($j == 0) {
                    echo "<td>" . chr(($i - 1) + 65) . "</td>";
                } else {
                    echo "<td></td>";
                }
            }
        }
    }

    echo "</tr>";
}

echo "</table>";

?>


</table>





