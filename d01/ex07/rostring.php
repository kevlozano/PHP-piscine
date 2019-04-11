<?php
	if ($argc > 1)
	{
		for ($i = 0; $i < $argc; $i++)
		{
			$str = trim(preg_replace("/\s+/", " ", $argv[1]));
			$nstr = explode(" ", $str);
		}
		for ($i = 1; $i < count($nstr); $i++)
			echo ($nstr[$i]." ");
		echo ($nstr[0]."\n");
	}
?>