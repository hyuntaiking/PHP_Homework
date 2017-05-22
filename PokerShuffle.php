<?php
$poker = array();
for ($i = 0; $i < 52; $i++) {
    $poker[] = $i;
}
for ($i = 51; $i >= 0; $i--) {
    $index = rand(0, $i);
    //swap
    if ($i == $index) continue;
    $poker[$i] ^= $poker[$index];
    $poker[$index] ^= $poker[$i];
    $poker[$i] ^= $poker[$index];
}
for ($i = 0; $i < 52; $i++) {
    echo "{$poker[$i]}<br>";
}