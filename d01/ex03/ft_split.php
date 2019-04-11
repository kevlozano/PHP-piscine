<?php
function ft_split($line) {
    $newLine = trim($line);
    $newLine = preg_replace('/  +/', ' ', $newLine);
    echo $newLine . "\n";
    $array = explode(" ", $newLine);
	sort($array);   
	return $array;
}
?>
