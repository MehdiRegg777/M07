<h2>Batalla Naval</h2>

<style type="text/css">

.estilo td {font-size:12px;border-width: 1px;padding: 8px;}

</style>

<table class="estilo" border="1" cellpadding="0" cellspacing="0" >

<?php

$cont=0;
$M=10;
$N=10;
for ($i = 0; $i <= $M-1; $i++) {

    echo "<tr>";
        
        for ($j = $cont; $j <= $N-1; $j++) {

            echo "<td>X</td>\n";
        }


    echo "</tr>";

}
?>

</table>