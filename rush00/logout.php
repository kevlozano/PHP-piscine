<?php
if (session_id() == "")
		session_start();
	$user = unserialize(file_get_contents("./private/user"));
	for ($i = 0; $i < count($user); $i++)
		if ($_SESSION["logged_on_user"] === $user[$i]["email"])
	{
		$user[$i]["cart"] = $_SESSION["cart"];
		unset($_SESSION["cart"]);
		file_put_contents("./private/user", serialize($user));
	}
$_SESSION = array();
header('Location: index.php');
?>
