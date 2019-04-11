<?php
if ($argc != 2) {
    echo "\n";
    exit();
}
$word = trim($argv[1]);
$word = preg_replace('/  +/', " ", $word);
echo "$word\n";
?>