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
function comp($a, $b) {
    $an = strtolower($a);
    $bn = strtolower($b);
    $i = 0;
    $lena = strlen($an);
    $lenb = strlen($bn);
    $index = "abcdefghijklmnopqrstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
    while ($i < $lena && $i < $lenb) {
        $posofa = strpos($index, $an[$i]);
        $posofb = strpos($index, $bn[$i]);
        if ($posofa < $posofb)
            return (-1);
        else if ($posofa > $posofb)
            return (1);
        else
            $i++;
    }
}
usort($array, "comp");
for ($i = 0; $i < count($array); $i++) {
    echo "$array[$i]\n";
}
?>