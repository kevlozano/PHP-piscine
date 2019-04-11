<?php
if (file_exists("./private/user"))
{
	$user = unserialize(file_get_contents("./private/user"));
	$i = -1;
	while (++$i < count($user))
	{
		if ($_POST["submit".$user[$i]["id"]] == "apply")
		{
			$user[$i]["email"] = $_POST["email".$user[$i]["id"]];
			$user[$i]["fname"] = $_POST["fname".$user[$i]["id"]];
			$user[$i]["lname"] = $_POST["lname".$user[$i]["id"]];
			if ($_POST["admin".$user[$i]["id"]] === "admin")
				$user[$i]["admin"] = 1;
			else
				$user[$i]["admin"] = 0;
			if ($_POST["banned".$user[$i]["id"]] === "banned")
				$user[$i]["banned"] = 1;
			else
				$user[$i]["banned"] = 0;
		}
		if ($_POST["delete".$user[$i]["id"]] === "delete")
		{
			unset($user[$i]);
			$user = array_values($user);
		}
	}
	file_put_contents("./private/user", serialize($user));


}
header("Location: admin_tools.php");
?>
