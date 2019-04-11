<?php
if ($argc != 2) {
    echo "Incorrect Parameters\n";
    exit();
}
$str = trim($argv[1]);
$i = 0;
$a = 0;
$b = 0;
$neg = 1;
$len = strlen($str)-1;
if ($str[$i] == '-') {
    $neg = -1;
    $i++;
}
if (!ctype_digit($str[$i])) {
    echo "Syntax Error\n";
    exit();
}
while (ctype_digit($str[$i])) {
    $a *= 10;
    $a += $str[$i];
    $i++;
}
$a *= $neg;
$neg = 1;
while (ctype_space($str[$i])) {
    $i++;
}
if ($str[$i] != '+' && $str[$i] != '-' && $str[$i] != '/' && $str[$i] != '*' && $str[$i] != '%') {
    echo "Syntax Error\n";
    exit();
}
$op = $str[$i];
$i++;
while (ctype_space($str[$i])) {
    $i++;
}
if ($str[$i] == '-') {
    $neg = -1;
    $i++;
}
if (!ctype_digit($str[$i])) {
    echo "Syntax Error\n";
    exit();
}
while ($i <= $len && ctype_digit($str[$i])) {
    $b *= 10;
    $b += $str[$i];
    $i++;
}
$b *= $neg;
if ($b == 0 && $op == '/')
{
    echo "Undefined\n";
    exit();
}

switch ($op) {
    case '+':
        $ret = $a + $b;
        echo "$ret\n";
        break;
    case '-':
        $ret = $a - $b;
        echo "$ret\n";
        break;
    case '*':
        $ret = $a * $b;
        echo "$ret\n";
        break;
    case '/':
        $ret = $a / $b;
        echo "$ret\n";
        break;
    case '%':
        $ret = $a % $b;
        echo "$ret\n";
        break;
}
?>