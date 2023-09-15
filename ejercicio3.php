<h2>Ejecicio 3</h2>

<table border="1" cellpadding="0" cellspacing="0" >

<?php

$cont=0;
$M=7;
$N=7;
for ($i = 0; $i <= $M; $i++) {

    echo "<tr>";
        
        for ($j = $cont; $j <= $N; $j++) {
            echo "<td>$j</td>\n";
        }
        $N=$N+1;

    echo "</tr>";
    $cont = $cont + 1;
}
?>

</table>