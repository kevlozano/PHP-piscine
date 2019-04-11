#!/usr/bin/php
<?php
if ($argc != 3) 
{
	echo "Usage: ./install.php <email@email> <pass>";
	exit;
}
$user["fname"] = "Admin";
$user["lname"] = "Admin";
$user["email"] = $argv[1];
$user["passwd"] = hash("whirlpool", $argv[2]);
$user["admin"] = 1;
$user["banned"] = 0;
$user["id"] = 0;
if (!file_exists("./private"))
  mkdir("./private");
if (file_exists("./private/user"))
{
  echo "INSTALL HAS ALREADY BE RUN\n";
}
else {
  $tab[] = $user;
  file_put_contents("./private/user", serialize($tab));
  echo "SITE IS READY FOR ON SITE ADMIN\n";
  exit();
}
?>
