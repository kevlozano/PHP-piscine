<?php
if (session_id() == "")
	session_start();
include("header.php");
?>
<div class="content">
	<div class="login-form"></div>
	<h2 class="login-header">Error 
	<?php
	if($_SESSION["logged_on_user"] == "")
		echo " (please login first!)"
	?>
	</h2>
</div>
<?php include("footer.php"); ?>