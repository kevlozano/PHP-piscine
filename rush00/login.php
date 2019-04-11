<?php
	if (session_id() == "")
		session_start();
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
		#echo $_SESSION['login_message'];
		return false;
	}
	$len = strlen($username);
	if ($len < 2 || $len > 30) {
		$_SESSION['login_message'] = "Bad email\n";
		#echo $_SESSION['login_message'];
		return false;
	}
	#echo "email return true : ";
	return true;
}
function check_password($password) {
	#for testing
	#$_SESISON['login_message'] = "fail1";
	#echo"/npassword";
	# 
	if (!preg_match('/^[a-zA-Z0-9-]*$/', $password)) {
		$_SESSION['login_message'] = "Only letters, numbers and dashes are allowed as your password";
		#echo $_SESSION['login_message'];
		return false;
	}
	$len = strlen($password);
	if ($len < 4) {
		$_SESSION['login_message'] = "Passwords must be longer than 4 characters";
		#echo "$_SESSION['login_message'];"
	 	return false;
	}
	#echo "\n passwd return true: ;";
	return true;

}/*
function auth ($login, $passwd) {
	$file = 'private/passwd';
	$passwd = hash('whirlpool', $passwd);
	if (!file_exists($file)) {
		echo "\n Auth is broken?";
		return false;
	}
	if ($users = file_get_contents($file)) {
		$users = unserialize($users);
		foreach ($users as $user) {
			if ($user['email'] == $login) {
				if ($user['passwd'] == $passwd)
					return true;
			}
		}
	}
	return false;
}*/




/*testing */
#var_dump($_POST);
/* end testing*/



/*if (isset($_POST['submit']))
	if ($_POST['submit'] == "OK") {
		if (check_email($_POST['email']) && check_password($_POST['passwd']) && auth($_POST['email'], $_POST['passwd'])) {
		$_SESSION['logged_on_user'] = $_POST['email'];
		$_SESSION['login_message'] = "<h5 class='welcome-msg'>Welcome " . $_POST['email']."</h5>";
		header('Refresh: 1;url=index.php');
		}
		else {
			unset($_SESSION['logged_on_user']);
			$_SESSION['login_message'] = "Incorrect username or password";
		}
	}
 */
if (isset($_POST['submit']))
{
	if (check_email($_POST['email']) == true  && check_password($_POST['passwd']) == true)
	{
		$email = $_POST['email'];
		$_SESSION['logged_on_user'] = "";
		if (file_exists("./private/user"))
		{
			$passwd = hash("whirlpool", $_POST["passwd"]);
			$tab = unserialize(file_get_contents("./private/user"));
			foreach ( $tab as $user)
				if ($email == $user['email'] && $passwd == $user["passwd"] /* !$user["banend"]*/)
				{
					$_SESSION["logged_on_user"] = $email;
					$_SESSION["fname"] = $user["fname"];
					$_SESSION["lname"] = $user["lname"];
					$_SESSION["admin"] = $user["admin"];
					/* if ($_SESSION["cart"] && $user["cart"])
						$_SESSION["cart"] = $user["cart"]; */
					header("Location: index.php");
					exit();
				}
			#echo "doesnt match any in database ";
		}
	}
	/*testing
	else {
	echo $_SESISON['login_message'];
	echo "doesn't make into loop";
	echo $_SESSION['logged_on_user'];
	}
	 */
}
?>


<?php
	include("./header.php");
?>




<!-- this is where new code starts -->
		<div class="content">
			<div class="login-form-blue">
				<div class="form-contain">
					<form action="./login.php" method="post" class="login-form">
						<h6 style="font-size:30px;">Enter Your Information</h6>
						<p><input class="field" type="email" name="email" placeholder="email"/></p>
						<br/>
						<br/>
						<p><input class="field" type="password" name="passwd" placeholder="password"/></p>
						<br/>
						<br/>
						<p><input class="button" type="submit" name="submit" value="OK"/></p>
						<?php
						if (isset($_SESSION['login_message'])) {
							echo "</br>" . $_SESSION['login_message'] . "<br/>\n";
						}
						?>
						<a class="creat-user" href="register.php"><h6 class="create-acc">Create Account?</h6></a>
					</form>
				</div>
			</div>
		</div>


<?php
	include("./footer.php");
?>
