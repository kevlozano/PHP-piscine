<?php
	if (session_id() == "")
		session_start();
	/* things to do :	inclued(s?)
	 * 				;	the pages with the items;
	 * 				;	login and logout php pages // user login and hashed passwds;
	 * 				;	database manegment
	 * 				;	implement a shopping basket/cart (cart needs to work without being logged in;
	 * 				;	admin privilges ;
	 */
	include("header.php");

	include("items.php");

	include("footer.php");
?>
