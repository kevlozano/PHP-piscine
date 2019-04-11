<?php
if ($argc != 2)
    exit();
$arr = explode(" ", $argv[1]);
$day = strtolower($arr[0]);
$num = $arr[1];
$month = strtolower($arr[2]);
$year = $arr[3];
$hour = explode(":", $arr[4]);
$check = 0;

$days = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"];
$months = ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"];
$monthkey = array_search($month, $months) + 1;

if (in_array($day, $days) && ($num > 0 && $num < 32) && (in_array($month, $months)) && 
(strlen($year) == 4 && $year > 1970) && (($hour[0] > 0 && $hour[0] < 25) && ($hour[1] >= 0 && $hour[1] < 60) 
&& ($hour[2] > 0 && $hour[2] < 60))){
    $ret = mktime($hour[0], $hour[1], $hour[2], $monthkey, $num, $year);
    echo "$ret\n";
}
else
    echo "Wrong Format\n";
?>