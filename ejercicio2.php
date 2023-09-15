<h2>Ejecicio 2</h2>

<table border="1" cellpadding="0" cellspacing="0" >

<?php




echo "<tr>";

    $N2=7;
    for ($i=65; $i<=90; $i++) {
        $letra = chr($i);  
        echo "<td>$letra</td>\n";
        $N2 = $N2 - 1;
        if ($N2 == 0) {
            break;
        }
    }
    
echo "<tr>";

echo "<tr>";

    $N=7;
    for ($i = 1; $i <= $N; $i++) {
        echo "<td>$i</td>\n";}

echo "<tr>";

?>

</table>