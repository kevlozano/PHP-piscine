<?php  
	function ft_is_sort($argv)
	{
		if (count($argv) == 1)
			return (true);
		$str = $argv;
		sort($str);
		for ($i = 0; $i < count($str); $i++)
		{
			if (strcmp($str[$i], $argv[$i]))
				return (false);
		}
		return (true);
	}
?>