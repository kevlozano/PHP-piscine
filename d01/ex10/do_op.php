<?php
if ($argc != 4) {
    echo "Incorrect Parameters\n";
    exit();
}
$a = trim($argv[1]);
$op = trim($argv[2]);
$b = trim($argv[3]);

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