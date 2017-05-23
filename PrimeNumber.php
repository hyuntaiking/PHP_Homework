<?php
$maxNum = 100;
$col = 10;
echo '<table border="1" width="100%">';
for ($i=1; $i<=$maxNum; $i++) {
    if ($i % $col == 1) echo '<tr>';
    if (isPrimeNumber($i)) {
        echo "<td bgcolor='yellow'>{$i}</td>";
    } else {
        echo "<td>{$i}</td>";
    }

    if ($i % $col == 0) echo '</tr>';
}
echo '</table>';

function isPrimeNumber($number) {
    if ($number%2) {
        return true;
    } else {
        return false;
    }
}

