<?php
$array = array();
for ($k = 1; $k < $argc; $k++) {
    $word = trim($argv[$k]);
    $word = preg_replace('/  +/', " ", $word);
    $holder = explode(" ", $word);
    for ($i = 0; $i < count($holder); $i++) {
        array_push($array, $holder[$i]);
    }
}
sort($array);
for ($j = 0; $j < count($array); $j++) {
    echo "$array[$j]\n";
}
?>