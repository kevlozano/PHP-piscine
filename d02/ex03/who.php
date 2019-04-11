<?php
date_default_timezone_set("America/Los_Angeles");
$file = fopen("/var/run/utmpx", "r");
$format = "a256a/a4b/a32c/id/ie/I2f/a256g/i16h";
while ($utmpx = fread($file, 628))
{
	$unpack = unpack($format, $utmpx);
	$data[$unpack['a']] = $unpack;
}
ksort($data);
foreach ($data as $v)
{
	if ($v['e'] == 7)
	{
		echo ($v['a'])." ";
		echo ($v['c'])." ";
		echo date("M", $v["f1"])." ";
		echo date("j", $v["f1"])." ".date("H:i", $v["f1"]);
		echo "\n";
	}
}
?>