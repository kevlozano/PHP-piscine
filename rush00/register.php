<?php
	if (session_id() == "");
		session_start();
	/* to do : 
	 * 	replace the error page with a display of the login-error */
unset($_SESSION['login_message']);
function check_username($username) {
	if (!preg_match('/^[a-zA-Z0-9-]*$/', $username)) {
		$_SESSION['login_message'] = "Only letters, numbers and dashes are alowed as your username";
		return false;
	}
	$len = strlen($username);
	if ($len < 2 || $len > 12) {
		$_SESSION['login_message'] = "Username must be between 2 and 12 characters";
		return false;
	}
	return true;
}

function check_email($username) {
	if (!preg_match('/^[a-zA-Z0-9-@\.]*/', $username)) {
		$_SESSION['login_message'] = "Only letters, numbers, '@', '.', and dashes are alowed as your username";
		return false;
	}
	$len = strlen($username);
	if ($len < 2 || $len > 30) {
		$_SESSION['login_message'] = "fail on email\n";
		return false;
	}
	return true;
}

function check_password($password) {
	if (!preg_match('/^[a-zA-Z0-9-]*$/', $password)) {
		$_SESSION['login_message'] = "Only letters, numbers and dashes are allowed as your password";
		return false;
	}
	$len = strlen($password);
	if ($len < 4) {
		$_SESSION['login_message'] = "Passwords must be longer than 4 characters";
	 	return false;
	}
	return true;
}

if (isset($_POST["submit"]))
{
	if (check_username($_POST['fname']) && check_username($_POST["lname"]) && check_email($_POST["email"]) && check_password($_POST["passwd"]))
	{
		$user["fname"] = $_POST["fname"];
		$user["lname"] = $_POST["lname"];
		$user["email"] = strtolower($_POST["email"]);
		$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
		$user["admin"] = 0;
		$user["banned"] = 0;
		$user["id"] = 0;
		if (!file_exists("./private"))
			mkdir("./private");
		if (file_exists("./private/user"))
		{
			$tab = unserialize(file_get_contents("./private/user"));
			foreach ($tab as $val)
			{
				$user["id"] = $val["id"] + 1;
				if ($user["email"] === $val["email"])
				{
					header("Location: error.php");
					exit();
				}
			}
		}
		$tab[] = $user;
		file_put_contents("./private/user", serialize($tab));
		header("Location: index.php");
		exit();
	}
	else
		echo $_SESSION['login_message'];
	echo "\ni dont't get in ";
	header("Location: error.php");
	exit();
}
?>

<?php
	include("./header.php");
?>

<!-- new code -->
	<div class="content">
		<div class="login-form-blue">
			<div class="form-contain">
				<form class="login-form" action="register.php" method="POST">
				<p><input type="text" name="fname" placeholder="First Name" value=""></p>
				<p><input type="text" name="lname" placeholder="Last Name" value=""></p>
				<p><input type="email" name="email" placeholder="Email" value=""></p>
				<p><input type="password" name="passwd" placeholder="Password" value=""></p>
				<p><input type="submit" name="submit" value="OK"></p>
				</form>
				<div> <?php echo $_SESSION["login_message"] ?> </div>
			</div>
		</div>
	</div>

<?php
	include("./footer.php");
?>
