<h2>Ejecicio 4</h2>

<style type="text/css">

.estilo td {font-size:12px;border-width: 1px;padding: 8px;}

</style>

<table class="estilo" border="1" cellpadding="0" cellspacing="0" >

<?php

$cont=0;
$M=7;
$N=7;
for ($i = 0; $i <= $M; $i++) {

    echo "<tr scope='row' >";
        if ($j == 0) {
            
            for ($j = $cont; $j <= $N; $j++) {
                if ($j != 0) {
                    echo "<td>$j</td>\n";
                }
                else{
                    echo "<td></td>\n";
                }
            }

        }else{
            if ($i<5){

                for ($j = $cont; $j <= $N; $j++) {
                    if ($j==0){

                        for ($j = 0; $j < $N + 1; $j++) {
                            echo ($j == 0 ? "<td>".chr(($i-1)+65)."</td>" : "<td></td>");
                        }


                    } else {

                        echo "<td></td>\n";
                    }
                }
                
            } 
        }
       

    echo "</tr>";
    
}
?>

</table>





