<?php
if ($argc < 2) {
    exit();
}
$str = trim($argv[1]);
$str = preg_replace('( +|\t.)', ' ', $str);
echo "$str\n";
?>