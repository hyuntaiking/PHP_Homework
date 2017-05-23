<?php
$poker = array();
// new poker
$poker = range(0,51);
for ($i = 51; $i >= 0; $i--) {
    $index = rand(0, $i);
    // random swap to $i
    $temp = $poker[$index];
    $poker[$index] = $poker[$i];
    $poker[$i] = $temp;
}
foreach ($poker as $key => $value) {
    // 發牌給四位玩家
    $player[$key%4][] = $value;
}
echo '<table border="1" width="100%">';
foreach ($player as $somebody) {
    sort($somebody);
    echo '<tr>';
    foreach ($somebody as $card) {
        $suit = array('<font color="black" size="5">&spades;</font>',
            '<font color="red" size="5">&hearts;</font>',
            '<font color="black" size="5">&clubs;</font>',
            '<font color="red" size="5">&diams;</font>');
        $value = array('A',1,2,3,4,5,6,7,8,9,10,'J','Q','K');
        echo "<td>{$suit[intval($card/13)]}{$value[$card%13]}</td>";
    }
    echo '</tr>';
}
echo '</table>';
?>