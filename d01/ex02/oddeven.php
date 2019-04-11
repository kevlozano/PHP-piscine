<?php
echo "Enter a number: ";
$num = trim(fgets(STDIN));
if (feof(STDIN)) {
    echo "\n";
    exit();
}
if (!is_numeric($num)) {
    echo "'$num' is not a number\n";
}
else if ($num % 2 == 0) {
    echo "The number $num is even\n";
}
else {
    echo "The number $num is odd\n";
}
?>