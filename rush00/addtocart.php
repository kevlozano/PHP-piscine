<?php
session_start();
if (isset($_POST["submit"]))
{
	if ($_POST["item"] != "")
	{
		$tab = unserialize(file_get_contents("./private/item"));
		foreach ($tab as $val)
			if ($val["name"] === $_POST["item"])
				$item = $val;
		if ($item["quantity"] > 0)
		{
			$_SESSION["cart"][] = $item;
			header("Location: index.php");
			exit();
		}
	}
}
header("Location: error.php");
	exit();
?>
